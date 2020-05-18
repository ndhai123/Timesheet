@extends('layout.main')
@section('content')
<h1 style="text-align: center;"> Day Management:{{$dayOff[0]->user_mail}} </h1>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Leave Type</th>
        <th scope="col">Total Number Of Holidays</th>
        <th scope="col">
            <a href="{{ route('dayOff-edit',['id'=>$dayOff[0]->id])}}" class="btn btn-xs btn-primary">Edit</a>
            <a href="{{ route('dayOff-delete',['id'=>$dayOff[0]->id])}}" class="btn btn-xs btn-danger" onclick="return confirm('Do you want to delete information')">Delete</a>
        </th>
      </tr>
    </thead>
    <tbody>

 @foreach ($dayOff as $item)
    <tr>
      <td>Paid Leave </td>
      <td>{{$item->paid_leave}}</td>

    </tr>
    <tr>
        <td>Unpaid Leave </td>
        <td>{{$item->unpaid_leave}}</td>

      </tr>
      <tr>
        <td>Ariral Leave </td>
        <td>{{$item->ariral_leave}}</td>

      </tr>
      <tr>
        <td>Take Care Of Children  </td>
        <td>{{$item->take_care_of_children}}</td>

      </tr>
      <tr>
        <td>Maternity Leave  </td>
        <td>{{$item->maternity_leave}}</td>

      </tr>
      <tr>
        <td>Funeral Leave(Of Whole Sister Or Brother) </td>
        <td>{{$item->funeral_leave_of_whole_sister_or_brother}}</td>

      </tr>
      <tr>
        <td>Funeral Leave( Parent Chiledren) </td>
        <td>{{$item->funeral_leave_parent_chiledren}}</td>

      </tr>
      <tr>
        <td>Summer Vacation Leave </td>
        <td>{{$item->summer_vacation_leave}}</td>

      </tr>
      <tr>
        <td>Special Leave  </td>
        <td>{{$item->special_leave}}</td>

      </tr>


 @endforeach
    </tbody>
  </table>

@endsection
