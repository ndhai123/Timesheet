@extends('layout.main')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif
    <form action="/dateDetailEditSave" method="POST">
        @csrf

        @if($data->date)
        <div class="form-group">
            <label>Working date</label>
                <div style="width: 300px;">
                    <input type="text" readonly name='date' value="{{$data->date}}"/>
                </div>
        </div>
        @endif

        @if($data->checkin)
        <div class="form-group">
            <label>Checkin time</label>
                <div style="width: 300px;">
                    <input type="text" readonly value="{{$data->checkin}}"/>
                </div>
        </div>
        @endif
        <div class="form-group">
            <label>Modify checkin time</label>
                <div class="input-group date" id="timepicker" data-target-input="nearest" style="width: 300px;">
                    <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" style="width: 250px;" name='checkin_modify'/>
                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                </div>
        </div>

        @if($data->checkout)
        <div class="form-group">
            <label>Checkout time</label>
                <div style="width: 300px;">
                    <input type="text" readonly value="{{$data->checkout}}"/>
                </div>
        </div>
        @endif

        <div class="form-group">
        <label>Modify checkout time</label>
            <div class="input-group date" id="timepicker" data-target-input="nearest" style="width: 300px;">
                <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" style="width: 250px;" name='checkout_modify'/>
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
            </div>
        </div>

         @if($data->break_time)
        <div class="form-group">
            <label>Break time</label>
                <div style="width: 300px;">
                    <input type="text" readonly value="{{$data->break_time}}"/>
                </div>
        </div>
        @endif

        <div class="form-group">
        <label>Modify Break time</label>
            <div class="input-group date" id="timepicker" data-target-input="nearest" style="width: 300px;">
                <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" style="width: 250px;" name='breaktime_modify'/>
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Modify</button>

    </form>

@endsection
@section('script')

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>

    <script>
        $(function () {
            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'HH:mm',
                pickDate: false,
                pickSeconds: false,
                pick12HourFormat: false
            })
        })
    </script>
@endsection


