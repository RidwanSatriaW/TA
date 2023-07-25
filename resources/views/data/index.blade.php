@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#data_table').DataTable({
	  processing:true,
		serverSide:true,
		ajax:'{{ route("data.fetch_all") }}',
		columns:[
			{
				data:'visitor_name',
				name:'visitor_name'
			},
			{
				data: 'visitor_email',
				name: 'visitor_email'
			},
			{
				data: 'visitor_mobile_no',
				name: 'visitor_mobile_no'
			},
			{
				data: 'visitor_address',
				name: 'visitor_address'
			},
			{
				data:'action',
				name:'action',
				orderable:false
			}
		]
    });

	} );

</script>
@stop
@extends('dashboard')

@section('content')
<div class="row">

	<div class="col-lg-2">
	  <a href="/data/add" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Add Data Visitor</a>
	</div>
	<div class="col-lg-12">
					@if(session()->has('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
					@endif
	</div>
</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
  
				  <div class="card-body">
					<h4 class="card-title">Visitor Data Management</h4>
					
					<div class="table-responsive">
					  <table class="table table-striped" id="data_table">
						<thead>
						  <tr>
							<th>
							  Visitor Name
							</th>
							<th>
							  Visitor Email
							</th>
							<th>
							  Visitor Mobile Number
							</th>
							<th>
							  Visitor Address
							</th>
							<th>
							  Action
							</th>
						  </tr>
						</thead>
						<tbody>
						</tbody>
					  </table>
					</div>
				 {{--  {!! $datas->links() !!} --}}
				  </div>
				</div>
			  </div>
			</div>
@endsection