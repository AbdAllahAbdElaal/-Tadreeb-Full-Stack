@extends('tadreeb.parent')

@section('title' , 'Companies - Admin')

@section('menu')
<li><a href="{{ route('admin-dashboard') }}">
    <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('universities.index') }}">
    <i class="fa-solid fa-building-columns" style="color: #2E5BFF"></i> Universities</a>
</li>
<li><a href="{{ route('companies.index') }}" class="active">
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



@section('user-avatar' , 'AD')

@section('user-title' , 'Admin')



@section('content')
<div class="content">
    <div class="page-header">
        <h1>Companies</h1>
        <p class="breadcrumb">Home / Companies</p>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Companies</h3>
            <a href="{{ route('companies.create') }}" class="btn btn-primary">+ Add Company</a>
        </div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Trainings</th>
                        <th>Plan</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->trainings->count() }}</td>
                            <td>{{ $company->subscription_plan }}</td>
                            <td>
                                <span
                                    class="badge-status {{ $company->status == 'pending' ? 'badge-warning' : 'badge-success' }}">{{
                                    $company->status }}
                                </span>
                            </td>
                                <td>
                                    @if($company->status == 'pending')
                                    <a type="button" onclick="performUpdate1({{ $company->id }})"
                                        class="btn btn-sm btn-success">
                                        Approve
                                    </a>
                                    @else
                                    <a href="{{ route('companies.show', $company->id) }}"
                                        class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                    @endif

                                    @if($company->status == 'pending')
                                        <a type="button" class="btn btn-sm btn-danger" onclick="performDestroy({{ $company->id }} , this)">
                                            Reject
                                        </a>
                                    @else
                                        <a class="btn btn-sm btn-danger" onclick="performUpdate2({{ $company->id }})">
                                            Suspend
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        </tr>
                     @endforeach
                </tbody>
            </table>
            {{ $companies->links() }}
        </div>
    </div>
</div>

@endsection




@section('script')
<script>
    function performUpdate1(id){
        let formData = new FormData();

        formData.append('status', 'active');

        storeRoute('/tadreeb/companies-update/'+id , formData);
    }

    function performUpdate2(id){
        let formData = new FormData();

        formData.append('status', 'pending');

        storeRoute('/tadreeb/companies-update/'+id , formData);
    }


    function performDestroy(id, reference){
        confirmDestroy('/tadreeb/companies/' + id , reference)
    }


</script>

@endsection
