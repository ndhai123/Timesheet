@extends('layout.main')
@section('content')
<h1 style="text-align: center;"> EDIT EVENT </h1>

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
            <td><input  type="date" name="date" value="{{$edit->date}}"></td>
            <td><input  type="text" name="event" value="{{$edit->event}}"></td>
           
        </tbody>

        </table>
        <button type="submit">Save</button>
</form>

@endsection
