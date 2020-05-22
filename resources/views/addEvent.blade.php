@extends('layout.main')
@section('content')
<h1 style="text-align: center;"> SHOW EVENT </h1>

<form action="" method="POST">
    @csrf
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">DATE</th>
            <th scope="col">EVENT</th>
            </tr>
        </thead>
        <tbody>   
            <tr>     
            <td><input  type="date" name="date" value=""></td>
            <td><input  type="text" name="event" value=""></td>

        </tbody>

        </table>
        <button type="submit">Save</button>
</form>

@endsection
