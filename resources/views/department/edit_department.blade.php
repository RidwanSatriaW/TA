@extends('dashboard')

@section('content')

<form method="POST" action="{{ route('department.edit_validation') }}">
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
                      <h4 class="card-title">Edit Department</h4>
                      
                        <div class="form-group{{ $errors->has('department_name') ? ' has-error' : '' }}">
                            <label for="department_name" class="col-md-4 control-label">Department Name</label>
                            <div class="col-md-6">
                                <input id="department_name" type="text" class="form-control" name="department_name" value="{{ $data->department_name }}" required>
                                @if ($errors->has('department_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department_name') }}</strong>
                                    </span>
                                @endif
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

