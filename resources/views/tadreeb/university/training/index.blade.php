@extends('tadreeb.parent')

@section('title' , 'Company Dashboard')

@section('menu')
<li><a href="{{ route('university-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('university.my-students') }}">
        <i class="fa-solid fa-user-graduate" style="color: #FFA800"></i> Students</a>
</li>
<li><a href="{{ route('university-supervisors') }}">
        <i class="fa-solid fa-user-tie" style="color: #818CF8"></i> Supervisors</a>
</li>
<li><a href="{{ route('university-trainings') }}" class="active">
        <i class="fa-solid fa-book-open-reader" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('university-payments') }}">
        <i class="fa-solid fa-credit-card" style="color: #38BDF8"></i> Payments</a>
</li>
@endsection

@php
// تقطيع الاسم لمصفوفة، أخذ أول حرف من كل كلمة، ثم دمجهم
$words = explode(' ', auth()->user()->organization->university->name);
$initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
@endphp
@section('user-avatar' , $initials)

@section('user-title' , auth()->user()->organization->university->name )



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

            {{-- صندوق الإحصائيات (مهم جداً للشركة) --}}
            <div class="stats-container">
                <div class="stat-box">
                    <span class="number">{{ $training->available_slots }}</span>
                    <span class="label">مقعد كلي</span>
                </div>
                <div class="stat-box">
                    {{-- ملاحظة: هذا يتطلب withCount('applications') في الكنترولر --}}
                    <span class="number" style="color: #4a90e2;">{{ $training->applications_count ?? 0 }}</span>
                    <span class="label">طلبات الانضمام</span>
                </div>
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
                // نتحقق هل الجامعة الحالية قامت بإضافة هذا التدريب مسبقاً؟
                $university = auth()->user()->organization->university;
                $isApproved = $university->approvedTrainings->contains($training->id);
                @endphp

                @if($isApproved)
                {{-- إذا تمت الإضافة، نظهر زر معطل لونه أخضر --}}
                <button class="btn-action"
                    style="background: #dcfce7; color: #166534; width: 100%; border:none; cursor: default;">
                    <i class="fa-solid fa-check-circle"></i> متاح لطلابك
                </button>
                @else
                {{-- إذا لم تتم الإضافة، نظهر فورم الإضافة --}}
                <form action="{{ route('university.trainings.approve', $training->id) }}" method="POST"
                    style="width: 100%;">
                    @csrf
                    <button type="submit" class="btn-action btn-edit"
                        style="width: 100%; background: #4f46e5; color: white;">
                        <i class="fa-solid fa-plus"></i> إضافة للطلاب
                    </button>
                </form>
                @endif
            </div>
        </div>
        @endforeach

    </div>

    {{-- في حال لم تقم الشركة بإضافة أي تدريب بعد --}}
    @if($trainings->isEmpty())
    <div style="text-align: center; padding: 50px; border: 2px dashed #cbd5e1; border-radius: 8px; margin-top: 20px;">
        <i class="fa-solid fa-box-open" style="font-size: 40px; color: #94a3b8; margin-bottom: 15px;"></i>
        <h3 style="color: #475569;">لا توجد تدريبات متاحة حالياً</h3>
        <p style="color: #64748b; margin-bottom: 20px;">يمكنك التحقق من التدريبات المتاحة في وقت لاحق.</p>
    </div>
    @endif

</div>
@endsection


@section('content2')
@endsection


@section('script')

@endsection
