@extends('tadreeb.parent')


@section('title' , 'Plans - Admin')


@section('menu')
<li><a href="{{ route('admin-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('universities.index') }}">
        <i class="fa-solid fa-building-columns" style="color: #2E5BFF"></i> Universities</a>
</li>
<li><a href="{{ route('companies.index') }}">
        <i class="fa-solid fa-city" style="color: #00C292"></i> Companies</a>
</li>
<li><a href="{{ route('students.index') }}">
        <i class="fa-solid fa-user-graduate" style="color: #FFA800"></i> Students</a>
</li>
<li><a href="{{ route('admin-trainings') }}">
        <i class="fa-solid fa-layer-group" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('plans.index') }}" class="active">
        <i class="fa-solid fa-calendar-check" style="color: #F64E60"></i> Plans</a>
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

<div class="content">
    <div class="page-header">
        <h1>Subscription Plans</h1>
        <p class="breadcrumb">Home / Plans</p>
    </div>
    <a href="{{ route('plans.create') }}" class="btn btn-primary">Create New Plan</a>
    <div class="pricing-grid" style="margin-top: 30px;">
        @foreach ($plans as $plan)
        <div class="pricing-card">
            <h3>{{ $plan->name }}</h3>
            <div class="price">${{ $plan->price }}<span>/month</span></div>
            <ul class="pricing-features">
                <li>Up to {{ $plan->max_student }} students</li>
                <li>{{ $plan->max_program }} training programs</li>
                <li>{{ $plan->description }}</li>
            </ul>
            <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-primary">Edit Plan</a>
            <a type="button" onclick="performDestroy({{ $plan->id }} , this)" class="btn btn-danger">Delete Plan</a>
        </div>
        @endforeach
        {{-- <div class="pricing-card">
            <h3>Basic</h3>
            <div class="price">$99<span>/month</span></div>
            <ul class="pricing-features">
                <li>Up to 100 students</li>
                <li>5 training programs</li>
                <li>Basic reporting</li>
            </ul>
            <a href="{{ route('plans.edit',1) }}" class="btn btn-primary">Edit Plan</a>
        </div>
        <div class="pricing-card featured">
            <h3>Professional</h3>
            <div class="price">$249<span>/month</span></div>
            <ul class="pricing-features">
                <li>Up to 500 students</li>
                <li>20 training programs</li>
                <li>Advanced analytics</li>
                <li>Priority support</li>
            </ul>
            <a href="{{ route('plans.edit',1) }}" class="btn btn-primary">Edit Plan</a>
        </div>
        <div class="pricing-card">
            <h3>Enterprise</h3>
            <div class="price">Custom</div>
            <ul class="pricing-features">
                <li>Up to +999 students</li>
                <li>+99 training programs</li>
                <li>Custom features</li>
                <li>Dedicated support</li>
            </ul>
            <a href="{{ route('plans.edit',1) }}" class="btn btn-primary">Edit Plan</a>
        </div> --}}
    </div>
</div>
@endsection

@section("script")
<script>
    function performDestroy(id, reference){
        confirmDestroy('/tadreeb/plans/' + id , reference)
    }
</script>
@endsection
