@extends('tadreeb.parent')


@section('title' , 'Students - Admin')


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
<li><a href="{{ route('students.index') }}" class="active">
        <i class="fa-solid fa-user-graduate" style="color: #FFA800"></i> Students</a>
</li>
<li><a href="{{ route('admin-trainings') }}">
        <i class="fa-solid fa-layer-group" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('plans.index') }}">
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
        <h1>Students</h1>
        <p class="breadcrumb">Home / Students</p>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Students</h3>
            {{-- <a href="{{ route('members.create') }}" class="btn btn-primary">+ Add Student</a> --}}
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

                            {{-- <a href="{{ route('students.edit' , $student->id) }}" class="btn btn-sm btn-primary"
                                title="edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="performDestroy({{ $student->id }} , this)">
                                <i class="fas fa-trash-alt"></i>
                            </button> --}}
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
