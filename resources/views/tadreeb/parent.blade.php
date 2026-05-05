<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | +Tadreeb</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('tadreeb/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('tadreeb/css/all.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('tadreeb/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        body {
            font-family: "Cairo", sans-serif;
        }

        .dashboard-fade {
            animation: dashboardFade .45s ease-out both;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 12px;
            padding: 10px 12px;
            color: rgba(255, 255, 255, .9);
            transition: all .2s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, .14);
            color: #fff;
            transform: translateX(-2px);
        }

        .sidebar-menu a i {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .13);
        }

        @media (min-width: 1024px) {
            body.sidebar-collapsed #sidebar {
                width: 88px;
                padding-left: 12px;
                padding-right: 12px;
            }

            body.sidebar-collapsed #sidebar .sidebar-menu a {
                justify-content: center;
            }

            body.sidebar-collapsed #sidebar .sidebar-menu a i {
                margin: 0;
            }

            body.sidebar-collapsed #sidebar .sidebar-menu a {
                font-size: 0;
            }

            body.sidebar-collapsed #sidebar .sidebar-menu a i {
                font-size: 14px;
            }

            body.sidebar-collapsed #sidebar .sidebar-brand-text {
                display: none;
            }

            body.sidebar-collapsed #mainContent {
                margin-right: 88px;
            }
        }

        @keyframes dashboardFade {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ------------------------------------------------------------
           Global UI Kit for existing Blade pages (legacy classes)
           Makes all pages consistent without changing backend/blade.
        ------------------------------------------------------------ */
        .content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
        }

        .page-header h1 {
            font-size: 26px;
            font-weight: 800;
            color: rgb(15, 23, 42);
            letter-spacing: -0.02em;
        }

        .breadcrumb {
            margin-top: 6px;
            font-size: 13px;
            color: rgb(100, 116, 139);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-top: 18px;
            margin-bottom: 18px;
        }

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid rgb(226, 232, 240);
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.10);
        }

        .stat-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .stat-label {
            font-size: 13px;
            color: rgb(100, 116, 139);
            font-weight: 700;
        }

        .stat-value {
            font-size: 30px;
            font-weight: 800;
            color: rgb(15, 23, 42);
            margin-top: 6px;
        }

        .stat-icon {
            height: 44px;
            width: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: rgb(241, 245, 249);
            border: 1px solid rgb(226, 232, 240);
        }

        .stat-change {
            margin-top: 10px;
            font-size: 12px;
            color: rgb(100, 116, 139);
            font-weight: 600;
        }

        .card {
            margin-top: 18px;
            background: #ffffff;
            border: 1px solid rgb(226, 232, 240);
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .card-header {
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            border-bottom: 1px solid rgb(226, 232, 240);
            background: rgb(248, 250, 252);
        }

        .card-title {
            font-size: 15px;
            font-weight: 800;
            color: rgb(15, 23, 42);
        }

        .card-body {
            padding: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: 800;
            font-size: 13px;
            border: 1px solid transparent;
            transition: all .15s ease;
            cursor: pointer;
            text-decoration: none;
            user-select: none;
        }

        .btn-sm {
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 12px;
        }

        .btn-lg {
            padding: 12px 14px;
            border-radius: 14px;
            font-size: 14px;
        }

        .btn-primary {
            background: #4f46e5;
            border-color: #4f46e5;
            color: #fff;
        }

        .btn-primary:hover {
            background: #4338ca;
            border-color: #4338ca;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: #ffffff;
            border-color: rgb(226, 232, 240);
            color: rgb(15, 23, 42);
        }

        .btn-outline:hover {
            background: rgb(248, 250, 252);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: center;
            font-size: 15px;
            font-weight: 700;
            color: rgb(100, 116, 139);
            padding: 12px 12px;
            background: rgb(248, 250, 252);
            border-bottom: 1px solid rgb(226, 232, 240);
        }

        tbody td {
            padding: 12px 12px;
            border-bottom: 1px solid rgb(241, 245, 249);
            font-size: 15px;
            text-align: center;
            color: rgb(15, 23, 42);
        }

        tbody tr:hover td {
            background: rgb(229, 231, 233);
        }
    </style>

    @yield('style')
</head>

<body dir="rtl" class="bg-slate-100 text-slate-800">
    <div class="relative min-h-screen">
        <div id="mobileOverlay" class="fixed inset-0 z-30 hidden bg-slate-900/40 backdrop-blur-sm lg:hidden"></div>

        <aside id="sidebar"
            class="fixed right-0 top-0 z-40 h-full w-72 translate-x-full border-l border-white/20 bg-gradient-to-b from-[#2A1E5C] via-[#3C1F6D] to-[#7D1E48] p-6 text-white shadow-2xl transition-transform duration-300 ease-out lg:translate-x-0">
            <div class="flex items-center justify-between">
                <a href="{{ route('index') }}" class="text-2xl font-extrabold tracking-wide">
                    <span class="sidebar-brand-text">+Tadreeb</span>
                </a>
                <button id="closeSidebar" type="button" class="rounded-lg bg-white/10 p-2 text-sm hover:bg-white/20" aria-label="إغلاق/تصغير القائمة">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
            </div>

            <ul class="sidebar-menu mt-8 space-y-2">
                @yield('menu')
            </ul>
        </aside>

        <main id="mainContent" class="min-h-screen transition-all duration-300 lg:mr-72">
            <nav class="sticky top-0 z-20 border-b border-slate-200/70 bg-white/90 px-4 py-3 backdrop-blur-sm sm:px-6">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <button id="openSidebar" type="button"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:bg-slate-50 lg:hidden"
                            aria-label="فتح القائمة">
                            <i class="fa-solid fa-bars"></i>
                        </button>

                        <div class="hidden items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 sm:flex">
                            <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
                            <input type="text" placeholder="بحث سريع..."
                                class="w-36 bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400 md:w-64">
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <button id="userMenuBtn" type="button"
                                class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition hover:bg-slate-50">
                                <span class="inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-indigo-100 font-bold text-indigo-700">
                                    @yield('user-avatar')
                                </span>
                                <span class="hidden max-w-32 truncate font-semibold text-slate-700 sm:block">@yield('user-title')</span>
                                <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
                            </button>

                            <div id="userMenu"
                                class="invisible absolute left-0 mt-2 w-56 translate-y-2 rounded-xl border border-slate-200 bg-white p-2 opacity-0 shadow-xl transition-all duration-200">
                                <div class="rounded-lg p-1 hover:bg-slate-50">
                                    @yield('profile-btn')
                                </div>
                                <a href="{{ route('login') }}"
                                    class="mt-1 flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-rose-600 transition hover:bg-rose-50">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>تسجيل الخروج</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <section class="dashboard-fade p-4 sm:p-6">
                @yield('content')
            </section>
        </main>
    </div>

    @yield('content2')

    <script src="{{ asset('tadreeb/js/app.js') }}"></script>
    <script src="{{ asset('tadreeb/js/crud.js') }}"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        (function () {
            const sidebar = document.getElementById("sidebar");
            const openSidebar = document.getElementById("openSidebar");
            const closeSidebar = document.getElementById("closeSidebar");
            const mobileOverlay = document.getElementById("mobileOverlay");
            const userMenuBtn = document.getElementById("userMenuBtn");
            const userMenu = document.getElementById("userMenu");
            const isDesktop = window.matchMedia("(min-width: 1024px)");

            function showSidebar() {
                if (!sidebar) return;
                sidebar.classList.remove("translate-x-full");
                if (mobileOverlay) mobileOverlay.classList.remove("hidden");
            }

            function hideSidebar() {
                if (!sidebar) return;
                sidebar.classList.add("translate-x-full");
                if (mobileOverlay) mobileOverlay.classList.add("hidden");
            }

            if (openSidebar) openSidebar.addEventListener("click", showSidebar);
            if (closeSidebar) {
                closeSidebar.addEventListener("click", function () {
                    if (isDesktop.matches) {
                        document.body.classList.toggle("sidebar-collapsed");
                        localStorage.setItem("sidebar-collapsed", document.body.classList.contains("sidebar-collapsed") ? "1" : "0");
                        return;
                    }
                    hideSidebar();
                });
            }
            if (mobileOverlay) mobileOverlay.addEventListener("click", hideSidebar);

            if (isDesktop.matches && localStorage.getItem("sidebar-collapsed") === "1") {
                document.body.classList.add("sidebar-collapsed");
            }

            if (userMenuBtn && userMenu) {
                userMenuBtn.addEventListener("click", function (e) {
                    e.stopPropagation();
                    const isOpen = userMenu.classList.contains("visible");
                    userMenu.classList.toggle("visible", !isOpen);
                    userMenu.classList.toggle("opacity-100", !isOpen);
                    userMenu.classList.toggle("translate-y-0", !isOpen);
                    userMenu.classList.toggle("invisible", isOpen);
                    userMenu.classList.toggle("opacity-0", isOpen);
                    userMenu.classList.toggle("translate-y-2", isOpen);
                });

                document.addEventListener("click", function (event) {
                    if (!userMenu.contains(event.target) && !userMenuBtn.contains(event.target)) {
                        userMenu.classList.remove("visible", "opacity-100", "translate-y-0");
                        userMenu.classList.add("invisible", "opacity-0", "translate-y-2");
                    }
                });
            }
        })();
    </script>

    @yield('script')
</body>

</html>
