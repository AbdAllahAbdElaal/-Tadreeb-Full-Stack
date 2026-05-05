@extends('tadreeb.parent')


@section('title' , '')


@section('style')
@endsection


@section('menu')
<li><a href="{{ route('admin-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('universities.edit', $university->id) }}">
        <i class="fa-solid fa-left-long" style="color: #dce0e7;"></i> EDIT</a>
</li>
<li><a href="{{ route('universities.index') }}">
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
                        <p><strong>Name:</strong> {{ $university->name }}</p>
                        <p><strong>Email:</strong> {{ $university->email }}</p>
                        <p><strong>Phone:</strong> {{ $university->phone }}</p>
                        <p><strong>Total Students:</strong> {{ $university->student_number }}</p>
                        <p><strong>Plan:</strong> Enterprise</p>
                        <p><strong>Status:</strong> <span class="badge-status badge-success">{{ $university->status }}</span></p>
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

{{-- <div class="bg-primary mt-5">
    <div>
        <div>
            <h3>University Details</h3>
        </div>
        <div>
            <p><strong>Name:</strong> {{ $university->name }}</p>
            <p><strong>Email:</strong> {{ $university->email }}</p>
            <p><strong>Phone:</strong> {{ $university->phone }}</p>
            <p><strong>Total Students:</strong> {{ $university->student_number }}</p>
            <p><strong>Plan:</strong> Enterprise</p>
            <p><strong>Status:</strong> <span class="badge-status badge-success">Active</span></p>
        </div>
    </div>
</div> --}}
@endsection


@section('content2')
@endsection


@section('script')
@endsection
