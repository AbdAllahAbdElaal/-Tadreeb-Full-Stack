@extends('tadreeb.parent')


@section('title' , 'supervisors')


@section('menu')
<li><a href="{{ route('university-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('university.my-students') }}">
        <i class="fa-solid fa-user-graduate" style="color: #FFA800"></i> Students</a>
</li>
<li><a href="{{ route('university-supervisors') }}" class="active">
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
$words = explode(' ', auth()->user()->organization->university->name);
$initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
@endphp
@section('user-avatar' , $initials)

@section('user-title' , auth()->user()->organization->university->name )

@section('content')

<div class="content">
    <h1>Supervisors</h1>
    <div class="card">
        <div class="card-body">
            <p>Content for Supervisors</p>
        </div>
    </div>
</div>

@endsection
