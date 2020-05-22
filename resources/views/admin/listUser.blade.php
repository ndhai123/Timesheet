@extends('layout.main')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

<h1 style="text-align: center;"> List User </h1>

    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">No</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        @foreach($data as $user)

            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if ($user->name == 0)
                        Admin
                    @else
                        User
                    @endif
                </td>
                <td>{{$user->number}}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{route('deleteUser',[$user->email])}}" class='btn btn-default btn-xs'><i class="fas fa-trash-alt"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href='{!! url('/admin/toAddUser'); !!}' class="nav-link active">
        <button type="button" class="btn btn-block btn-primary btn-sm" style="width:218px;">Add user</button>
    </a>


@endsection
