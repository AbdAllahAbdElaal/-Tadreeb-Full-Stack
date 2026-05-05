<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Member;
use App\Models\Organization;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('organization')->orderBy('id' , 'desc')->paginate(10);

        return response()->view('tadreeb.member.index' , compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::all();
        return response()->view('tadreeb.member.create' , compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:30',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|string|min:5',
        ]);

        $members = new Member();
        $members->username = $request->get('username');
        $members->email = $request->get('email');
        $members->role = $request->get('member_role'); // 'organization'
        $members->password = Hash::make($request->get('password'));

        $isSaved = $members->save();

        if ($isSaved) {
            // 2. إنشاء المنظمة المرتبطة بالعضو
            if($request->get('org_role') === 'university' || $request->get('org_role') === 'company'){
                $organization = new Organization();
                $organization->role = $request->get('org_role'); // 'university' أو 'company'
                $organization->member_id = $members->id; // ربط المنظمة بالعضو

                $organization->save();
            }

            // 3. إنشاء سجل الجامعة إذا كان نوع المنظمة 'university'
            if ($request->get('org_role') === 'university') {
                $university = new University();
                $university->name = $request->get('name');
                $university->email = $request->get('email');
                $university->phone = $request->get('phone');
                $university->status = 'pending';

                $university->organization_id = $organization->id;

                $university->save();

            }else if($request->get('org_role') === 'company'){
                $company = new Company();
                $company->name = $request->get('name');
                $company->email = $request->get('email');
                $company->phone = $request->get('phone');
                $company->description = $request->get('description');
                $company->address = $request->get('address');
                $company->subscription_plan = 'no subscription';
                $company->status = 'pending';

                $company->organization_id = $organization->id;

                $company->save();
            }

            return response()->json([
                'icon' => 'success',
                'title' => 'تم بنجاح!',
                'text' => 'تم إنشاء الحساب بنجاح'
            ], 201);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
                'text' => 'فشل في إنشاء الحساب'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $members = Member::findOrFail($id);
        return response()->view('tadreeb.member.show' , compact('members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $members = Member::findOrFail($id);
        return response()->view('tadreeb.member.edit' , compact('members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:30',
            'email' => 'required|email',
            'password' => 'required|string|min:5',
        ]);

        $members = Member::findOrFail($id);
        $members->username = $request->get('username');
        $members->email = $request->get('email');
        $members->password = Hash::make($request->get('password'));

        $isUpdate = $members->save();

        if ($isUpdate) {

            if ($members->organization && $members->organization->role === 'university') {

                // جلب بيانات الجامعة المرتبطة بهذه المنظمة
                $university = $members->organization->university;

                // التأكد من أن سجل الجامعة موجود فعلاً
                if ($university) {
                    // تحديث اسم الجامعة ورقم الهاتف
                    $university->name  = $request->get('name');
                    $university->phone = $request->get('phone');
                    $university->email = $request->get('email');
                    $university->save();
                }
            }

            return response()->json([
                'icon' => 'success',
                'title' => 'تم بنجاح!',
                'redirect' => route('members.index'),
            ], 201);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
                'text' => 'فشل في إنشاء الحساب'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $members = Member::findOrFail($id);
        $organizations = $members->organization;
        $universities = $members->organization->university;
        $members::destroy($id);
        $organizations::destroy($organizations->id);
        $universities::destroy($universities->id);
    }
}
