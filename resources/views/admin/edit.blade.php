@extends('layout.main')
@section('content')
<h1 style="text-align: center;"> EDIT </h1>
<form action="" method="POST">
    @csrf

        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Leave Type</th>
            <th scope="col">Total Number Of Holidays</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($edit as $item)
            <tr>
            <td>Paid Leave </td>
            <td><input  type="text" name="paid_leave" value="{{$item->paid_leave}} "></td>
            </tr>
            <tr>
            <td>Unpaid Leave </td>
            <td><input  type="text" name="unpaid_leave" value="{{$item->unpaid_leave}} "></td>

            </tr>
            <tr>
            <td>Ariral Leave </td>
            <td><input  type="text" name="ariral_leave" value="{{$item->ariral_leave}} "></td>

            </tr>
            <tr>
            <td>Take Care Of Children  </td>
            <td><input  type="text" name="take_care_of_children" value="{{$item->take_care_of_children}}"></td>

            </tr>
            <tr>
            <td>Maternity Leave  </td>
            <td><input  type="text" name="maternity_leave" value="{{$item->maternity_leave}} "></td>

            </tr>
            <tr>
            <td>Funeral Leave(Of Whole Sister Or Brother) </td>
            <td><input  type="text" name="funeral_leave_of_whole_sister_or_brother" value="{{$item->funeral_leave_of_whole_sister_or_brother}} "></td>

            </tr>
            <tr>
            <td>Funeral Leave( Parent Chiledren) </td>
            <td><input  type="text" name="funeral_leave_parent_chiledren" value="{{$item->funeral_leave_parent_chiledren}} "></td>

            </tr>
            <tr>
            <td>Summer Vacation Leave </td>
            <td><input  type="text" name="summer_vacation_leave" value="{{$item->summer_vacation_leave}} "></td>

            </tr>
            <tr>
            <td>Special Leave  </td>
            <td><input  type="text" name="special_leave" value="{{$item->special_leave}} "></td>

            </tr>
        @endforeach
        </tbody>

        </table>

        <button type="submit" class="btn btn-xs btn-primary" >SAVE</button>
</form>

@endsection
