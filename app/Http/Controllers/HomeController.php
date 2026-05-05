<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Company;
use App\Models\Student;
use App\Models\Training;

class HomeController extends Controller
{
    public function index()
    {
        // 1. جلب الإحصائيات
        $universitiesCount = University::where('status', 'active')->count();
        $companiesCount    = Company::where('status', 'active')->count();
        $studentsCount     = Student::count();
        $trainingsCount    = Training::count();

        // 2. إرجاع واجهة العرض مع البيانات
        return view('tadreeb.index', compact(
            'universitiesCount',
            'companiesCount',
            'studentsCount',
            'trainingsCount'
        ));
    }
}
