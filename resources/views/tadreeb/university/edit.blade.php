@extends('tadreeb.parent')


@section('title' , '')


@section('style')
@endsection


@section('menu')
<li><a href="{{ route('admin-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a style="cursor: pointer;" type="button" onclick="performUpdate({{ $university->id }})">
        <i class="fa-solid fa-left-long" style="color: #dce0e7;"></i> EDIT</a>
</li>
<li><a href="{{ route('universities.show' , $university->id) }}">
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
                        <h3 class="card-title">University Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" id="name" name="name" value="{{ $university->name }}" placeholder="Enter University Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="text" id="email" name="email" value="{{ $university->email }}" placeholder="Enter University Email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"><strong>Phone</strong></label>
                            <input type="text" id="phone" name="phone" value="{{ $university->phone }}" placeholder="Enter University Phone" required>
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

        storeRoute('/tadreeb/universities-update/'+id , formData);
    }
</script>
@endsection
