@section('js')
<script type="text/javascript">
$(document).ready(function(){

$('#visitor_table').DataTable({

	processing:true,
	serverSide:true,
	ajax:"{{ route('visitor.fetchall') }}",
	columns:[
		{
			data:'visitors.visitor_name',
			name: 'visitors.visitor_name'
		},
		{
			data:'availables.employees.employee_name',
			name:'availables.employees.employee_name'
		},
		{
			data: 'availables.employees.departments.department_name',
			name: 'availables.employees.departments.department_name'
		},
		{
			data:'visitor_enter_time',
			name: 'visitor_enter_time'
		},
		{
			data:'visitor_out_time',
			name:'visitor_out_time'
		},
		{
			data:'visitor_status',
			name:'visitor_status'
		},
		{
			data:'users.name',
			name:'users.name'
		},
		{
			data:'action',
			name:'action',
			orderable:false
		}
	],
	"order": [[ 3, 'desc' ]]
});
$(document).on('click', '.delete', function(){

	var id = $(this).data('id');

	if(confirm("Are you sure you want to remove it?"))
	{
		window.location.href = "/visitor/delete/" + id;
	}

});

});
</script>
@stop
@extends('dashboard')

@section('content')
<div class="row">

	<div class="col-lg-2">
	  <a href="{{ route('visitor.add') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Add Visitor</a>
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
					<h4 class="card-title">Visitor Management</h4>
					
					<div class="table-responsive">
					  <table class="table table-striped" id="visitor_table">
						<thead>
						  <tr>
							<th>Visitor Name</th>
							<th>Meet Person Name</th>
							<th>Department</th>
							<th>In Time</th>
							<th>Out Time</th>
							<th>Status</th>
							<th>Enter By</th>
							<th>Action</th>
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