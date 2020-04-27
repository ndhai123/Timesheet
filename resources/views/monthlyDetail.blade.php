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
        <th>Working hour</th>
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
        <th>Checkin Modify</th>
        <th>{{$item->checkout}}</th>
        <th>Checkout Modify</th>
        @php(
            $workingTime = $item->checkout-$item->chekin - 1
            // $overTime = 8 - $item->checkout - $item->chekin - 1
        )
        <th>{{$workingTime}}</th>
        <th>{{$overTime}}</th>
        <th>Note</th>
        <th>Action</th>
            <td>
                <div class='btn-group'>
                    {{-- <a href="{{route('monthly', $item->month)}}" class='btn btn-default btn-xs'><i class="fas fa-eye"></i></a> --}}
                    {{-- <a href="{{ route('admin.services.edit', $item->group) }}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></a> --}}
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
