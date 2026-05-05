@extends('tadreeb.login-parent')

@section('title' , 'إنشاء حساب')

@section('content')
<div class="text-center">
    <h2 class="text-2xl font-extrabold text-slate-900">إنشاء حساب جديد</h2>
    <p class="mt-2 text-sm text-slate-500">التسجيل كجامعة أو شركة</p>
</div>

<form id="create_form" onsubmit="handleSignUp(event)" class="mt-6 space-y-4">
    <div>
        <label for="username" class="block text-sm font-semibold text-slate-700">اسم المستخدم</label>
        <input type="text" id="username" name="username" placeholder="مثال: Ahmed" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
    </div>

    <div>
        <label for="email" class="block text-sm font-semibold text-slate-700">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" placeholder="name@example.com" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
    </div>

    <div>
        <label for="role" class="block text-sm font-semibold text-slate-700">نوع الحساب</label>
        <select id="role" name="role" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            <option value="">اختر النوع</option>
            <option value="university">جامعة</option>
            <option value="company">شركة</option>
        </select>
    </div>

    <div class="university_details hidden">
        <div class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <div>
                <label for="univ_name" class="block text-sm font-semibold text-slate-700">اسم الجامعة</label>
                <input type="text" id="univ_name" name="univ_name" placeholder="اسم الجامعة" required
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            </div>
            <div>
                <label for="univ_phone" class="block text-sm font-semibold text-slate-700">الهاتف</label>
                <input type="text" id="univ_phone" name="niv_phone" placeholder="رقم الهاتف" required
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            </div>
        </div>
    </div>

    <div class="company_details hidden">
        <div class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <div>
                <label for="comp_name" class="block text-sm font-semibold text-slate-700">اسم الشركة</label>
                <input type="text" id="comp_name" name="comp_name" placeholder="اسم الشركة" required
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            </div>
            <div>
                <label for="comp_phone" class="block text-sm font-semibold text-slate-700">الهاتف</label>
                <input type="text" id="comp_phone" name="comp_phone" placeholder="رقم الهاتف" required
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            </div>
            <div>
                <label for="comp_description" class="block text-sm font-semibold text-slate-700">الوصف</label>
                <input type="text" id="comp_description" name="comp_description" placeholder="وصف مختصر" required
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            </div>
            <div>
                <label for="comp_address" class="block text-sm font-semibold text-slate-700">العنوان</label>
                <input type="text" id="comp_address" name="comp_address" placeholder="العنوان" required
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
            </div>
        </div>
    </div>

    <div>
        <label for="password" class="block text-sm font-semibold text-slate-700">كلمة المرور</label>
        <input type="password" id="password" name="password" placeholder="********" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
    </div>

    <div>
        <label for="confirmPassword" class="block text-sm font-semibold text-slate-700">تأكيد كلمة المرور</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="********" required
            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
    </div>

    <button type="button" onclick="performStore()"
        class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700">
        إنشاء الحساب
    </button>
</form>

<div class="mt-6 text-center text-sm text-slate-600">
    لديك حساب؟ <a href="/tadreeb/login" class="font-bold text-indigo-700 hover:underline">تسجيل الدخول</a>
</div>

<div id="toast-container"></div>
@endsection

@section('script')
    <script src="{{ asset('tadreeb/js/app.js') }}"></script>
    <script src="{{ asset('tadreeb/js/crud.js') }}"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function performStore(){
        let formData = new FormData();

        // بيانات العضو (Member)
        formData.append('username', document.getElementById('username').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);
        formData.append('member_role', 'organization'); // دور العضو الثابت لهذه الصفحة

        // بيانات المنظمة (Organization) - جامعة أو شركة
        formData.append('org_role', document.getElementById('role').value);

        // إذا كان نوع الحساب جامعة، نقوم بإرفاق تفاصيل الجامعة
        if (document.getElementById('role').value === 'university') {
            formData.append('name', document.getElementById('univ_name').value);
            formData.append('phone', document.getElementById('univ_phone').value);
        }else if(document.getElementById('role').value === 'company'){
            formData.append('name', document.getElementById('comp_name').value);
            formData.append('phone', document.getElementById('comp_phone').value);
            formData.append('description', document.getElementById('comp_description').value);
            formData.append('address', document.getElementById('comp_address').value);
        }

        // إرسال طلب واحد فقط للكنترولر
        store('/tadreeb/members', formData);
    }

    let univ_det = document.querySelector('.university_details');
    let comp_det = document.querySelector('.company_details');
    let select = document.querySelector("#role");

    function toggleOrgDetails() {
        if(select.value == 'university'){
            univ_det.classList.remove("hidden");
            comp_det.classList.add("hidden");
        }else if(select.value == 'company'){
            comp_det.classList.remove("hidden");
            univ_det.classList.add("hidden");
        }else{
            univ_det.classList.add("hidden");
            comp_det.classList.add("hidden");
        }
    }

    if (select) {
        select.addEventListener("change", toggleOrgDetails);
        toggleOrgDetails();
    }
</script>
@endsection
