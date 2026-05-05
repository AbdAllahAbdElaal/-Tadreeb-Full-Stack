@extends('tadreeb.parent')


@section('title' , 'Available Trainings')


@section('menu')
<li><a href="{{ route('student-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a></li>
<li><a href="{{ route('student-trainings') }}">
        <i class="fa-solid fa-book-open-reader" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('student-applications') }}" class="active">
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
    <div class="page-header-actions">
        <div>
            <h1>متابعة الطلبات</h1>
            <p class="breadcrumb">لوحة التحكم / طلبات الانضمام</p>
        </div>
    </div>

    <div class="applications-list">
        @forelse($applications as $app)

            {{-- تحديد الـ Class المناسب بناءً على حالة الطلب --}}
            @php
                $itemClass = '';
                $badgeClass = '';
                $icon = '';
                $statusText = '';

                if($app->status == 'pending') {
                    $itemClass = 'item-pending';
                    $badgeClass = 'badge-pending';
                    $icon = 'fa-hourglass-half';
                    $statusText = 'قيد المراجعة';
                } elseif($app->status == 'accepted') {
                    $itemClass = 'item-accepted';
                    $badgeClass = 'badge-accepted';
                    $icon = 'fa-check-circle';
                    $statusText = 'تم القبول';
                } else {
                    $itemClass = 'item-rejected';
                    $badgeClass = 'badge-rejected';
                    $icon = 'fa-times-circle';
                    $statusText = 'مرفوض';
                }
            @endphp

            <div class="application-item {{ $itemClass }}">
                <div class="app-info">
                    <h3>{{ $app->training->title ?? 'تدريب محذوف' }}</h3>
                    <p><i class="fa-regular fa-building"></i> <strong>الشركة:</strong> {{ $app->training->company->name ?? 'غير محدد' }}</p>
                    <p><i class="fa-regular fa-calendar"></i> <strong>تاريخ التقديم:</strong> {{ $app->created_at->format('Y-m-d') }}</p>
                </div>

                <div class="app-status">
                    <span class="app-status-badge {{ $badgeClass }}">
                        <i class="fa-solid {{ $icon }}"></i> {{ $statusText }}
                    </span>

                    {{-- لمسة احترافية: زر لإلغاء الطلب إذا كان لا يزال قيد المراجعة --}}
                    @if($app->status == 'pending')
                        <button type="button"
                                onclick="performDestroy({{ $app->id }} , this)"
                                style="margin-top: 10px; width: 100%; padding: 5px; background: transparent; border: 1px solid #cbd5e1; border-radius: 5px; color: #64748b; cursor: pointer; font-size: 12px; transition: 0.3s;"
                                onmouseover="this.style.color='#ef4444'; this.style.borderColor='#ef4444';"
                                onmouseout="this.style.color='#64748b'; this.style.borderColor='#cbd5e1';">
                            <i class="fa-solid fa-trash"></i> إلغاء الطلب
                        </button>
                    @endif
                </div>
            </div>

        @empty
            <div style="text-align: center; padding: 50px; border: 2px dashed #cbd5e1; border-radius: 8px;">
                <i class="fa-solid fa-folder-open" style="font-size: 40px; color: #94a3b8; margin-bottom: 15px;"></i>
                <h3 style="color: #475569;">لم تقم بتقديم أي طلبات بعد</h3>
                <a href="{{ route('student-trainings') }}" class="btn btn-primary mt-2">تصفح التدريبات المتاحة</a>
            </div>
        @endforelse
    </div>
</div>

@endsection


@section('script')

<script>
    function performDestroy(id, reference){
        confirmDestroy('/tadreeb/applications/' + id , reference)
    }
</script>

@endsection
