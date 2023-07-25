@extends('dashboard')

@section('content')

<form method="POST" action="{{ route('employee_available.edit_validation') }}">
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
                      <h4 class="card-title">Edit Employee Availability</h4>
					  <div class="form-group">
						<label for="employee_name" class="col-md-4 control-label">Employee</label>
						<div class="col-md-6">
							<input id="employee_name" type="text" class="form-control" name="employee_name" value="{{ $data->employees->employee_name }} ( {{ $data->employees->departments->department_name }} )" disabled>
						</div>
					</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Necessity</label>
                            <div class="col-md-6">
                            <select class="form-control" name="keperluan_id" required>
								<option value="{{ $data->necessities->id }}" selected hidden>{{ $data->necessities->keperluan_name }}</option>
							@foreach ($necessity as $item)
								<option value="{{ $item->id }}">{{ $item->keperluan_name}}</option>
							@endforeach
                            </select>
                            </div>
                        </div>
						<input type="hidden" name="hidden_id" value="{{ $data->id }}" />

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Edit
                        </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection



