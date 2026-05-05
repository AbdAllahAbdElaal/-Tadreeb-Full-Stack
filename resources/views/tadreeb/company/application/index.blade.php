@extends('tadreeb.parent')

@section('title' , 'Company Dashboard')

@section('menu')
<li><a href="{{ route('company-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('trainings.index') }}">
        <i class="fa-solid fa-book-open-reader" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('applications.index') }}" class="active">
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
    <div class="page-header-actions"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h1>طلبات الانضمام المكتملة</h1>
            <p class="breadcrumb">لوحة التحكم / طلبات الطلاب</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="overflow-x: auto;">
            <table class="table table-hover" style="width: 100%; border-collapse: collapse; text-align: right;">
                <thead style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <tr>
                        <th style="padding: 12px;">اسم الطالب</th>
                        <th style="padding: 12px;">التخصص</th>
                        <th style="padding: 12px;">الجامعة</th>
                        <th style="padding: 12px;">التدريب المتقدم له</th>
                        <th style="padding: 12px;">تاريخ التقديم</th>
                        <th style="padding: 12px;">الحالة</th>
                        <th style="padding: 12px; text-align: center;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    <tr id="app-row-{{ $app->id }}" style="border-bottom: 1px solid #e2e8f0;">

                        {{-- بيانات الطالب --}}
                        <td style="padding: 12px;">
                            <strong>{{ $app->student->first_name }} {{ $app->student->last_name }}</strong><br>
                            <small style="color: #64748b;">{{ $app->student->phone ?? 'لا يوجد رقم' }}</small>
                        </td>

                        {{-- التخصص والمعدل --}}
                        <td style="padding: 12px;">
                            {{ $app->student->major ?? 'غير محدد' }}
                        </td>

                        {{-- الجامعة --}}
                        <td style="padding: 12px;">{{ $app->student->university->name ?? 'غير محدد' }}</td>

                        {{-- التدريب --}}
                        <td style="padding: 12px;">
                            <span style="font-weight: bold; color: #4f46e5;">{{ $app->training->title }}</span><br>
                        </td>

                        {{-- التاريخ --}}
                        <td style="padding: 12px;">{{ $app->created_at->format('Y-m-d') }}</td>

                        {{-- الحالة --}}
                        <td style="padding: 12px;" id="status-cell-{{ $app->id }}">
                            @if($app->status == 'pending')
                            <span
                                style="background: #fef3c7; color: #d97706; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;">قيد
                                المراجعة</span>
                            @elseif($app->status == 'accepted')
                            <span
                                style="background: #d1fae5; color: #059669; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;">مقبول</span>
                            @else
                            <span
                                style="background: #fee2e2; color: #b91c1c; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;">مرفوض</span>
                            @endif
                        </td>

                        {{-- الأزرار (تظهر فقط إذا كان الطلب قيد المراجعة) --}}
                        <td style="padding: 12px; text-align: center;" id="action-cell-{{ $app->id }}">
                            @if($app->status == 'pending')
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <button onclick="performUpdate({{ $app->id }})" class="btn"
                                        style="background: #10b981; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                                        <i class="fa-solid fa-check"></i> قبول
                                    </button>
                                    <button onclick="performDestroy({{ $app->id }}, this)" class="btn"
                                        style="background: #ef4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                                        <i class="fa-solid fa-xmark"></i> رفض
                                    </button>
                                </div>
                            @else
                                <span style="color: #94a3b8; font-size: 12px;">تم اتخاذ قرار</span>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px; color: #64748b;">
                            لا يوجد أي طلبات انضمام حتى الآن.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection




@section('script')
<script>
    function performUpdate(id){
            let formData = new FormData();

            formData.append('status', 'accepted');

            storeRoute('/tadreeb/applications-update/'+id , formData);
        }

    function performDestroy(id, reference){
        confirmDestroy('/tadreeb/applications-destroy/' + id , reference)
    }
</script>
@endsection
