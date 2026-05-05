<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('id', 'desc')->paginate(10);

        return response()->view('tadreeb.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return response()->view('tadreeb.student.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:30',
            'email' => 'required|email|unique:members',
            'first_name' => 'required|string|min:2|max:30',
            'last_name' => 'required|string|min:2|max:30',
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
            $member->role = 'student';
            $member->password = bcrypt($request->get('password'));
            $member->save();

            $student = new Student();
            $student->first_name = $request->get('first_name');
            $student->last_name = $request->get('last_name');
            $student->email = $request->get('email');
            $student->phone = $request->get('phone');
            $student->major = $request->get('major');
            $student->university_id = $request->get('university_id');
            $student->required_hours = $request->get('required_hours');
            $student->completed_hours = 0;
            $student->status = 'active';
            $student->member_id = $member->id;

            $isSaved = $student->save();

            if (!$isSaved) {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'فشل!',
                ], 400);
            } else {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'تم بنجاح!',
                    'redirect' => route('students.index')
                ], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $students = Student::with('university')->findOrFail($id);
        return response()->view('tadreeb.student.show', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return response()->view('tadreeb.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $students = Student::findOrFail($id);

        if ($request->has('first_name')) {
            $students->first_name = $request->get('first_name');
        }

        if ($request->has('last_name')) {
            $students->last_name = $request->get('last_name');
        }

        if ($request->has('phone')) {
            $students->phone = $request->get('phone');
        }

        if ($request->has('email')) {
            $students->email = $request->get('email');
        }

        if ($request->has('major')) {
            $students->major = $request->get('major');
        }

        if ($request->has('required_hours')) {
            $students->required_hours = $request->get('required_hours');
        }

        if ($request->has('completed_hours')) {
            $students->completed_hours = $request->get('completed_hours');
        }

        if ($request->has('status')) {
            $students->status = $request->get('status');
        }

        $isUpdate = $students->save();

        if ($isUpdate) {
            if ($request->has('email') && $students->member) {
                $member = $students->member;
                $member->email = $request->get('email');
                $member->save();
            }
            return response()->json([
                'icon' => 'success',
                'title' => 'تم بنجاح!',
                'redirect' => route('university.my-students')
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
        $student = Student::findOrFail($id);

        $memberId = $student->member ? $student->member_id : null;

        Student::destroy($id);
        if ($memberId) {
            Member::destroy($memberId);
        }
    }



    public function dashboard()
    {
        $student = Auth::user()->student;

        // 1. البحث عن الطلب "المقبول" (التدريب النشط) مع بيانات التدريب والشركة
        $activeApplication = $student->applications()
            ->where('status', 'accepted')
            ->with('training.company')
            ->first();

        // 2. حساب النسبة المئوية لإنجاز الساعات (حماية من القسمة على صفر)
        $progressPercentage = 0;
        if ($student->required_hours > 0) {
            $progressPercentage = round(($student->completed_hours / $student->required_hours) * 100);
        }

        // 3. منع تجاوز النسبة 100% في حال سجل الطالب ساعات إضافية
        $progressPercentage = $progressPercentage > 100 ? 100 : $progressPercentage;

        return view('tadreeb.student.dashboard', compact('student', 'activeApplication', 'progressPercentage'));
    }





    // 1. دالة عرض صفحة الملف الشخصي
    public function profile()
    {
        $user = Auth::user(); // جلب بيانات الدخول (الإيميل)
        $student = $user->student; // جلب بيانات الطالب المرتبطة به

        return view('tadreeb.student.profile', compact('user', 'student'));
    }



    // 2. دالة تحديث البيانات
    public function updateProfile(Request $request)
    {
        $student = Auth::user()->student;

        // التحقق من صحة البيانات المدخلة
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:2|max:40',
            'last_name'  => 'required|string|min:2|max:40',
            'phone'      => 'required|string|min:8|max:20',
            'major'      => 'required|string|min:2|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
                'text' => $validator->errors()->first()
            ], 400);
        } else {
            if ($request->has('first_name')) {
                $student->first_name = $request->get('first_name');
            }

            if ($request->has('last_name')) {
                $student->last_name = $request->get('last_name');
            }

            if ($request->has('phone')) {
                $student->phone = $request->get('phone');
            }

            if ($request->has('major')) {
                $student->major = $request->get('major');
            }

            $isUpdate = $student->save();

            if ($isUpdate) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'تم بنجاح!',
                    'redirect' => route('student-profile')
                ], 200);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'فشل!',
                ], 400);
            }
        }
    }
}
