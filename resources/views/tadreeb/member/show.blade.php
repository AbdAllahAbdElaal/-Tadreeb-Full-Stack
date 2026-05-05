@extends('tadreeb.login-parent')

@section('title' , 'بيانات الحساب')

@section('content')
<div class="text-center">
    <h2 class="text-2xl font-extrabold text-slate-900">بيانات الحساب</h2>
    <p class="mt-2 text-sm text-slate-500">عرض المعلومات</p>
</div>

<form id="signupForm" onsubmit="handleSignUp(event)" class="mt-6 space-y-4">
    <div>
        <label for="username" class="block text-sm font-semibold text-slate-700">اسم المستخدم</label>
        <input disabled type="text" id="username" name="username" value="{{ $members->username }}" placeholder="John Doe" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none">
    </div>

    <div>
        <label for="email" class="block text-sm font-semibold text-slate-700">البريد الإلكتروني</label>
        <input disabled type="email" id="email" name="email" value="{{ $members->email }}" placeholder="your.email@example.com" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none">
    </div>

    <div>
        <label for="role" class="block text-sm font-semibold text-slate-700">نوع الحساب</label>
        <select id="role" name="role" disabled
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
                <input type="text" id="name" name="name" value="{{ $members->organization->university->name }}" placeholder="University Name" required disabled
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none">
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold text-slate-700">الهاتف</label>
                <input type="text" id="phone" name="phone" value="{{ $members->organization->university->phone }}" placeholder="Phone Number" required disabled
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none">
            </div>
        </div>
    </div>

    <div>
        <label for="password" class="block text-sm font-semibold text-slate-700">كلمة المرور</label>
        <input disabled type="password" id="password" name="password" value="{{ $members->password }}" placeholder="********" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none">
    </div>

    <div class="pt-2">
        <a href="{{ route('members.index') }}" type="submit" class="btn btn-outline btn-lg w-full justify-center">رجوع</a>
    </div>
</form>

<div id="toast-container"></div>
@endsection

@section('script')
<script>
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
