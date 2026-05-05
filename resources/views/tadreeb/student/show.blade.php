@extends('tadreeb.parent')


@section('title' , '')


@section('style')
@endsection


@section('menu')
<li><a href="{{ auth()->user()->role == 'admin' ? route('admin-dashboard') : route('university-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ auth()->user()->role == 'admin' ? route('students.index') : route('university.my-students') }}">
        <i class="fa-solid fa-left-long" style="color: #dce0e7;"></i> BACK</a>
</li>
@endsection

@if (auth()->user()->organization)
    @php
    // تقطيع الاسم لمصفوفة، أخذ أول حرف من كل كلمة، ثم دمجهم
    $words = explode(' ', auth()->user()->organization->university->name);
    $initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
    @endphp
    @section('user-avatar' , $initials)

    @section('user-title' , auth()->user()->organization->university->name )
{{-- @endif --}}
@else
    @section('user-avatar' , 'AD')

    @section('user-title' , 'Admin')
@endif



@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $students->first_name }} {{ $students->last_name }}</p>
                        <p><strong>Email:</strong> {{ $students->email }}</p>
                        <p><strong>Phone:</strong> {{ $students->phone }}</p>
                        <p><strong>Address:</strong> {{ $students->major }}</p>
                        <p><strong>Description:</strong> {{ $students->required_hours }}</p>
                        <p><strong>Total Trainings:</strong> {{ $students->completed_hours }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge-status {{ ['active' => 'badge-success', 'pending' => 'badge-warning', 'completed' => 'badge-info'][$students->status] ?? 'badge-secondary' }}">
                                {{ ucfirst($students->status) }}
                            </span>
                        </p>
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
