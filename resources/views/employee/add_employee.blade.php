@extends('dashboard')

@section('content')

<form method="POST" action="{{ route('employee.add_validation') }}">
    @csrf
<div class="row">
	@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>

	@endif
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Add New employee</h4>
                      
                        <div class="form-group{{ $errors->has('employee_name') ? ' has-error' : '' }}">
                            <label for="employee_name" class="col-md-4 control-label">Employee Name</label>
                            <div class="col-md-6">
                                <input id="employee_name" type="text" class="form-control" name="employee_name" required>
                                @if ($errors->has('employee_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('employee_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                            <select class="form-control" name="department" required>
                                <option value="" disabled selected hidden>-----</option>
							@foreach ($department as $item)
								<option value="{{ $item->id }}">{{ $item->department_name}}</option>
							@endforeach
                            </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Add
                        </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection


