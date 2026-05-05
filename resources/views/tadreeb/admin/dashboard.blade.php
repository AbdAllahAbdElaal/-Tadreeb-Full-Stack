@extends('tadreeb.parent')

@section('title' , 'Admin Dashboard')


@section('menu')
<li><a href="{{ route('admin-dashboard') }}" class="active rounded-2xl px-3 py-2 text-white/90 transition">
    <i class="fa-solid fa-house"></i> Dashboard</a>
</li>
<li><a href="{{ route('universities.index') }}" class="rounded-2xl px-3 py-2 text-white/85 hover:text-white transition">
    <i class="fa-solid fa-building-columns"></i> Universities</a>
</li>
<li><a href="{{ route('companies.index') }}" class="rounded-2xl px-3 py-2 text-white/85 hover:text-white transition">
    <i class="fa-solid fa-city"></i> Companies</a>
</li>
<li><a href="{{ route('students.index') }}" class="rounded-2xl px-3 py-2 text-white/85 hover:text-white transition">
    <i class="fa-solid fa-user-graduate"></i> Students</a>
</li>
<li><a href="{{ route('admin-trainings') }}" class="rounded-2xl px-3 py-2 text-white/85 hover:text-white transition">
    <i class="fa-solid fa-layer-group"></i> Trainings</a>
</li>
<li><a href="{{ route('plans.index') }}" class="rounded-2xl px-3 py-2 text-white/85 hover:text-white transition">
    <i class="fa-solid fa-calendar-check"></i> Plans</a>
</li>
{{-- <li><a href="{{ route('admin-reports') }}">
    <i class="fa-solid fa-chart-line" style="color: #F64E60"></i> Reports</a>
</li> --}}
{{-- <li><a href="{{ route('members.index') }}">
    <i class="fa-solid fa-users" style="color: #4ef69a"></i> members</a>
</li> --}}
@endsection


@section('content')

@section('user-avatar' , 'AD')

@section('user-title' , 'Admin')

<!-- Content -->
<div class="content">
    <div class="page-header">
        <h1>لوحة الإدارة</h1>
        <p class="breadcrumb">الرئيسية / لوحة التحكم</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">الجامعات</div>
                    <div class="stat-value"><span data-counter>{{ $totalUniversities }}</span></div>
                </div>
                <div class="stat-icon blue">🎓</div>
            </div>
            <div class="stat-change positive">إجمالي السجلات</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">الشركات</div>
                    <div class="stat-value"><span data-counter>{{ $totalCompanies }}</span></div>
                </div>
                <div class="stat-icon green">🏢</div>
            </div>
            <div class="stat-change positive">إجمالي السجلات</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">الطلاب</div>
                    <div class="stat-value"><span data-counter>{{ $totalStudents }}</span></div>
                </div>
                <div class="stat-icon orange">👨‍🎓</div>
            </div>
            <div class="stat-change positive">إجمالي السجلات</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">التدريبات</div>
                    <div class="stat-value"><span data-counter>{{ $numberOfTrainings }}</span></div>
                </div>
                <div class="stat-icon red">📚</div>
            </div>
            <div class="stat-change positive">برامج منشورة</div>
        </div>
    </div>

    <!-- Latest Applications -->
    {{-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">Latest Applications</h3>
            <a href="trainings.html" class="btn btn-primary btn-sm">View All</a>
        </div>
        <div class="card-body">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Training</th>
                            <th>Company</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ahmed Al-Sayed</td>
                            <td>Software Development</td>
                            <td>Tech Solutions Inc</td>
                            <td>2024-02-10</td>
                            <td><span class="badge-status badge-warning">Pending</span></td>
                            <td><button class="btn btn-sm btn-primary">Review</button></td>
                        </tr>
                        <tr>
                            <td>Fatima Hassan</td>
                            <td>Marketing Internship</td>
                            <td>Digital Marketing Co</td>
                            <td>2024-02-09</td>
                            <td><span class="badge-status badge-success">Approved</span></td>
                            <td><button class="btn btn-sm btn-primary">View</button></td>
                        </tr>
                        <tr>
                            <td>Omar Ibrahim</td>
                            <td>Data Analysis</td>
                            <td>Analytics Corp</td>
                            <td>2024-02-08</td>
                            <td><span class="badge-status badge-warning">Pending</span></td>
                            <td><button class="btn btn-sm btn-primary">Review</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <!-- Revenue Summary -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Monthly Revenue</h3>
            <button class="btn btn-outline btn-sm">Export Report</button>
        </div>
        <div class="card-body">
            <canvas id="revenueChart" width="800" height="300"></canvas>
        </div>
    </div>
</div>
@endsection



@section('script')
<script>
    // Draw simple revenue chart
            document.addEventListener('DOMContentLoaded', () => {
                const data = [15000, 18000, 22000, 25000, 28000, 32000];
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
                createBarChart('revenueChart', data, labels);
            });
</script>
<script>
    (function () {
        const counters = document.querySelectorAll("[data-counter]");
        counters.forEach(function (el) {
            const raw = (el.textContent || "").trim();
            const target = parseInt(raw.replace(/[^\d]/g, ""), 10);
            if (!Number.isFinite(target)) return;

            let current = 0;
            const step = Math.max(1, Math.ceil(target / 35));
            const timer = setInterval(function () {
                current += step;
                if (current >= target) {
                    el.textContent = String(target);
                    clearInterval(timer);
                } else {
                    el.textContent = String(current);
                }
            }, 22);
        });
    })();
</script>
@endsection
