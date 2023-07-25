@extends('dashboard')

@section('content')

<form method="POST" action="{{ route('sub_user.add_validation') }}">
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
                      <h4 class="card-title">Add New User</h4>
                      
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">User Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">User Email</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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
