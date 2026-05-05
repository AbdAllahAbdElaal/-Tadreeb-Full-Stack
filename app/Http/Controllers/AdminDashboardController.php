<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Company;
use App\Models\Student;
use App\Models\Training;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. إحصائيات الجامعات
        $activeUniversities = University::where('status', 'active')->count();
        $pendingUniversities = University::where('status', 'pending')->count();

        // 2. إحصائيات الشركات
        $activeCompanies = Company::where('status', 'active')->count();
        $pendingCompanies = Company::where('status', 'pending')->count();

        // 3. إحصائيات الطلاب
        $activeStudents = Student::where('status', 'active')->count();
        $pendingStudents = Student::where('status', 'pending')->count();
        $completedStudents = Student::where('status', 'completed')->count();

        // 4. إحصائيات التدريب
        $numberOfTrainings = Training::count();

        // إجمالي الأرقام
        $totalUniversities = $activeUniversities + $pendingUniversities;
        $totalCompanies = $activeCompanies + $pendingCompanies;
        $totalStudents = $activeStudents + $pendingStudents + $completedStudents;

        return view('tadreeb.admin.dashboard', compact(
            'activeUniversities', 'pendingUniversities', 'totalUniversities',
            'activeCompanies', 'pendingCompanies', 'totalCompanies',
            'activeStudents', 'pendingStudents', 'completedStudents', 'totalStudents',
            'numberOfTrainings'
        ));
    }
}
