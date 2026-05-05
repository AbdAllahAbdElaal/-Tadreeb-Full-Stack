<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - +Tadreeb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('tadreeb/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: "Cairo", sans-serif;
        }
    </style>
</head>


<body dir="rtl" class="min-h-screen bg-slate-100 text-slate-800">
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">
            <div class="mb-6 text-center">
                <a href="{{ route('index') }}" class="inline-flex items-center justify-center gap-2 font-extrabold text-2xl text-slate-900">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-[#2A1E5C] via-[#3C1F6D] to-[#7D1E48] text-white shadow-lg">+</span>
                    <span>+Tadreeb</span>
                </a>
                <p class="mt-2 text-sm text-slate-500">نظام إدارة التدريب الميداني</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                @yield('content')
            </div>

            <p class="mt-6 text-center text-xs text-slate-400">© {{ date('Y') }} +Tadreeb</p>
        </div>
    </div>

    <script src="{{ asset('tadreeb/js/app.js') }}"></script>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@yield('script')
