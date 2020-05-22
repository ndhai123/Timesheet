@extends('layout.main')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@elseif ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

<h1 style="text-align: center;"> Add new User </h1>
<form action="/admin/addUser" method="POST">
    @csrf
    <label>User Name</label>
    <div style="width: 300px;">
        <input type="text" name='user_name' required/>
    </div>

    <label>Email</label>
    <div style="width: 300px;">
        <input type="text" name='email' required/>
    </div>

    <label>Role</label>
    <div style="width: 300px;">
        <select id="role" name="role">
            <option value="0">Admin</option>
            <option value="1">User</option>
          </select>
    </div>

    <label>Number</label>
    <div style="width: 300px;">
        <input type="text" name='number'/>
    </div>

    <a href="/admin/addUser" class="nav-link active">
        <button type="submit" class="btn btn-block btn-primary btn-sm" style="width:218px;">Add user</button>
    </a>
</form>

@endsection
