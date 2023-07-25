

@extends('dashboard')
@section('content')

<form method="POST" action="{{ route('data.add_validation') }}">
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
                      <h4 class="card-title">Add New Visitor Data</h4>
                      
                        <div class="form-group{{ $errors->has('visitor_name') ? ' has-error' : '' }}">
                            <label for="visitor_name" class="col-md-4 control-label">Visitor Name</label>
                            <div class="col-md-6">
                                <input id="visitor_name" type="text" class="form-control" name="visitor_name"  >
                                @if ($errors->has('visitor_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitor_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('visitor_email') ? ' has-error' : '' }}">
                            <label for="visitor_email" class="col-md-4 control-label">Visitor Email</label>
                            <div class="col-md-6">
                                <input id="visitor_email" type="text" class="form-control" name="visitor_email"  >
                                @if ($errors->has('visitor_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitor_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('visitor_mobile_no') ? ' has-error' : '' }}">
                            <label for="visitor_mobile_no" class="col-md-4 control-label">Visitor Mobile Number</label>
                            <div class="col-md-6">
                                <input id="visitor_mobile_no" type="text" class="form-control" name="visitor_mobile_no"  >
                                @if ($errors->has('visitor_mobile_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitor_mobile_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('visitor_address') ? ' has-error' : '' }}">
                            <label for="visitor_address" class="col-md-4 control-label">Visitor Address</label>
                            <div class="col-md-6">
                                <input id="visitor_address" type="text" class="form-control" name="visitor_address"  >
                                @if ($errors->has('visitor_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitor_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						{{-- <a href="javascript:void(0)" class="btn btn-primary" id="btn-scan" onClick="open_camera()">SCAN</a>
						@include('modal-first') --}}
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

