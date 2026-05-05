@extends('tadreeb.parent')


@section('title' , 'Students - Admin')


@section('menu')
<li><a href="{{ route('university-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('university.my-students') }}" class="active">
        <i class="fa-solid fa-user-graduate" style="color: #FFA800"></i> Students</a>
</li>
<li><a href="{{ route('university-supervisors') }}">
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
    <div class="page-header">
        <h1>Students</h1>
        <p class="breadcrumb">Home / Students</p>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Students</h3>
            <a href="{{ route('students.create') }}" class="btn btn-primary">+ Add Student</a>
        </div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>University</th>
                        <th>Major</th>
                        <th>Training Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->university->name }}</td>
                        <td>{{ $student->major }}</td>
                        <td>
                            <span
                                class="badge-status {{ ['active' => 'badge-success', 'pending' => 'badge-warning', 'completed' => 'badge-info'][$student->status] ?? 'badge-secondary' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="{{ route('students.show' , $student->id) }}" class="btn btn-sm btn-info"
                                title="show">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('students.edit' , $student->id) }}" class="btn btn-sm btn-primary"
                                title="edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="performDestroy({{ $student->id }} , this)">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                        {{-- <td>
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
        function performDestroy(id, reference){
            confirmDestroy('/tadreeb/students/' + id , reference)
        }
    </script>
@endsection
