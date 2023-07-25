@section('js')
<script type="text/javascript">
$(document).ready(function() {
	$('#user_table').DataTable({
		processing:true,
		serverSide:true,
		ajax:"{{ route('sub_user.fetchall') }}",
		columns:[
			{
				data:'name',
				name:'name'
			},
			{
				data:'email',
				name:'email'
			},
			{
				data:'action',
				name:'action',
				orderable:false
			}
		]
	});
	
	$(document).on('click', '.delete', function(){

		var id = $(this).data('id');

		Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!',
		cancelButtonText: 'Cancel',
		reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
			Swal.showLoading();
			var url = '{{ route('sub_user.delete', ':id')}}';
			url = url.replace(':id', id);  
			var token = "{{ csrf_token() }}";
			$.ajax({
				type: 'POST',
				url: url,
				data: {'_token': token, '_method': 'DELETE'},
				success: function (response) {
					Swal.close();
					if (response.success == true) {
					Swal.fire(
						'Deleted!',
						'User has been deleted.',
						'success'
					)
					$('#user_table').DataTable().ajax.reload(null, false);
					}
				}
				});
			}
		});
	});

});
</script>
@stop
	

@extends('dashboard')

@section('content')
<div class="row">

	<div class="col-lg-2">
	  <a href="{{ route('sub_user.add') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Add Sub User</a>
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
					<h4 class="card-title">Sub User Management</h4>
					
					<div class="table-responsive">
					  <table class="table table-striped" id="user_table">
						<thead>
						  <tr>
							<th>Name</th>
							<th>Email</th>
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