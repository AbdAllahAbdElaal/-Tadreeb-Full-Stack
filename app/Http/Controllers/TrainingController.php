<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. جلب آيدي الشركة الخاصة بالمستخدم المسجل حالياً
        $companyId = Auth::user()->organization->company->id;

        // 2. جلب تدريبات هذه الشركة فقط، مع عدّ طلبات الانضمام لكل تدريب
        $trainings = Training::where('company_id', $companyId)
                            ->withCount(['applications' , 'applications as accepted_count' =>
                                function($query) {
                                    $query->where('status', 'accepted');
                                }
                            ])
                            ->latest()
                            ->get();

        // 3. توجيه الشركة لصفحة العرض
        return view('tadreeb.training.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainings = Training::all();
        return response()->view('tadreeb.training.create' , compact('trainings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:10|max:255',
            'available_slots' => 'required|integer|min:1',
            'start_date' => 'required|date|before_or_equal:end_date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
                'text' => $validator->errors()->first()
            ], 400);
        }else{
            $training = new Training();
            $training->title = $request->get('title');
            $training->description = $request->get('description');
            $training->available_slots = $request->get('available_slots');
            $training->start_date = $request->get('start_date');
            $training->end_date = $request->get('end_date');
            $training->company_id = Auth::user()->organization->company->id; // ربط التدريب بالشركة الحالية

            $isSaved = $training->save();

            if (!$isSaved) {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'فشل!',
                ], 400);
            }else{
                return response()->json([
                'icon' => 'success',
                'title' => 'تم بنجاح!',
                'redirect' => route('trainings.index')
            ], 201);
            }

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $training = Training::findOrFail($id);
        return response()->view('tadreeb.training.edit' , compact('training'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:10|max:255',
            'available_slots' => 'required|integer|min:1',
            'start_date' => 'required|date|before_or_equal:end_date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
                'text' => $validator->errors()->first()
            ], 400);
        }else{
            $training = Training::findOrFail($id);
            $training->title = $request->get('title');
            $training->description = $request->get('description');
            $training->available_slots = $request->get('available_slots');
            $training->start_date = $request->get('start_date');
            $training->end_date = $request->get('end_date');

            $isSaved = $training->save();

            if (!$isSaved) {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'فشل!',
                ], 400);
            }else{
                return response()->json([
                'icon' => 'success',
                'title' => 'تم بنجاح!',
                'redirect' => route('trainings.index')
            ], 201);
            }

         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $training = Training::findOrFail($id);
        $isDeleted = $training::destroy($id);
        if (!$isDeleted) {
            return response()->json([
                'icon' => 'error',
                'title' => 'فشل!',
            ], 400);
        }else{
            return response()->json([
            'icon' => 'success',
            'title' => 'تم الحذف بنجاح!',
            'redirect' => route('trainings.index')
        ], 200);
        }

    }


    public function admin_index()
    {
        $trainings = Training::orderBy('created_at', 'desc')->get();

        return response()->view('tadreeb.admin.training.index', compact('trainings'));
    }

    public function university_index()
    {
        $trainings = Training::orderBy('created_at', 'desc')->get();

        return response()->view('tadreeb.university.training.index', compact('trainings'));
    }


    public function student_index()
    {
        // 1. نجلب بيانات الطالب المرتبط باليوزر المسجل
        $student = Auth::user()->student;

        // 2. نجلب "فقط" التدريبات التي اعتمدتها جامعته
        // مع جلب بيانات الشركة (company) واسم التدريب
        $trainings = $student->university->approvedTrainings()->with('company')->latest()->get();

        return view('tadreeb.student.training.index', compact('trainings'));
    }




    public function apply(Request $request, $training_id)
    {
        $student = Auth::user()->student;

        // 1. الحماية الأولى: التأكد أنه لا يملك تدريباً نشطاً (مقبول)
        $hasActiveTraining = $student->applications()->where('status', 'accepted')->exists();
        if ($hasActiveTraining) {
            return back()->with('error', 'لا يمكنك التقديم. لديك تدريب نشط حالياً.');
        }

        // 2. الحماية الثانية: التأكد أنه لم يقدم على هذا التدريب مسبقاً
        $alreadyApplied = $student->applications()->where('training_id', $training_id)->exists();
        if ($alreadyApplied) {
            return back()->with('error', 'لقد قمت بتقديم طلب لهذا التدريب مسبقاً.');
        }

        // 3. إنشاء الطلب
        Application::create([
            'student_id' => $student->id,
            'training_id' => $training_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'تم إرسال طلب الانضمام للشركة بنجاح!');
    }
}
