@extends('layout.main')
@section('content')
<h1 style="text-align: center;"> New Leave Request  </h1>
<div class="container">
    <form method="POST">
       @csrf
        <div class="form-group row">
            <label for="" class="col-2 col-form-label">Leave Type</label>
            <div class="col-10">

                <select name="type_leave" class="form-control" id="listLeave" onchange="getshowLeave()" required>
                    <option disabled selected value> -- select an option -- </option>
                    <option value="1">Paid Leave</option>
                    <option value="2">Unpaid Leave</option>
                    <option value="3">Ariral Leave</option>
                    <option value="4">Take Care Of Children</option>
                    <option value="5">Maternity Leave</option>
                    <option value="6">Funeral Leave(Of Whole Sister Or Brother)</option>
                    <option value="7">Funeral Leave( Parent Chiledren)</option>
                    <option value="8">Summer Vacation Leave</option>
                    <option value="9">Special Leave</option>
                  </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-2 col-form-label">Anual Leavas Remain</label>
            <div class="col-10">
            <input type="text" class="form-control"   id="Day" disabled >
            </div>
          </div>
          <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label" >Strat Date</label>
            <div class="col-10">
            <input class="form-control" id="startDate" type="date" value="{{date('Y-m-d')}}" name="start_day" onchange="getCountDay()" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">End Date</label>
            <div class="col-10">
            <input class="form-control" id="endDate" type="date"  value="{{date('Y-m-d')}}" name="end_day" onchange="getCountDay()"   required>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-2 col-form-label">Paitial Day</label>
            <div class="col-10">
                <select id="type_leave" name="typeLeave" class="form-control" onchange="getCountDay()" required>
                
                    <option value="1">All Day</option>
                    <option value="2">morning day</option>
                    <option value="3">Afternoon</option>
                  </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="example-email-input" class="col-2 col-form-label">Duration</label>
            <div class="col-10">
            <input class="form-control" type="text" id="duration" value="" name="duration" id="daration"  disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-2 col-form-label">Reason</label>
            <div class="col-10">
              <input class="form-control" type="text" value="" name="reason">
            </div>
          </div>
        </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="/newLeave"><button type="submit-1" class="btn btn-danger">Cancel</button></a>
        </div>
      </div>
    </form>
  </div>

@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  function getshowLeave(){
    var x = document.getElementById("listLeave").value;
    $.ajax({
               type:'POST',
               url:'/getshowLeave',
               data:{'type_leave': x},
               success:function(data) {               
                $('#Day').val(data.data);
                }
            });
  }
  function getCountDay(){
    var x = document.getElementById("startDate").value;
    var y = document.getElementById("endDate").value;
     var z = document.getElementById("type_leave").value;
    $.ajax({
      type:'POST',
             url:'/getCountDay',
             data:{'start_day': x,
                   'end_day' : y,
                   'typeLeave': z },
               success:function(data) {       
                 console.log(data);        
               $('#duration').val(data.data);
                }
    });
  }
</script>
@endsection
