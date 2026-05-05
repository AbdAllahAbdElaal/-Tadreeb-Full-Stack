@extends('tadreeb.login-parent')

@section('title' , 'تعديل البيانات')

@section('content')
<div class="text-center">
    <h2 class="text-2xl font-extrabold text-slate-900">تعديل البيانات</h2>
    <p class="mt-2 text-sm text-slate-500">حدّث معلومات الحساب</p>
</div>

<form id="signupForm" onsubmit="handleSignUp(event)" class="mt-6 space-y-4">
    <div>
        <label for="username" class="block text-sm font-semibold text-slate-700">اسم المستخدم</label>
        <input type="text" id="username" name="username" value="{{ $members->username }}" placeholder="John Doe" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
    </div>

    <div>
        <label for="email" class="block text-sm font-semibold text-slate-700">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" value="{{ $members->email }}" placeholder="your.email@example.com" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
    </div>

    <div>
        <label for="role" class="block text-sm font-semibold text-slate-700">نوع الحساب</label>
        <select disabled id="role" name="role" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none">
            <option value="">Select Type</option>
            <option value="university" {{ ($members->organization->role ?? '') == 'university' ? 'selected' : '' }}>University</option>
            <option value="company" {{ ($members->organization->role ?? '') == 'company' ? 'selected' : '' }}>Company</option>
        </select>
    </div>

    <div class="university_details hidden">
        <div class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700">اسم الجامعة</label>
                <input type="text" id="name" name="name" value="{{ $members->organization->university->name }}" placeholder="University Name" required
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold text-slate-700">الهاتف</label>
                <input type="text" id="phone" name="phone" value="{{ $members->organization->university->phone }}" placeholder="Phone Number" required
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            </div>
        </div>
    </div>

    <div>
        <label for="password" class="block text-sm font-semibold text-slate-700">كلمة المرور</label>
        <input type="password" id="password" name="password" value="{{ $members->password }}" placeholder="********" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
    </div>

    <div class="flex flex-col sm:flex-row gap-2 pt-2">
        <a type="button" onclick="performUpdate({{ $members->id }})"
            class="btn btn-primary btn-lg w-full sm:w-auto justify-center">حفظ التعديل</a>
        <a href="{{ route('members.index') }}" type="submit"
            class="btn btn-outline btn-lg w-full sm:w-auto justify-center">رجوع</a>
    </div>
</form>

<div id="toast-container"></div>
@endsection

@section('script')
<script>
    function performUpdate(id){
        let formData = new FormData();

        // بيانات العضو (Member)
        formData.append('username', document.getElementById('username').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);

        // إذا كان نوع الحساب جامعة، نقوم بإرفاق تفاصيل الجامعة
        if (document.getElementById('role').value === 'university') {
            formData.append('name', document.getElementById('name').value);
            formData.append('phone', document.getElementById('phone').value);
        }

        // إرسال طلب واحد فقط للكنترولر
        storeRoute('/tadreeb/members-update/'+id , formData);
    }

    let uni_det = document.querySelector('.university_details');
    let select = document.querySelector("#role");

    if(select && uni_det){
        if(select.value == 'university'){
            uni_det.classList.remove("hidden");
        }else{
            uni_det.classList.add("hidden");
        }
    }
</script>
@endsection
