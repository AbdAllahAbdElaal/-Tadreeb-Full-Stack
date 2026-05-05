@extends('tadreeb.parent')


@section('title' , 'Universities - Admin')


@section('menu')
<li><a href="{{ route('admin-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('universities.index') }}" class="active">
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
        <h1>Universities</h1>
        <p class="breadcrumb">Home / Universities</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Universities</h3>
            <div>
                <a href="{{ route('universities.create') }}" class="btn btn-primary">+ Add University</a>
                <a href="{{ route('universities.trashed') }}" class="btn btn-danger">Recycle Bin</a>
            </div>
        </div>
        <div class="card-body">
            <div class="filter-bar">
                <div class="filter-group">
                    <label>Status</label>
                    <select>
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Pending</option>
                        <option>Suspended</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Plan</label>
                    <select>
                        <option>All Plans</option>
                        <option>Basic</option>
                        <option>Professional</option>
                        <option>Enterprise</option>
                    </select>
                </div>
            </div>

            <div class="table-wrapper">
                <table id="universitiesTable">
                    <thead>
                        <tr>
                            <th>University Name</th>
                            <th>Email</th>
                            <th>Students</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($universities as $university)
                        <tr>
                            <td>{{ $university->name }}</td>
                            <td>{{ $university->email }}</td>
                            <td>{{ $university->students->count() }}</td>
                            <td>{{ $university->organization->subscription->plan->name ?? 'N/A' }}</td>

                            <td>
                                <span
                                    class="badge-status {{ $university->status == 'pending' ? 'badge-warning' : 'badge-success' }}">{{
                                    $university->status }}
                                </span>
                            </td>

                            <td>
                                @if($university->status == 'pending')
                                <a type="button" onclick="performUpdate1({{ $university->id }})"
                                    class="btn btn-sm btn-success">
                                    Approve
                                </a>
                                @else
                                <a href="{{ route('universities.show', $university->id) }}"
                                    class="btn btn-sm btn-primary">
                                    View
                                </a>
                                @endif

                                @if($university->status == 'pending')
                                    <a type="button" class="btn btn-sm btn-danger" onclick="performDestroy({{ $university->id }} , this)">
                                        Reject
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-danger" onclick="performUpdate2({{ $university->id }})">
                                        Suspend
                                    </a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $universities->links() }}
        </div>
    </div>
</div>
@endsection


@section('content2')

@endsection


@section('script')
<script>
    function performUpdate1(id){
        let formData = new FormData();

        formData.append('status', 'active');

        storeRoute('/tadreeb/universities-update/'+id , formData);
    }

    function performUpdate2(id){
        let formData = new FormData();

        formData.append('status', 'pending');

        storeRoute('/tadreeb/universities-update/'+id , formData);
    }


    function performDestroy(id, reference){
        confirmDestroy('/tadreeb/universities/' + id , reference)
    }


</script>

@endsection
