@extends('tadreeb.parent')

@section('title' , 'Company Dashboard')

@section('menu')
<li><a href="{{ route('company-dashboard') }}" class="active">
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
<li><a href="{{ route('company-profile') }}">
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
    <div class="page-header">
        <h1>Dashboard</h1>
        <p class="breadcrumb">Home / Dashboard</p>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Active Trainings</div>
                    <div class="stat-value">
                        {{ $company->trainings()->where('end_date', '>=', now())->count() }}
                    </div>
                </div>
                <div class="stat-icon blue">📚</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Pending Applications</div>
                    <div class="stat-value">
                        {{ $pendingApplicationsCount }}
                    </div>
                </div>
                <div class="stat-icon orange">📋</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Active Interns</div>
                    <div class="stat-value">
                        {{ $acceptedApplicationsCount }}
                    </div>
                </div>
                <div class="stat-icon green">👨‍🎓</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Completed</div>
                    <div class="stat-value">0</div>
                </div>
                <div class="stat-icon red">✅</div>
            </div>
        </div>
    </div>
    <div class="card">


    </div>
</div>
@endsection

@section('script')
@endsection
