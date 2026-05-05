@extends('tadreeb.parent')

@section('title' , 'Company Dashboard')

@section('menu')
<li><a href="{{ route('company-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('trainings.index') }}" class="active">
        <i class="fa-solid fa-book-open-reader" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('applications.index') }}">
        <i class="fa-solid fa-file-signature" style="color: #A78BFA"></i> Applications</a>
</li>
<li><a href="{{ route('company-evaluations') }}">
        <i class="fa-solid fa-star" style="color: #FBBF24"></i> Evaluations</a>
</li>
<li><a href="{{ route('company-payments') }}">
        <i class="fa-solid fa-credit-card" style="color: #38BDF8"></i> Payments</a>
</li>
<li><a href="{{ route('company-profile') }}">
        <i class="fa-solid fa-user-gear" style="color: #4154ff"></i> Profile</a>
</li>
@endsection


@php
// تقطيع الاسم لمصفوفة، أخذ أول حرف من كل كلمة، ثم دمجهم
$words = explode(' ', auth()->user()->organization->company->name);
$initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
@endphp
@section('user-avatar' , $initials)

@section('user-title' , auth()->user()->organization->company->name )

@section('profile-btn')
<a href="{{ route('company-profile') }}" class="dropdown-item profile">Profile</a>
@endsection


@section('content')
<div class="content">

    {{-- الترويسة العلوية --}}
    <div class="page-header-actions">
        <div>
            <h1>إدارة التدريبات</h1>
            <p class="breadcrumb">لوحة التحكم / تدريباتي</p>
        </div>

        <a href="{{ route('trainings.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> إضافة تدريب جديد
        </a>
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
            {{-- عملية حسابية بسيطة لمعرفة المقاعد المتبقية --}}
            @php
            $remaining_slots = $training->available_slots - ($training->accepted_count ?? 0);
            // نضمن أن الرقم لا ينزل تحت الصفر في حال حدوث خطأ برمجي سابق
            $remaining_slots = max(0, $remaining_slots);
            @endphp

            <div class="stats-container" style="display: flex; gap: 15px; margin-bottom: 15px;">

                {{-- 1. المقاعد الكلية --}}
                <div class="stat-box"
                    style="flex: 1; text-align: center; background: #f8fafc; padding: 10px; border-radius: 8px;">
                    <span class="number" style="display: block; font-size: 20px; font-weight: bold; color: #1e293b;">
                        {{ $training->available_slots }}
                    </span>
                    <span class="label" style="font-size: 12px; color: #64748b;">مقعد كلي</span>
                </div>

                {{-- 2. المقاعد المتبقية (مربع ذكي يتغير لونه إذا نفذت المقاعد) --}}
                <div class="stat-box"
                    style="flex: 1; text-align: center; background: #f8fafc; padding: 10px; border-radius: 8px;">
                    <span class="number" style="display: block; font-size: 20px; font-weight: bold;
                        color: {{ $remaining_slots > 0 ? '#10b981' : '#ef4444' }};">
                        {{ $remaining_slots }}
                    </span>
                    <span class="label" style="font-size: 12px; color: #64748b;">مقعد متبقي</span>
                </div>

                {{-- 3. إجمالي المتقدمين --}}
                <div class="stat-box"
                    style="flex: 1; text-align: center; background: #f8fafc; padding: 10px; border-radius: 8px;">
                    <span class="number" style="display: block; font-size: 20px; font-weight: bold; color: #3b82f6;">
                        {{ $training->applications_count ?? 0 }}
                    </span>
                    <span class="label" style="font-size: 12px; color: #64748b;">كل الطلبات</span>
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
                <a href="{{ route('trainings.edit', $training->id) }}" class="btn-action btn-edit">
                    <i class="fa-solid fa-pen-to-square"></i> تعديل
                </a>

                <form action="{{ route('trainings.destroy', $training->id) }}" method="POST"
                    style="flex: 1; display:flex;">
                    @csrf
                    @method('DELETE')
                    <a class="btn-action btn-delete" style="width: 100%;"
                        onclick="performDestroy({{ $training->id }} , this , '{{ route('trainings.index') }}')">
                        <i class="fa-solid fa-trash"></i> حذف
                    </a>
                </form>
            </div>
        </div>
        @endforeach

    </div>

    {{-- في حال لم تقم الشركة بإضافة أي تدريب بعد --}}
    @if($trainings->isEmpty())
    <div style="text-align: center; padding: 50px; border: 2px dashed #cbd5e1; border-radius: 8px; margin-top: 20px;">
        <i class="fa-solid fa-box-open" style="font-size: 40px; color: #94a3b8; margin-bottom: 15px;"></i>
        <h3 style="color: #475569;">لم تقم بإنشاء أي تدريبات بعد</h3>
        <p style="color: #64748b; margin-bottom: 20px;">ابدأ الآن في جذب المواهب الشابة لشركتك.</p>
        <a href="{{ route('trainings.create') }}" class="btn btn-primary">إنشاء التدريب الأول</a>
    </div>
    @endif

</div>
@endsection


@section('content2')
@endsection


@section('script')
<script>
    function performDestroy(id, reference){
        confirmDestroy('/tadreeb/trainings/' + id , reference)
    }
</script>
@endsection
