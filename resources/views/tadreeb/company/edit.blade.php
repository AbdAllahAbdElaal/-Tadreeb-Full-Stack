@extends('tadreeb.parent')


@section('title' , '')


@section('style')
@endsection


@section('menu')
<li><a href="{{ route('admin-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a style="cursor: pointer;" type="button" onclick="performUpdate({{ $company->id }})">
        <i class="fa-solid fa-left-long" style="color: #dce0e7;"></i> EDIT</a>
</li>
<li><a href="{{ route('companies.show' , $company->id) }}">
        <i class="fa-solid fa-left-long" style="color: #dce0e7;"></i> BACK</a>
</li>
@endsection


@section('user-avatar' , 'AD')


@section('user-title' , 'Admin')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Company Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" id="name" name="name" value="{{ $company->name }}" placeholder="Enter company Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="text" id="email" name="email" value="{{ $company->email }}" placeholder="Enter company Email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"><strong>Phone</strong></label>
                            <input type="text" id="phone" name="phone" value="{{ $company->phone }}" placeholder="Enter company Phone" required>
                        </div>
                        <div class="form-group">
                            <label for="description"><strong>Description</strong></label>
                            <input type="text" id="description" name="description" value="{{ $company->description }}" placeholder="Enter Description" required>
                        </div>
                        <div class="form-group">
                            <label for="address"><strong>Address</strong></label>
                            <input type="text" id="address" name="address" value="{{ $company->address }}" placeholder="Enter company address" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

@endsection


@section('content2')
@endsection


@section('script')
<script>
    function performUpdate(id){
        let formData = new FormData();
        formData.append('name', document.getElementById('name').value)
        formData.append('email', document.getElementById('email').value)
        formData.append('phone', document.getElementById('phone').value)
        formData.append('description', document.getElementById('description').value)
        formData.append('address', document.getElementById('address').value)

        storeRoute('/tadreeb/companies-update/'+id , formData);
    }
</script>
@endsection
