@extends('tadreeb.parent')


@section('title' , 'Available Trainings')


@section('menu')
<li><a href="{{ route('student-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a></li>
<li><a href="{{ route('student-trainings') }}" class="active">
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
$words = explode(' ', auth()->user()->student->first_name . ' ' . auth()->user()->student->last_name);
$initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
@endphp
@section('user-avatar' , $initials)

@section('user-title' , auth()->user()->student->first_name . ' ' . auth()->user()->student->last_name )



@section('profile-btn')
<a href="{{ route('student-profile') }}" class="dropdown-item profile">Profile</a>
@endsection




@section('content')

<div class="content">

    {{-- الترويسة العلوية --}}
    <div class="page-header-actions">
        <div>
            <h1>إدارة التدريبات</h1>
            <p class="breadcrumb">لوحة التحكم / تدريباتي</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success" style="margin-bottom: 20px;">{{ session('success') }}</div>
    @endif

    <div class="admin-trainings-grid">

        @foreach($trainings as $training)
        <div class="management-card">

            {{-- حالة التدريب (فعال أم منتهي بناءً على التاريخ) --}}
            @if(\Carbon\Carbon::parse($training->end_date)->isPast())
            <span class="status-badge status-expired">منتهي</span>
            @else
            <span class="status-badge status-active">فعال</span>
            @endif

            <h3 class="training-title">{{ $training->title }}</h3>

            <div class="stats-container">
                <div class="stat-box">
                    <span class="number">{{ $training->available_slots }}</span>
                    <span class="label">مقعد كلي</span>
                </div>
                {{-- <div class="stat-box">
                    <span class="number" style="color: #4a90e2;">{{ $training->applications_count ?? 0 }}</span>
                    <span class="label">طلبات الانضمام</span>
                </div> --}}
            </div>

            {{-- تواريخ التدريب --}}
            <div class="training-details">
                <p><i class="fa-regular fa-calendar-check"></i> <strong>البداية:</strong> {{ $training->start_date }}
                </p>
                <p><i class="fa-regular fa-calendar-xmark"></i> <strong>النهاية:</strong> {{ $training->end_date }}</p>
            </div>

            {{-- أزرار التحكم --}}
            <div class="card-actions">
                @php
                $student = auth()->user()->student;

                // 1. فحص هل الطالب لديه أي تدريب "مقبول" حالياً؟
                $hasActiveTraining = $student->applications()->where('status', 'accepted')->exists();

                // 2. جلب حالة طلب الطالب لهذا التدريب المحدد (إن وجد)
                $application = $student->applications()->where('training_id', $training->id)->first();
                @endphp

                @if($application)
                    {{-- إذا كان قد قدم طلباً مسبقاً، نظهر له الحالة --}}
                    @if($application->status == 'pending')
                        <button class="btn-action" disabled
                            style="background: #fef08a; color: #854d0e; width: 100%; border:none; cursor: not-allowed;">
                            <i class="fa-solid fa-hourglass-half"></i> قيد المراجعة
                        </button>
                    @elseif($application->status == 'accepted')
                        <button class="btn-action" disabled
                            style="background: #dcfce7; color: #166534; width: 100%; border:none; cursor: not-allowed;">
                            <i class="fa-solid fa-check-double"></i> تم قبولك
                        </button>
                    @elseif($application->status == 'rejected')
                        <button class="btn-action" disabled
                            style="background: #fee2e2; color: #991b1b; width: 100%; border:none; cursor: not-allowed;">
                            <i class="fa-solid fa-circle-xmark"></i> تم الرفض
                        </button>
                    @endif

                @elseif($hasActiveTraining)
                    {{-- إذا كان "مقبول" في تدريب آخر، نمنعه من التقديم --}}
                    <button class="btn-action" disabled
                        style="background: #e2e8f0; color: #64748b; width: 100%; border:none; cursor: not-allowed;">
                        <i class="fa-solid fa-lock"></i> غير متاح (لديك تدريب نشط)
                    </button>
                @else
                    {{-- الحالة الطبيعية: لم يقدم هنا، وليس لديه تدريب نشط -> نظهر زر التقديم --}}
                    <form action="{{ route('student.trainings.apply', $training->id) }}" method="POST" style="width: 100%;">
                        @csrf
                        <button type="submit" class="btn-action btn-edit"
                            style="width: 100%; background: #4a90e2; color: white; border: none;">
                            <i class="fa-solid fa-paper-plane"></i> تقديم طلب انضمام
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @endforeach

    </div>

    {{-- في حال لم تقم الجامعة بإضافة أي تدريب بعد --}}
    @if($trainings->isEmpty())
    <div style="text-align: center; padding: 50px; border: 2px dashed #cbd5e1; border-radius: 8px; margin-top: 20px;">
        <i class="fa-solid fa-box-open" style="font-size: 40px; color: #94a3b8; margin-bottom: 15px;"></i>
        <h3 style="color: #475569;">لايوجد تدريبات متاحة</h3>
        <p style="color: #64748b; margin-bottom: 20px;">لا توجد تدريبات متاحة حالياً. يرجى التحقق لاحقاً.</p>
    </div>
    @endif

</div>

@endsection
