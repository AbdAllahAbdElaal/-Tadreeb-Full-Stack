@extends('tadreeb.parent')


@section('title' , '')


@section('style')
@endsection


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


@section('user-avatar' , 'AD')


@section('user-title' , 'Admin')


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Plan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Plan Name</label>
                            <input id="name" type="text" placeholder="Enter Plan Name">
                        </div>
                        <div class="form-group">
                            <label for="price">Plan Price</label>
                            <input id="price" type="number" placeholder="Enter Pkan Price">
                        </div>
                        <div class="form-group">
                            <label for="max_student">Max Student</label>
                            <input id="max_student" type="number" placeholder="Enter Max Student Number">
                        </div>
                        <div class="form-group">
                            <label for="max_program">Max Program</label>
                            <input id="max_program" type="number" placeholder="Enter max Program Number">
                        </div>
                        <div class="form-group">
                            <label for="description">description</label>
                            <input id="description" type="text" placeholder="Enter Description">
                        </div>
                        <div style="text-align: center;">
                            <a onclick="performStore()" type="submit" class="btn btn-primary">Create</a >
                            <a href="{{ route('plans.index') }}" type="submit" class="btn btn-primary">Back</a>
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
    function performStore(){
        let formData = new FormData();
        formData.append('name', document.getElementById('name').value)
        formData.append('price', document.getElementById('price').value)
        formData.append('max_student', document.getElementById('max_student').value)
        formData.append('max_program', document.getElementById('max_program').value)
        formData.append('description', document.getElementById('description').value)

        store('/tadreeb/plans' , formData);
    }
</script>
@endsection
