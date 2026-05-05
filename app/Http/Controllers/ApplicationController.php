<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. جلب آيدي الشركة الحالية
        $companyId = Auth::user()->organization->company->id;

        // 2. جلب الطلبات التي تنتمي لتدريبات هذه الشركة فقط
        $applications = Application::whereHas('training', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->with(['student.university', 'training'])->latest()->get();

        return view('tadreeb.company.application.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'accepted';
        $isSaved = $application->save();

        if ($isSaved) {
            // رفض أو حذف باقي طلبات الطالب المعلقة لأنه تم قبوله هنا
            Application::where('student_id', $application->student_id)
                       ->where('id', '!=', $application->id)
                       ->where('status', 'pending')
                       ->delete();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم قبول الطالب بنجاح!',
                'redirect' => route('applications.index') // لعمل ريفريش للصفحة
            ], 200);
        }

        return response()->json([
            'icon' => 'error',
            'title' => 'فشل القبول!'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. جلب الطالب الحالي
        $student = Auth::user()->student;

        // 2. البحث عن الطلب (مع التأكد أنه يخص هذا الطالب تحديداً)
        $application = Application::where('id', $id)
            ->where('student_id', $student->id)
            ->firstOrFail();

        // 3.  لا يمكن الإلغاء إذا تم الرد عليه
        if ($application->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'لا يمكنك إلغاء الطلب لأنه لم يعد قيد المراجعة.'
            ], 403);
        }

        // 4. حذف الطلب
        $application::destroy($application->id);

        // 5. إرسال استجابة نجاح للجافاسكريبت
        return response()->json([
            'status' => 'success',
            'message' => 'تم إلغاء الطلب بنجاح.'
        ], 200);
    }







    public function company_Applications_reject($id)
    {
        $application = Application::findOrFail($id);

        $application->status = 'rejected';
        $isSaved = $application->save();

        if ($isSaved) {
            return response()->json([
                'icon' => 'success',
                'title' => 'تم رفض الطلب بنجاح!'
            ], 200);
        }

        return response()->json([
            'icon' => 'error',
            'title' => 'فشل الرفض!'
        ], 400);
    }








    public function student_Applications_index()
    {
        // 1. جلب بيانات الطالب الحالي
        $student = Auth::user()->student;

        // 2. جلب كل الطلبات الخاصة به، مع بيانات التدريب والشركة
        $applications = $student->applications()
            ->with('training.company')
            ->latest()
            ->get();

        // 3. توجيهه لصفحة العرض
        return view('tadreeb.student.application.index', compact('applications'));
    }
}
