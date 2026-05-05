@extends('tadreeb.parent')

@section('title' , 'Company Dashboard')

@section('menu')
<li><a href="{{ route('company-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('trainings.index') }}" class="active">
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
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Training</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Training title</label>
                            <input id="title" type="text" placeholder="Enter Training title" value="{{ $training->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" placeholder="Enter Description">{{ $training->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="available_slots">Available Slots</label>
                            <input id="available_slots" type="number" placeholder="Enter Available Slots" value="{{ $training->available_slots }}">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input id="start_date" type="date" placeholder="Enter Start Date" value="{{ $training->start_date }}">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input id="end_date" type="date" placeholder="Enter End Date" value="{{ $training->end_date }}">
                        </div>
                        </div>
                        <div style="text-align: center;">
                            <a onclick="performUpdate({{ $training->id }})" type="submit" class="btn btn-primary">Edit</a >
                            <a href="{{ route('trainings.index') }}" type="submit" class="btn btn-primary">Back</a>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content2')
@endsection


@section('script')
<script>
    function performUpdate(id){
        let formData = new FormData();
        formData.append('title', document.getElementById('title').value)
        formData.append('description', document.getElementById('description').value)
        formData.append('available_slots', document.getElementById('available_slots').value)
        formData.append('start_date', document.getElementById('start_date').value)
        formData.append('end_date', document.getElementById('end_date').value)
        storeRoute('/tadreeb/trainings-update/'+id , formData);
    }

</script>
@endsection
