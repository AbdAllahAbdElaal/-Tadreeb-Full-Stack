@extends('tadreeb.parent')


@section('title' , 'members')


@section('style')
<style>

</style>
@endsection


@section('menu')
<li><a href="{{ route('admin-dashboard') }}">
        <i class="fa-solid fa-house" style="color: #dce0e7;"></i> Dashboard</a>
</li>
<li><a href="{{ route('universities.index') }}">
        <i class="fa-solid fa-building-columns" style="color: #2E5BFF"></i> Universities</a>
</li>
<li><a href="{{ route('admin-companies') }}">
        <i class="fa-solid fa-city" style="color: #00C292"></i> Companies</a>
</li>
<li><a href="{{ route('admin-students') }}">
        <i class="fa-solid fa-user-graduate" style="color: #FFA800"></i> Students</a>
</li>
<li><a href="{{ route('admin-trainings') }}">
        <i class="fa-solid fa-layer-group" style="color: #A155B9"></i> Trainings</a>
</li>
<li><a href="{{ route('plans.index') }}">
        <i class="fa-solid fa-calendar-check" style="color: #F64E60"></i> Plans</a>
</li>
<li><a href="{{ route('admin-reports') }}">
        <i class="fa-solid fa-chart-line" style="color: #F64E60"></i> Reports</a>
</li>
<li><a href="{{ route('members.index') }}" class="active">
        <i class="fa-solid fa-users" style="color: #4ef69a"></i> members</a>
</li>
@endsection


@section('user-avatar' , 'M')


@section('user-title' , 'All Members')


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Members</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Member Name</th>
                                    <th>Member Email</th>
                                    <th>Member Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->username }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->organization->role ?? 'no data' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('members.show' , $member->id) }}" class="btn btn-sm btn-info"
                                            title="show">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('members.edit' , $member->id) }}"
                                            class="btn btn-sm btn-primary" title="edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="performDestroy({{ $member->id }} , this)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{ $members->links() }}
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
    function performDestroy(id, reference){
        confirmDestroy('/tadreeb/members/' + id , reference)
    }
</script>

@endsection
