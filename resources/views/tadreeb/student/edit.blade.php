@extends('tadreeb.parent')


@section('title' , '')


@section('style')
@endsection


@section('menu')
<li><a href="{{ route('university-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a style="cursor: pointer;" type="button" onclick="performUpdate({{ $student->id }})">
        <i class="fa-solid fa-left-long" style="color: #dce0e7;"></i> EDIT</a>
</li>
<li><a href="{{ route('university.my-students' , $student->id) }}">
        <i class="fa-solid fa-left-long" style="color: #dce0e7;"></i> BACK</a>
</li>
@endsection


    @php
    // تقطيع الاسم لمصفوفة، أخذ أول حرف من كل كلمة، ثم دمجهم
    $words = explode(' ', auth()->user()->organization->university->name);
    $initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
    @endphp
    @section('user-avatar' , $initials)

    @section('user-title' , auth()->user()->organization->university->name )


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
                        <div class="form-row">
                            <div class="form-group-profile">
                                <label>First Name</label>
                                <input type="text" id="first_name" name="first_name" value="{{ $student->first_name }}" required>
                            </div>
                            <div class="form-group-profile">
                                <label>Last Name</label>
                                <input type="text" id="last_name" name="last_name" value="{{ $student->last_name }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group-profile">
                                <label for="email"><strong>Email</strong></label>
                                <input type="text" id="email" name="email" value="{{ $student->email }}" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group-profile">
                                <label for="phone"><strong>Phone</strong></label>
                                <input type="text" id="phone" name="phone" value="{{ $student->phone }}" placeholder="Enter Phone" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group-profile">
                                <label for="major"><strong>Major</strong></label>
                                <input type="text" id="major" name="major" value="{{ $student->major }}" placeholder="Enter Major" required>
                            </div>
                            @if ( $student->status != 'completed')
                                <div class="form-group-profile">
                                    <label for="status"><strong>Status</strong></label>
                                    <select id="status" name="status" required>
                                        <option value="active" @selected($student->status == 'active')>Active</option>
                                        <option value="pending" @selected($student->status == 'pending')>pending</option>
                                    </select>
                                </div>
                            @endif
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

        formData.append('first_name', document.getElementById('first_name').value)
        formData.append('last_name', document.getElementById('last_name').value)
        formData.append('email', document.getElementById('email').value)
        formData.append('phone', document.getElementById('phone').value)
        formData.append('major', document.getElementById('major').value)

        let statusField = document.getElementById('status');
        if (statusField) {
            formData.append('status', statusField.value);
        }

        storeRoute('/tadreeb/students-update/'+id , formData);
    }
</script>
@endsection
