@extends('tadreeb.parent')


@section('title' , 'profile')


@section('menu')
<li><a href="{{ route('company-dashboard') }}">
    <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('trainings.index') }}">
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
<li><a href="{{ route('company-profile') }}" class="active">
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
    <div class="page-header-actions">
        <div>
            <h1>ملف الشركة (Company Profile)</h1>
            <p class="breadcrumb">لوحة التحكم / إعدادات الحساب</p>
        </div>
    </div>

    <div class="profile-container" style="display: flex; gap: 30px; align-items: flex-start; margin-top: 20px;">

        {{-- القسم الأيسر: البطاقة التعريفية للشركة --}}
        <div class="profile-card" style="background: #fff; border-radius: 12px; padding: 30px 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.03); flex: 1; min-width: 250px;">
            @php
                // استخراج أول حرفين من اسم الشركة للوجو الرمزي
                $words = explode(' ', $company->name);
                $initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
            @endphp
            <div class="profile-avatar" style="width: 100px; height: 100px; background: #3b82f6; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: bold; margin: 0 auto 15px auto;">
                {{ $initials }}
            </div>
            <h3 style="margin: 0 0 5px 0; color: #1e293b;">{{ $company->name }}</h3>
            <p style="color: #64748b; font-size: 14px;">{{ $user->email }}</p>

            <div style="margin-top: 20px; text-align: left; background: #f8fafc; padding: 15px; border-radius: 8px;">
                <p style="margin-bottom: 8px;"><i class="fa-solid fa-briefcase" style="width: 25px; color: #94a3b8;"></i> <strong>المجال:</strong> {{ $company->industry ?? 'غير محدد' }}</p>
                <p style="margin-bottom: 0;"><i class="fa-solid fa-map-location-dot" style="width: 25px; color: #94a3b8;"></i> <strong>المقر:</strong> {{ $company->address ?? 'غير محدد' }}</p>
            </div>
        </div>

        {{-- القسم الأيمن: نموذج تعديل البيانات --}}
        <div class="profile-form-box" style="background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); flex: 2;">
            <h3 style="margin-top: 0; margin-bottom: 25px; color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">بيانات المؤسسة</h3>

            <form id="companyProfileForm">
                <div class="row" style="display: flex; gap: 20px; margin-bottom: 20px;">
                    <div class="form-group" style="flex: 1;">
                        <label style="font-weight: bold; margin-bottom: 8px; display: block;">اسم الشركة</label>
                        <input type="text" id="name" class="form-control" value="{{ $company->name }}" required>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label style="font-weight: bold; margin-bottom: 8px; display: block;">البريد الإلكتروني (تسجيل الدخول)</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled title="لا يمكنك تغيير إيميل الدخول من هنا">
                    </div>
                </div>

                <div class="row" style="display: flex; gap: 20px; margin-bottom: 20px;">
                    <div class="form-group" style="flex: 1;">
                        <label style="font-weight: bold; margin-bottom: 8px; display: block;">رقم الهاتف</label>
                        <input type="text" id="phone" class="form-control" value="{{ $company->phone }}" required>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label style="font-weight: bold; margin-bottom: 8px; display: block;">العنوان (المقر الرئيسي)</label>
                        <input type="text" id="address" class="form-control" value="{{ $company->address }}" placeholder="مثال: غزة، شارع عمر المختار...">
                    </div>
                </div>

                <div class="row" style="margin-bottom: 20px;">
                    <div class="form-group" style="width: 100%;">
                        <label style="font-weight: bold; margin-bottom: 8px; display: block;">نبذة عن الشركة (Description)</label>
                        <textarea id="description" class="form-control" rows="4" placeholder="اكتب نبذة مختصرة عن نشاط الشركة ورؤيتها...">{{ $company->description }}</textarea>
                    </div>
                </div>

                <button type="button" onclick="performUpdate()" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 16px;">
                    <i class="fa-solid fa-floppy-disk"></i> حفظ التعديلات
                </button>
            </form>
        </div>

    </div>
</div>
@endsection



@section('script')
<script>
    function performUpdate(){
        let formData = new FormData();

        formData.append('_method', 'PUT');

        formData.append('name', document.getElementById('name').value);
        formData.append('phone', document.getElementById('phone').value);
        formData.append('address', document.getElementById('address').value);
        formData.append('description', document.getElementById('description').value);

        storeRoute('{{ route('company.profile.update') }}' , formData);
    }
</script>
@endsection
