@extends('tadreeb.parent')


@section('title' , 'Student Dashboard')


@section('menu')
<li><a href="{{ route('student-dashboard') }}" class="active">
    <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a></li>
<li><a href="{{ route('student-trainings') }}">
    <i class="fa-solid fa-book-open-reader" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('student-applications') }}">
    <i class="fa-solid fa-file-signature" style="color: #A78BFA"></i> Applications</a>
</li>
<li><a href="{{ route('student-reports') }}">
    <i class="fa-solid fa-chart-line" style="color: #F64E60"></i> Reports</a>
</li>
<li><a href="{{ route('student-profile') }}">
    <i class="fa-solid fa-user-gear" style="color: #4154ff"></i> Profile</a>
</li>
@endsection

@php
// تقطيع الاسم لمصفوفة، أخذ أول حرف من كل كلمة، ثم دمجهم
$words = explode(' ', $student->first_name . ' ' . $student->last_name);
$initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
@endphp
@section('user-avatar' , $initials)

@section('user-title' , $student->first_name . ' ' . $student->last_name )


@section('profile-btn')
    <a href="{{ route('student-profile') }}" class="dropdown-item profile">Profile</a>
@endsection




@section('content')
<div class="content">
    <div class="page-header">
        <h1>Dashboard</h1>
        <p class="breadcrumb">Home / Dashboard</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- التحقق هل الطالب لديه تدريب نشط (تم قبوله فيه) --}}
    @if($activeApplication)
        @php
            $training = $activeApplication->training;
        @endphp

        <div class="card" style="border-left: 4px solid #10b981;">
            <div class="card-header">
                <h3 class="card-title">التدريب الحالي (Current Training)</h3>
            </div>
            <div class="card-body">
                <p><i class="fa-solid fa-briefcase" style="width: 20px; color:#64748b;"></i> <strong>التدريب:</strong> {{ $training->title }}</p>
                <p><i class="fa-solid fa-building" style="width: 20px; color:#64748b;"></i> <strong>الشركة:</strong> {{ $training->company->name ?? 'غير محدد' }}</p>
                <p><i class="fa-regular fa-calendar-days" style="width: 20px; color:#64748b;"></i> <strong>المدة:</strong> {{ $training->start_date }}  إلى  {{ $training->end_date }}</p>

                <p class="mt-4"><strong>نسبة الإنجاز (Hours Progress):</strong></p>
                <div class="progress" style="height: 20px; background-color: #e2e8f0; border-radius: 10px; overflow: hidden;">
                    {{-- شريط التقدم الديناميكي --}}
                    <div class="progress-bar"
                         style="width: {{ $progressPercentage }}%; background-color: #10b981; transition: width 1s ease-in-out;">
                    </div>
                </div>
                <p class="mt-2" style="color: #475569; font-weight: bold;">
                    {{ $student->completed_hours }} / {{ $student->required_hours }} ساعة مكتملة ({{ $progressPercentage }}%)
                </p>

                <a href="{{ route('student-reports') }}" class="btn btn-primary mt-3">
                    <i class="fa-solid fa-file-pen"></i> تقديم تقرير أسبوعي
                </a>
            </div>
        </div>

        {{-- المهام القادمة (تظهر فقط إذا كان لديه تدريب نشط) --}}
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">المهام القادمة (Upcoming Tasks)</h3>
            </div>
            <div class="card-body">
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: 12px; border-bottom: 1px solid #e0e6ed;"><i class="fa-regular fa-clock" style="color: #f59e0b;"></i> <strong>تقرير الأسبوع:</strong> يرجى تسليمه بنهاية الأسبوع.</li>
                    {{-- يمكنك لاحقاً ربط هذا القسم بجدول المهام الحقيقي من قاعدة البيانات --}}
                </ul>
            </div>
        </div>

    @else
        {{-- حالة عدم وجود تدريب نشط (Empty State) --}}
        <div class="card" style="text-align: center; padding: 50px 20px; border: 2px dashed #cbd5e1; box-shadow: none;">
            <div class="card-body">
                <i class="fa-solid fa-chalkboard-user" style="font-size: 60px; color: #94a3b8; margin-bottom: 20px;"></i>
                <h3 style="color: #1e293b; margin-bottom: 10px;">لا يوجد تدريب نشط حالياً</h3>

                @php
                    // فحص هل لديه طلبات قيد المراجعة للطمأنة؟
                    $pendingApplicationsCount = $student->applications()->where('status', 'pending')->count();
                @endphp

                @if($pendingApplicationsCount > 0)
                    <p style="color: #64748b; font-size: 16px;">
                        لديك <strong>({{ $pendingApplicationsCount }})</strong> طلبات انضمام قيد المراجعة من قبل الشركات. يرجى انتظار الرد.
                    </p>
                    <a href="{{ route('student-applications') }}" class="btn btn-secondary mt-3">متابعة حالة الطلبات</a>
                @else
                    <p style="color: #64748b; font-size: 16px;">
                        أنت لست منضماً لأي برنامج تدريبي في الوقت الحالي. ابدأ الآن بتصفح الفرص المتاحة وقدم طلب انضمام.
                    </p>
                    <a href="{{ route('student-trainings') }}" class="btn btn-primary mt-3">
                        <i class="fa-solid fa-magnifying-glass"></i> تصفح التدريبات المتاحة
                    </a>
                @endif
            </div>
        </div>
    @endif

</div>

@endsection
