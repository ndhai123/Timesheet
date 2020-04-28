@extends('layout.main')

@section('content')
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Date</th>
        <th>Checkin</th>
        <th>Checkin Modify</th>
        <th>Checkout</th>
        <th>Checkout Modify</th>
        <th>Breaktime</th>
        <th>Working hour</th>
        <th>Missing hour</th>
        <th>Overtime hour</th>
        <th>Note</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
    @foreach ($data as $item)
        <tr>
        <th>{{$item->date}}</th>
        <th>{{$item->chekin}}</th>
        <th>{{$item->chekin_modify}}</th>
        <th>{{$item->checkout}}</th>
        <th>{{$item->checkout_modify}}</th>
        <th>{{$item->break_time}}</th>
        <th>{{$item->working_time}}</th>
        <th>{{$item->missing_time}}</th>
        <th>{{$item->over_time}}</th>
        <th></th>
        <th></th>
            <td>
                <div class='btn-group'>
                    <a href="{{route('dateDetailEdit',[$item->date])}}" class='btn btn-default btn-xs'><i class="fas fa-eye"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
       </tbody>
      {{-- <tfoot>
      <tr>
        <th>Rendering engine</th>
        <th>Browser</th>
        <th>Platform(s)</th>
        <th>Engine version</th>
        <th>CSS grade</th>
      </tr>
      </tfoot> --}}
    </table>
  </div>
@endsection
