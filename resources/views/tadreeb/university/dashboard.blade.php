@extends('tadreeb.parent')


@section('title' , 'dashboard')


@section('menu')
<li><a href="{{ route('university-dashboard') }}" class="active">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('university.my-students') }}">
        <i class="fa-solid fa-user-graduate" style="color: #FFA800"></i> Students</a>
</li>
<li><a href="{{ route('university-supervisors') }}">
        <i class="fa-solid fa-user-tie" style="color: #818CF8"></i> Supervisors</a>
</li>
<li><a href="{{ route('university-trainings') }}">
        <i class="fa-solid fa-book-open-reader" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('university-payments') }}">
        <i class="fa-solid fa-credit-card" style="color: #38BDF8"></i> Payments</a>
</li>
{{-- <li><a href="{{ route('university-notifications') }}">
        <i class="fa-solid fa-bell" style="color: #FFA800"></i> Notifications</a>
</li> --}}
@endsection



@php
// تقطيع الاسم لمصفوفة، أخذ أول حرف من كل كلمة، ثم دمجهم
$words = explode(' ', $university->name);
$initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
@endphp
@section('user-avatar' , $initials)

@section('user-title' , $university->name )


@section('content')
<div class="content">
    <div class="page-header">
        <h1>Dashboard</h1>
        <p class="breadcrumb">Home / Dashboard</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Students</div>
                    <div class="stat-value">{{ $university->students->count() }}</div>
                </div>
                <div class="stat-icon blue">🎓</div>
            </div>
            {{-- <div class="stat-change positive">+12% from last month</div> --}}
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Active Students</div>
                    <div class="stat-value">
                        {{ $university->students->where('status', 'active')->count() }}
                    </div>

                </div>
                <div class="stat-icon green">🏢</div>
            </div>
            {{-- <div class="stat-change positive">+8% from last month</div> --}}
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Students Completed</div>
                    <div class="stat-value">
                        {{ $university->students->where('status', 'completed')->count() }}
                    </div>

                </div>
                <div class="stat-icon orange">👨‍🎓</div>
            </div>
            {{-- <div class="stat-change positive">+25% from last month</div> --}}
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Active Trainings</div>
                    <div class="stat-value">
                        {{ $university->approvedTrainings()->count() }}
                    </div>

                </div>
                <div class="stat-icon red">📚</div>
            </div>
            <div class="stat-change positive">+15% from last month</div>
        </div>
    </div>
</div>

@endsection
