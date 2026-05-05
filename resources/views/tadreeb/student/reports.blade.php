@extends('tadreeb.parent')


@section('title' , 'reports')


@section('menu')
<li><a href="{{ route('student-dashboard') }}">
    <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a></li>
<li><a href="{{ route('student-trainings') }}">
    <i class="fa-solid fa-book-open-reader" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('student-applications') }}">
    <i class="fa-solid fa-file-signature" style="color: #A78BFA"></i> Applications</a>
</li>
<li><a href="{{ route('student-reports') }}" class="active">
    <i class="fa-solid fa-chart-line" style="color: #F64E60"></i> Reports</a>
</li>
<li><a href="{{ route('student-profile') }}">
    <i class="fa-solid fa-user-gear" style="color: #4154ff"></i> Profile</a>
</li>
@endsection





@php
// تقطيع الاسم لمصفوفة، أخذ أول حرف من كل كلمة، ثم دمجهم
$words = explode(' ', auth()->user()->student->first_name . ' ' . auth()->user()->student->last_name);
$initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
@endphp
@section('user-avatar' , $initials)

@section('user-title' , auth()->user()->student->first_name . ' ' . auth()->user()->student->last_name )


@section('profile-btn')
    <a href="{{ route('student-profile') }}" class="dropdown-item profile">Profile</a>
@endsection



@section('content')
<div class="content">
    <h1>Reports</h1>
    <div class="card">
        <div class="card-body">
            <p>Content for Reports</p>
        </div>
    </div>
</div>

@endsection
