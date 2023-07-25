@extends('dashboard')
@section('content')

<div class="row">
	<div class="col-md-12 d-flex align-items-stretch grid-margin">
	  <div class="row flex-grow">
		<div class="col-12">
		  <div class="card">
			<div class="card-body">
			  <h4 class="card-title">Detail Visitor</h4>
				<div class="form-group">
					<label for="visitor_name" class="col-md-4 control-label">Visitor Name</label>
					<div class="col-md-6">
						<input id="visitor_name" type="text" class="form-control" name="visitor_name" value="{{ $visitor->visitors->visitor_name }}" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="visitor_email" class="col-md-4 control-label">Visitor Email</label>
					<div class="col-md-6">
						<input id="visitor_email" type="text" class="form-control" name="visitor_email" value="{{ $visitor->visitors->visitor_email }}" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="visitor_mobile_no" class="col-md-4 control-label">Visitor Mobile Number</label>
					<div class="col-md-6">
						<input id="visitor_mobile_no" type="text" class="form-control" name="visitor_mobile_no" value="{{ $visitor->visitors->visitor_mobile_no }}" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="visitor_address" class="col-md-4 control-label">Visitor Address</label>
					<div class="col-md-6">
						<input id="visitor_address" type="text" class="form-control" name="visitor_address" value="{{ $visitor->visitors->visitor_address }}" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="visitor_enter_time" class="col-md-4 control-label">Enter Time</label>
					<div class="col-md-6">
						<input id="visitor_enter_time" type="text" class="form-control" name="visitor_enter_time" value="{{ $visitor->visitor_enter_time }}" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="visitor_out_time" class="col-md-4 control-label">Out Time</label>
					<div class="col-md-6">
						<input id="visitor_out_time" type="text" class="form-control" name="visitor_out_time" value="{{ $visitor->visitor_out_time }}" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="first_emotion" class="col-md-4 control-label">First Emotion</label>
					<div class="col-md-6">
						<input id="first_emotion" type="text" class="form-control" name="first_emotion" value="{{ $visitor->first_emotion }}" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="feedback" class="col-md-4 control-label">Last Emotion</label>
					<div class="col-md-6">
						<input id="feedback" type="text" class="form-control" name="feedback" value="{{ $visitor->feedback }}" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="person_to_meet" class="col-md-4 control-label">Person To Meet</label>
					<div class="col-md-6">
						<input id="person_to_meet" type="text" class="form-control" name="person_to_meet" value="{{ $visitor->availables->employees->employee_name }} ( {{ $visitor->availables->employees->departments->department_name }} )" required readonly="">
					</div>
				</div>
				<div class="form-group">
					<label for="enter_by" class="col-md-4 control-label">Enter by</label>
					<div class="col-md-6">
						<input id="enter_by" type="text" class="form-control" name="enter_by" value="{{ $visitor->users->name }}" required readonly="">
					</div>
				</div>

				<a href="{{route('visitor')}}" class="btn btn-danger pull-left">Back</a>
			</div>
		  </div>
		</div>
	  </div>
	</div>

</div>

@endsection