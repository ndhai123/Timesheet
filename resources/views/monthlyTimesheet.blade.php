@extends('layout.main')

@section('content')
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Month</th>
        <th>Standar work hour</th>
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
            <td>{{$item->year}}/{{$item->month}}</td>
            <td>{{$item->standar_work_hour}}</td>
            <td>{{$item->working_hour}}</td>
            <td>{{$item->missing_hour}}</td>
            <td>{{$item->overtime_hour}}</td>
            <td>{{$item->note}}</td>
            <td>
                <div class='btn-group'>
                    <a href="{{route('monthly',[$item->year, $item->month])}}" class='btn btn-default btn-xs'><i class="fas fa-eye"></i></a>
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
