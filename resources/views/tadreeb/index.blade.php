<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>+Tadreeb | منصة إدارة التدريب الميداني</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('tadreeb/css/style.css') }}">
    <style>
        body { font-family: "Cairo", sans-serif; }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">
    <header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-3 px-4 py-4 sm:px-6">
            <a href="{{ route('index') }}" class="inline-flex items-center gap-2 font-extrabold text-slate-900">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-[#2A1E5C] via-[#3C1F6D] to-[#7D1E48] text-white shadow-lg">+</span>
                <span class="text-lg sm:text-xl">Tadreeb</span>
            </a>

            <nav class="hidden items-center gap-6 text-sm font-semibold text-slate-600 md:flex">
                <a href="#features" class="hover:text-slate-900">المميزات</a>
                <a href="#how" class="hover:text-slate-900">كيف تعمل</a>
                <a href="#pricing" class="hover:text-slate-900">الخطط</a>
                <a href="#contact" class="hover:text-slate-900">تواصل معنا</a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    تسجيل الدخول
                </a>
                <a href="{{ route('login') }}"
                    class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-extrabold text-white shadow-sm transition hover:bg-indigo-700">
                    ابدأ الآن
                </a>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-white via-slate-50 to-slate-50"></div>
        <div class="absolute -top-16 right-0 h-80 w-80 rounded-full bg-indigo-200/40 blur-3xl"></div>
        <div class="absolute -bottom-20 left-0 h-80 w-80 rounded-full bg-rose-200/40 blur-3xl"></div>

        <div class="relative mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20">
            <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1 text-xs font-bold text-slate-700 shadow-sm ring-1 ring-slate-200">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        منصة عربية حديثة لإدارة التدريب
                    </div>
                    <h1 class="mt-4 text-3xl font-extrabold leading-tight text-slate-900 sm:text-5xl">
                        إدارة التدريب الميداني
                        <span class="bg-gradient-to-l from-indigo-600 to-rose-600 bg-clip-text text-transparent">ببساطة واحتراف</span>
                    </h1>
                    <p class="mt-4 max-w-xl text-base leading-8 text-slate-600">
                        +Tadreeb منصة متكاملة للجامعات والشركات والطلاب لإدارة البرامج التدريبية، متابعة التقدم، التقارير، والتقييمات من لوحة واحدة.
                    </p>
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-extrabold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-indigo-700">
                            <span>ابدأ الآن</span>
                            <i class="fa-solid fa-rocket"></i>
                        </a>
                        <a href="#features"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50">
                            <span>اعرف المزيد</span>
                            <i class="fa-solid fa-circle-info text-slate-400"></i>
                        </a>
                    </div>
                    <div class="mt-6 flex flex-wrap items-center gap-4 text-xs text-slate-500">
                        <div class="inline-flex items-center gap-2">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                                <i class="fa-solid fa-check text-[10px]"></i>
                            </span>
                            واجهة عربية RTL
                        </div>
                        <div class="inline-flex items-center gap-2">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-indigo-100 text-indigo-700">
                                <i class="fa-solid fa-check text-[10px]"></i>
                            </span>
                            تجربة سلسة وحديثة
                        </div>
                        <div class="inline-flex items-center gap-2">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-rose-100 text-rose-700">
                                <i class="fa-solid fa-check text-[10px]"></i>
                            </span>
                            مناسب للجامعة والشركة والطالب
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="rounded-2xl bg-gradient-to-l from-[#2A1E5C] via-[#3C1F6D] to-[#7D1E48] p-6 text-white">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-sm text-white/80">لوحة تحكم</div>
                                <div class="mt-1 text-xl font-extrabold">ملخص سريع</div>
                            </div>
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white/15">
                                <i class="fa-solid fa-chart-line"></i>
                            </span>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-xs text-white/75">الجامعات</div>
                                <div class="mt-2 text-2xl font-extrabold">
                                    {{ $universitiesCount }}
                                </div>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-xs text-white/75">الطلاب</div>
                                <div class="mt-2 text-2xl font-extrabold">
                                    {{ $studentsCount }}
                                </div>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-xs text-white/75">الشركات</div>
                                <div class="mt-2 text-2xl font-extrabold">
                                    {{ $companiesCount }}
                                </div>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <div class="text-xs text-white/75">التدريبات</div>
                                <div class="mt-2 text-2xl font-extrabold">
                                    {{ $trainingsCount }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-sm font-bold text-slate-800">للجامعات</div>
                            <p class="mt-2 text-sm text-slate-600">إدارة الطلاب والمشرفين ومتابعة التقدم.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-sm font-bold text-slate-800">للشركات</div>
                            <p class="mt-2 text-sm text-slate-600">طرح الفرص التدريبية ومراجعة الطلبات.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 sm:text-3xl">مميزات قوية</h2>
                <p class="mt-2 max-w-2xl text-sm text-slate-600">صُممت لتناسب احتياجات الجامعات والشركات والطلاب بوضوح وتجربة سهلة.</p>
            </div>
            <a href="{{ route('login') }}" class="text-sm font-bold text-indigo-700 hover:underline">تسجيل الدخول</a>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-3">
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <h3 class="text-lg font-extrabold text-slate-900">للجامعات</h3>
                <p class="mt-2 text-sm leading-7 text-slate-600">إدارة الطلاب والمشرفين، متابعة الساعات والتقارير، ومراقبة تقدم التدريب بسهولة.</p>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                    <i class="fa-solid fa-city"></i>
                </div>
                <h3 class="text-lg font-extrabold text-slate-900">للشركات</h3>
                <p class="mt-2 text-sm leading-7 text-slate-600">طرح فرص تدريب، مراجعة الطلبات، اختيار المتدربين، وإجراء التقييمات.</p>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="mb-4 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <h3 class="text-lg font-extrabold text-slate-900">للطلاب</h3>
                <p class="mt-2 text-sm leading-7 text-slate-600">استعراض الفرص، التقديم بسرعة، متابعة الساعات، ورفع التقارير الأسبوعية.</p>
            </article>
        </div>
    </section>

    <!-- How it works -->
    <section id="how" class="bg-white/60 border-y border-slate-200/60">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
            <h2 class="text-2xl font-extrabold text-slate-900 sm:text-3xl">كيف تعمل المنصة؟</h2>
            <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-3">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700 font-extrabold">1</div>
                    <h3 class="font-extrabold text-slate-900">التسجيل</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">إنشاء حساب وإكمال الملف الشخصي للجامعة/الشركة/الطالب.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-sky-100 text-sky-700 font-extrabold">2</div>
                    <h3 class="font-extrabold text-slate-900">الربط</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">طرح الفرص والتقديم عليها، ومتابعة عملية القبول بسهولة.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-100 text-amber-700 font-extrabold">3</div>
                    <h3 class="font-extrabold text-slate-900">المتابعة والتقييم</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">تقارير، ساعات، تقييمات، ولوحات متابعة واضحة للجميع.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 sm:text-3xl">خطط مرنة</h2>
                <p class="mt-2 text-sm text-slate-600">اختر الخطة المناسبة—ويمكن الترقية لاحقًا.</p>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-3">
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-extrabold text-slate-900">Basic</h3>
                <div class="mt-3 text-3xl font-extrabold text-slate-900">$99 <span class="text-sm font-bold text-slate-500">/ month</span></div>
                <ul class="mt-5 space-y-2 text-sm text-slate-600">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Up to 100 students</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> 5 training programs</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Basic reporting</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Email support</li>
                </ul>
                <a href="{{ route('login') }}"
                    class="mt-6 inline-flex w-full items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-extrabold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    ابدأ الآن
                </a>
            </article>

            <article class="rounded-3xl border border-indigo-200 bg-gradient-to-b from-indigo-50 to-white p-6 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                    <h3 class="text-lg font-extrabold text-slate-900">Professional</h3>
                    <span class="rounded-full bg-indigo-600 px-3 py-1 text-xs font-extrabold text-white">الأكثر استخدامًا</span>
                </div>
                <div class="mt-3 text-3xl font-extrabold text-slate-900">$249 <span class="text-sm font-bold text-slate-500">/ month</span></div>
                <ul class="mt-5 space-y-2 text-sm text-slate-600">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-indigo-700"></i> Up to 500 students</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-indigo-700"></i> Unlimited training programs</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-indigo-700"></i> Advanced analytics</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-indigo-700"></i> Priority support</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-indigo-700"></i> API access</li>
                </ul>
                <a href="{{ route('login') }}"
                    class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-extrabold text-white shadow-sm transition hover:bg-indigo-700">
                    ابدأ الآن
                </a>
            </article>

            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-extrabold text-slate-900">Enterprise</h3>
                <div class="mt-3 text-3xl font-extrabold text-slate-900">Custom</div>
                <ul class="mt-5 space-y-2 text-sm text-slate-600">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Unlimited students</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Unlimited training programs</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Custom integrations</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Dedicated support</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> On-premise deployment</li>
                </ul>
                <a href="{{ route('login') }}"
                    class="mt-6 inline-flex w-full items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-extrabold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    تواصل معنا
                </a>
            </article>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="bg-white border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
            <h2 class="text-2xl font-extrabold text-slate-900 sm:text-3xl">تواصل معنا</h2>
            <p class="mt-2 text-sm text-slate-600">أرسل رسالتك وسنعاود التواصل قريبًا.</p>

            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h3 class="text-lg font-extrabold text-slate-900">معلومات سريعة</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">نحن هنا لمساعدتك في البدء واختيار الخطة المناسبة.</p>
                    <div class="mt-4 space-y-3 text-sm text-slate-700">
                        <div class="flex items-center gap-2"><i class="fa-regular fa-envelope text-slate-400"></i> support@tadreeb.com</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-phone text-slate-400"></i> +966 000 000 000</div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700">الاسم</label>
                            <input type="text" placeholder="اسمك"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700">البريد الإلكتروني</label>
                            <input type="email" placeholder="name@example.com"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700">الرسالة</label>
                            <textarea placeholder="كيف يمكننا مساعدتك؟" rows="5"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100"></textarea>
                        </div>
                        <button class="w-full rounded-xl bg-indigo-600 px-4 py-3 text-sm font-extrabold text-white shadow-sm transition hover:bg-indigo-700"
                            onclick="showAlert('تم استلام رسالتك! سنعاود التواصل قريبًا.', 'success')">
                            إرسال
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="border-t border-slate-200 bg-slate-50">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div>
                    <div class="font-extrabold text-slate-900">+Tadreeb</div>
                    <p class="mt-2 text-sm text-slate-600">منصة لإدارة التدريب الميداني للجامعات والشركات والطلاب.</p>
                </div>
                <div>
                    <div class="font-extrabold text-slate-900">المنتج</div>
                    <ul class="mt-3 space-y-2 text-sm text-slate-600">
                        <li><a href="#features" class="hover:text-slate-900">المميزات</a></li>
                        <li><a href="#pricing" class="hover:text-slate-900">الخطط</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-slate-900">تسجيل الدخول</a></li>
                    </ul>
                </div>
                <div>
                    <div class="font-extrabold text-slate-900">الدعم</div>
                    <ul class="mt-3 space-y-2 text-sm text-slate-600">
                        <li><a href="#contact" class="hover:text-slate-900">تواصل معنا</a></li>
                        <li><a href="#" class="hover:text-slate-900">مركز المساعدة</a></li>
                        <li><a href="#" class="hover:text-slate-900">الوثائق</a></li>
                    </ul>
                </div>
                <div>
                    <div class="font-extrabold text-slate-900">قانوني</div>
                    <ul class="mt-3 space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-slate-900">سياسة الخصوصية</a></li>
                        <li><a href="#" class="hover:text-slate-900">الشروط والأحكام</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 flex flex-col gap-3 border-t border-slate-200 pt-6 text-center text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:text-right">
                <p>© {{ date('Y') }} +Tadreeb. جميع الحقوق محفوظة.</p>
                <p>صُممت لتجربة عربية حديثة.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('tadreeb/js/app.js') }}"></script>
    <div id="toast-container"></div>
</body>

</html>
