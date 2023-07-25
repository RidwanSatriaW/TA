@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#department_table').DataTable({
	  processing:true,
		serverSide:true,
		ajax:'{{ route("department.fetch_all") }}',
		columns:[
			{
				data:'department_name',
				name:'department_name'
			},
			{
				data:'status',
				name:'status',
				render: function(data, type, row) {
					if (data === 0) {
						return '<span class="badge bg-danger text-white">Non Active</span>';
					} else {
						return '<span class="badge bg-success text-white">Active</span>';
					}
				}
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
	  <a href="/department/add" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Add Department</a>
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
					<h4 class="card-title">Department Management</h4>
					
					<div class="table-responsive">
					  <table class="table table-striped" id="department_table">
						<thead>
						  <tr>
							<th>
							  Department Name
							</th>
							<th>
							  Status
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