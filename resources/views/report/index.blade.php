@section('js')
<script>
      $(function () {
        $("#start_date").datepicker({
            dateFormat: "yy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            onSelect: function (selectedDate) {
                $("#end_date").datepicker("option", "minDate", selectedDate);
            }
        });

        $("#end_date").datepicker({
            dateFormat: "yy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            onSelect: function (selectedDate) {
                $("#start_date").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
    function disableDropdowns(selectedDropdown) {
    var dropdowns = document.getElementsByTagName('select');
    for (var i = 0; i < dropdowns.length; i++) {
      if (dropdowns[i] !== selectedDropdown) {
        dropdowns[i].disabled = true;
      }
    }

    if (selectedDropdown.value === '') {
      for (var i = 0; i < dropdowns.length; i++) {
        if (dropdowns[i] !== selectedDropdown) {
          dropdowns[i].disabled = false;
        }
      }
    }
    } 
</script>

@stop
@section('css')
<style>
    .required {
      color: red;
    }
  </style>
@stop

@extends('dashboard')
@section('content')
<form method="POST" action="{{ route('export_pdf') }}">
    @csrf
    <div class="row">

    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Laporan Visitor</h4>

                    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label for="start_date" class="col-md-4 control-label">Start Date <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="start_date" name="start_date" placeholder="start date">
                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                        <label for="end_date" class="col-md-4 control-label">End Date <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="end_date" name="end_date" placeholder="end date">
                            @if ($errors->has('end_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <h5 class="card-title">Optional</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="" class="col-md-4 control-label">Department</label>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="col-md-4 control-label">Employee</label>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="col-md-4 control-label">Necessity</label>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="col-md-4">
                                <select class="form-control" name="department" onchange="disableDropdowns(this)">
                                    <option value="" selected>-----</option>
                                    @foreach ($department as $item)
                                        <option value="{{ $item->id }}">{{ $item->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">       
                                <select class="form-control" name="employee" onchange="disableDropdowns(this)">
                                    <option value="" selected>-----</option>
                                    @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->employee_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="necessity" onchange="disableDropdowns(this)">
                                    <option value="" selected>-----</option>
                                    @foreach ($necessity as $item)
                                        <option value="{{ $item->id }}">{{ $item->keperluan_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 pull-left">
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw" id="submit">
                            <b><i class="fa fa-download"></i> Export PDF </b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection