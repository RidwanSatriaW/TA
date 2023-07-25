@extends('dashboard')
@section('content')
<h2 class="mt-3">Visitor Management</h2>
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    	<li class="breadcrumb-item"><a href="/visitor">Visitor Management</a></li>
    	<li class="breadcrumb-item active">Edit Visitor</li>
  	</ol>
</nav>

<div class="row mt-4">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">Edit Visitor</div>
			<div class="card-body">
				<form method="POST" action="{{ route('visitor.edit_validation') }}">
					@csrf
					<input type="text" value="{{ $visitor->id }}" hidden name="visitor_id" id="visitor_id">
					<a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-scan">SCAN</a>
					@include('modal-last')
				</form>
			</div>
		</div>
	</div>
</div>


<script>

</script>
@endsection