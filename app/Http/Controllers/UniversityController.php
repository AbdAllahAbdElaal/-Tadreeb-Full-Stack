<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Organization;
use App\Models\Student;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities = University::with([
            'organization.member',
            'organization.subscription.plan'
        ])->orderBy('id', 'desc')->withoutTrashed()->paginate(10);

        return response()->view('tadreeb.university.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::all();
        return response()->view('tadreeb.university.create' , compact('universities'));
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
        }else{
            $member = new Member();
            $member->username = $request->get('username');
            $member->email = $request->get('email');
            $member->role = 'organization';
            $member->password = bcrypt($request->get('password'));
            $member->save();

            $organization = new Organization();
            $organization->role = 'university';
            $organization->member_id = $member->id;

            $organization->save();

            $university = new University();
            $university->name = $request->get('name');
            $university->email = $request->get('email');
            $university->phone = $request->get('phone');
            $university->status = 'pending';

            $university->organization_id = $organization->id;

            $isSaved = $university->save();

            if (!$isSaved) {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'فشل!',
                ], 400);
            }else{
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
        $university = University::findOrFail($id);
        return response()->view('tadreeb.university.show' , compact('university'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $university = University::findOrFail($id);
        return response()->view('tadreeb.university.edit' , compact('university'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $universities = University::findOrFail($id);

        if ($request->has('name')) {
            $universities->name = $request->get('name');
        }

        if ($request->has('phone')) {
            $universities->phone = $request->get('phone');
        }

        if ($request->has('email')) {
            $universities->email = $request->get('email');
        }

        if ($request->has('status')) {
            $universities->status = $request->get('status');
        }

        $isUpdate = $universities->save();

        if ($isUpdate) {
            if ($request->has('email') && $universities->organization && $universities->organization->member) {
                $member = $universities->organization->member;
                $member->email = $request->get('email');
                $member->save();
            }
            return response()->json([
                'icon' => 'success',
                'title' => 'تم بنجاح!',
                'redirect' => route('universities.index')
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
        $university = University::with('organization')->findOrFail($id);

        $orgId = $university->organization_id;
        $memberId = $university->organization ? $university->organization->member_id : null;

        University::destroy($id);
        if($orgId){
            Organization::destroy($orgId);
        }
        if($memberId){
            Member::destroy($memberId);
        }
    }


    public function dashboard()
    {
        // 1. جلب حساب الجامعة الذي سجل الدخول الآن
        $user = Auth::user();

        // 2. جلب بيانات الجامعة الخاصة به فقط، مع طلابها
        $university = $user->organization->university()->with('students')->first();

        // 3. توجيهه إلى صفحة الداشبورد الخاصة بالجامعة
        return view('tadreeb.university.dashboard', compact('university'));
    }



    private function getUniversityId()
    {
        return Auth::user()->organization->university->id;
    }

    public function universityStudents()
    {
        $students = Student::where('university_id', $this->getUniversityId())->get();
        return view('tadreeb.university.student.index', compact('students'));
    }


    public function approveTraining(Request $request, $training_id){
        $university = Auth::user()->organization->university;

        // الدالة syncWithoutDetaching تضيف التدريب بدون تكرار لو ضغط بالخطأ مرتين
        $university->approvedTrainings()->syncWithoutDetaching($training_id);

        return back()->with('success', 'تم إضافة التدريب بنجاح، وهو الآن متاح لطلابك!');
    }







    public function trashed()
    {
        $universities = University::onlyTrashed()->latest()->get();

        return response()->view('tadreeb.university.trashed', compact('universities'));
    }



    public function restore($id)
    {
        $university = University::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'تم استعادة الجامعة بنجاح!');
    }


    public function forceDelete($id)
    {
        $university = University::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'تم حذف الجامعة نهائياً بنجاح!');
    }
}
