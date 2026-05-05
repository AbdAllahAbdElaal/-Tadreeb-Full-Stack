<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Company;
use App\Models\Member;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('organization')->orderBy('id', 'desc')->paginate(10);

        return response()->view('tadreeb.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return response()->view('tadreeb.company.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:30',
            'email' => 'required|email|unique:members',
            'name' => 'required|string|min:3|max:50',
            'phone' => 'required|string|min:9|max:15',
            'password' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
                'text' => $validator->errors()->first()
            ], 400);
        } else {
            $member = new Member();
            $member->username = $request->get('username');
            $member->email = $request->get('email');
            $member->role = 'organization';
            $member->password = bcrypt($request->get('password'));
            $member->save();

            $organization = new Organization();
            $organization->role = 'company';
            $organization->member_id = $member->id;

            $organization->save();

            $company = new Company();
            $company->name = $request->get('name');
            $company->email = $request->get('email');
            $company->phone = $request->get('phone');
            $company->description = $request->get('description');
            $company->address = $request->get('address');
            $company->subscription_plan = 'no subscription';
            $company->status = 'active';

            $company->organization_id = $organization->id;

            $isSaved = $company->save();

            if (!$isSaved) {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'فشل!',
                ], 400);
            } else {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'تم بنجاح!',
                    'redirect' => route('universities.index')
                ], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return response()->view('tadreeb.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return response()->view('tadreeb.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = Company::findOrFail($id);

        if ($request->has('name')) {
            $company->name = $request->get('name');
        }

        if ($request->has('phone')) {
            $company->phone = $request->get('phone');
        }

        if ($request->has('email')) {
            $company->email = $request->get('email');
        }

        if ($request->has('address')) {
            $company->address = $request->get('address');
        }

        if ($request->has('description')) {
            $company->description = $request->get('description');
        }

        if ($request->has('status')) {
            $company->status = $request->get('status');
        }

        $isUpdate = $company->save();

        if ($isUpdate) {
            if ($request->has('email') && $company->organization && $company->organization->member) {
                $member = $company->organization->member;
                $member->email = $request->get('email');
                $member->save();
            }

            return response()->json([
                'icon' => 'success',
                'title' => 'تم بنجاح!',
                'redirect' => route('companies.index')
            ], 201);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::with('organization')->findOrFail($id);

        $orgId = $company->organization_id;
        $memberId = $company->organization ? $company->organization->member_id : null;

        Company::destroy($id);
        if ($orgId) {
            Organization::destroy($orgId);
        }
        if ($memberId) {
            Member::destroy($memberId);
        }
    }










    // 1. دالة عرض صفحة الملف الشخصي
    public function profile()
    {
        $user = Auth::user();
        $company = $user->organization->company;

        return view('tadreeb.company.profile', compact('user', 'company'));
    }



    public function updateProfile(Request $request)
    {
        $company = Auth::user()->organization->company;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'phone'  => 'required|string|min:8|max:20',
            'address'      => 'nullable|string|max:255',
            'description'      => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
                'text' => $validator->errors()->first()
            ], 400);
        } else {
            if ($request->has('name')) {
                $company->name = $request->get('name');
            }

            if ($request->has('phone')) {
                $company->phone = $request->get('phone');
            }

            if ($request->has('address')) {
                $company->address = $request->get('address');
            }

            if ($request->has('description')) {
                $company->description = $request->get('description');
            }

            $isUpdate = $company->save();

            if ($isUpdate) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'تم بنجاح!',
                    'redirect' => route('company-profile')
                ], 200);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'فشل!',
                ], 400);
            }
        }
    }




    public function dashboard()
    {
        // 1. جلب الشركة
        $company = Auth::user()->organization->company;

        // 2. حساب الطلبات المعلقة المرتبطة بتدريبات هذه الشركة فقط
        $pendingApplicationsCount = Application::where('status', 'pending')
            ->whereHas('training', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })
            ->count();

        $acceptedApplicationsCount = Application::where('status', 'accepted')
            ->whereHas('training', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })
            ->count();

        $recentApplications = Application::where('status', 'pending')
            ->whereHas('training', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })
            ->with(['student.university', 'training'])
            ->latest()
            ->paginate(5);

        // 3. إرسال المتغيرات للواجهة
        return view('tadreeb.company.dashboard', compact('company', 'pendingApplicationsCount', 'acceptedApplicationsCount', 'recentApplications'));
    }
}
