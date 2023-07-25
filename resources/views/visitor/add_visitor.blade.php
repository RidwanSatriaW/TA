@section('js')
<script type="text/javascript">

	$(document).ready(function() {
				$('#necessity').on('change', function() {
				   let necessityID = $(this).val();
				//    console.log(necessityID);
				   
					   $.ajax({
						   url: '/visitor/get_available/'+necessityID,
						   type: "GET",
						   data : {"_token":"{{ csrf_token() }}"},
						//    dataType: "json",
						   success:function(msg)
						   {
							$('#person').html(msg)
						 },
						 error:function(data){
	
							 console.error(data);
						 },
					   });
				   
				});
	});
	
	</script>
	@stop

@extends('dashboard')
@section('content')

<form method="POST" action="{{ route('visitor.add_validation_first') }}">
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
                      <h4 class="card-title">Add New Visitor</h4>
						
						<div class="form-group">
                            <label class="col-md-4 control-label">Visitor</label>
                            <div class="col-md-6">
                            <select class="form-control" name="user" id="user"  >
                                <option value="" disabled selected hidden>-----</option>
							@foreach ($users as $item)
								<option value="{{ $item->id }}">{{ $item->visitor_email}}</option>
							@endforeach
                            </select>
							@if ($errors->has('user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-4 control-label">Necessity</label>
                            <div class="col-md-6">
                            <select class="form-control" name="necessity" id="necessity"  >
                                <option value="" disabled selected hidden>-----</option>
							@foreach ($keperluan as $item)
								<option value="{{ $item->id }}">{{ $item->keperluan_name}}</option>
							@endforeach
                            </select>
							@if ($errors->has('necessity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('necessity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-4 control-label">Meet Person</label>
                            <div class="col-md-6">
                            <select class="form-control" name="person" id="person"  >
                                <option value="">pilih</option>
                            </select>
							@if ($errors->has('person'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('person') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						{{-- <a href="javascript:void(0)" class="btn btn-primary" id="btn-scan" onClick="open_camera()">SCAN</a>
						@include('modal-first') --}}
						<button type="submit" class="btn btn-primary" id="submit">
							Scan
						</button>
                       
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
@endsection

