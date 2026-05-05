@extends('tadreeb.parent')


@section('title' , 'profile')


@section('menu')
<li><a href="{{ route('student-dashboard') }}">
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
<li><a href="{{ route('student-profile') }}" class="active">
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
            <h1>الملف الشخصي</h1>
            <p class="breadcrumb">لوحة التحكم / إعدادات الحساب</p>
        </div>
    </div>

    {{-- عرض رسائل النجاح أو الأخطاء --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="profile-container">

        {{-- القسم الأيسر: البطاقة التعريفية --}}
        <div class="profile-card">
            @php
                // استخراج أول حرف من الاسم الأول والعائلة
                $initials = mb_substr($student->first_name, 0, 1) . mb_substr($student->last_name, 0, 1);
            @endphp
            <div class="profile-avatar">{{ $initials }}</div>
            <h3>{{ $student->first_name }} {{ $student->last_name }}</h3>
            <p>{{ $user->email }}</p>

            <div style="margin-top: 20px; text-align: left; background: #f8fafc; padding: 15px; border-radius: 8px;">
                <p style="margin-bottom: 8px;"><i class="fa-solid fa-building-columns" style="width: 25px; color: #94a3b8;"></i> <strong>الجامعة:</strong> {{ $student->university->name ?? 'غير محدد' }}</p>
                <p style="margin-bottom: 0;"><i class="fa-solid fa-graduation-cap" style="width: 25px; color: #94a3b8;"></i> <strong>الطلبات النشطة:</strong> {{ $student->applications()->count() }}</p>
            </div>
        </div>

        {{-- القسم الأيمن: نموذج تعديل البيانات --}}
        <div class="profile-form-box">
            <h3>المعلومات الشخصية والأكاديمية</h3>

            <form>
                <div class="form-row">
                    <div class="form-group-profile">
                        <label>الاسم الأول</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $student->first_name) }}" required>
                    </div>
                    <div class="form-group-profile">
                        <label>الاسم الأخير (العائلة)</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-profile">
                        <label>البريد الإلكتروني (لا يمكن تعديله)</label>
                        <input type="email" value="{{ $user->email }}" disabled title="لا يمكنك تغيير بريدك الإلكتروني">
                    </div>
                    <div class="form-group-profile">
                        <label>رقم الهاتف</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone) }}" placeholder="مثال: 0599000000">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-profile">
                        <label>التخصص الأكاديمي</label>
                        <input type="text" id="major" name="major" value="{{ old('major', $student->major) }}" placeholder="مثال: هندسة حاسوب">
                    </div>
                </div>

                <button type="button" onclick="performUpdate()" class="btn btn-primary" style="margin-top: 15px; width: 100%;">
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
        formData.append('first_name', document.getElementById('first_name').value)
        formData.append('last_name', document.getElementById('last_name').value)
        formData.append('phone', document.getElementById('phone').value)
        formData.append('major', document.getElementById('major').value)
        storeRoute('{{ route('student.profile.update') }}' , formData);
    }
</script>

@endsection
