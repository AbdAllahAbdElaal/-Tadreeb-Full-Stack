@extends('tadreeb.parent')

@section('title' , 'Company Dashboard')

@section('menu')
<li><a href="{{ route('admin-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('universities.index') }}">
        <i class="fa-solid fa-building-columns" style="color: #2E5BFF"></i> Universities</a>
</li>
<li><a href="{{ route('companies.index') }}">
        <i class="fa-solid fa-city" style="color: #00C292"></i> Companies</a>
</li>
<li><a href="{{ route('students.index') }}">
        <i class="fa-solid fa-user-graduate" style="color: #FFA800"></i> Students</a>
</li>
<li><a href="{{ route('admin-trainings') }}" class="active">
        <i class="fa-solid fa-layer-group" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('plans.index') }}">
        <i class="fa-solid fa-calendar-check" style="color: #F64E60"></i> Plans</a>
</li>
@endsection

@section('user-avatar' , 'AD')

@section('user-title' , 'Admin')


@section('content')
<div class="content">

    {{-- الترويسة العلوية --}}
    <div class="page-header-actions">
        <div>
            <h1>جميع التدريبات</h1>
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
            <p style="color: #64748b; font-size: 14px; margin-top: 0; margin-bottom: 15px;">
                <i class="fa-regular fa-building"></i> {{ $training->company->name }}
            </p>

            {{-- صندوق الإحصائيات (مهم جداً للشركة) --}}
            <div class="stats-container">
                <div class="stat-box">
                    <span class="number">{{ $training->available_slots }}</span>
                    <span class="label">مقعد كلي</span>
                </div>
            </div>

            {{-- تواريخ التدريب --}}
            <div class="training-details">
                <p><i class="fa-regular fa-calendar-check"></i> <strong>البداية:</strong> {{ $training->start_date }}
                </p>
                <p><i class="fa-regular fa-calendar-xmark"></i> <strong>النهاية:</strong> {{ $training->end_date }}</p>
            </div>

        </div>
        @endforeach

    </div>

    {{-- في حال لم تقم الشركة بإضافة أي تدريب بعد --}}
    @if($trainings->isEmpty())
    <div style="text-align: center; padding: 50px; border: 2px dashed #cbd5e1; border-radius: 8px; margin-top: 20px;">
        <i class="fa-solid fa-box-open" style="font-size: 40px; color: #94a3b8; margin-bottom: 15px;"></i>
        <h3 style="color: #475569;">لم يتوفر تدريبات بعد</h3>
        <p style="color: #64748b; margin-bottom: 20px;">ابدأ الآن في جذب المواهب الشابة لشركتك.</p>
    </div>
    @endif

</div>
@endsection


@section('content2')
@endsection


@section('script')
@endsection
