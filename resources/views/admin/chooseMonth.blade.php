@extends('admin.layout.main')

@section('content')
<h2>Choose user</h2>
<select id="listUser" class="browser-default custom-select" onchange="getListMonthPaySlip()">
    <option value="" disabled selected>Choose user</option>
    @if($data)
        @foreach ($data as $item)
        <option value="{{$item->user_mail}}">{{$item->user_mail}}</option>
        @endforeach
    @endif

  </select>
<h2>Choose Month</h2>
  <select id="listMonth" class="browser-default custom-select">
  </select>
@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  function getListMonthPaySlip(){
    var x = document.getElementById("listUser").value;
    $.ajax({
               type:'POST',
               url:'/admin/getListMonthPayslip',
               data: x,
               success:function(data) {
                  alert("OK");
               }
            });
  }
</script>
@endsection
