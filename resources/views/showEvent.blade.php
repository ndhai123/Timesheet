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
            <th scope="col">
            <a href="{{route('event-add')}}" class="btn btn-xs btn-primary">addEvent</a>
            </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
            <tr>     
            <td><input  type="date" name="paid_leave" value="{{$item->date}}"></td>
            <td><input  type="text" name="unpaid_leave" value="{{$item->event}} "></td>
            <td>           
            <a href="{{route('event-edit',['id'=>$item->id])}}" class="btn btn-xs btn-primary">Edit</a>
            <a href="{{ route('event-delete',['id'=>$item->id])}}" class="btn btn-xs btn-danger" onclick="return confirm('Do you want to delete information')">Delete</a>
            </td>
            @endforeach

        </tbody>

        </table>
</form>

@endsection
