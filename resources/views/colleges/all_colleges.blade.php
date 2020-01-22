@extends('layouts.app')

@section('content')

<!--<div class="au-card">-->
<!--	<div class="au-card-inner">-->
<!---->
<!--	</div>-->
<!--</div>-->
<!--- ALL ACTIVE COLLEGES CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-success">
			All REGISTERED COLLEGES
			@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin")
			<small>
				<span class="float-right mt-1">
					<a href="{{ route('add_college_form') }}" class="btn btn-md btn-primary" title="Register New College"> <i class="fa fa-plus-circle"></i> </a>
				</span>
			</small>
			@endif
		</strong>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="table-responsive">

				<table class="table table-striped">
					<thead class="table-secondary">
						<tr>
							<th> COLLEGE NUMBER </th>
							<th> COLLEGE NAME</th>
							<th> COLLEGE DESCRIPTION </th>
              <th> REGISTERED ON </th>
              @if(Auth::check() && Auth::user()->position == "super_admin")
							<th></th>
							<th></th>
              @endif
						</tr>
					</thead>
					<tbody>
						@if($active_colleges->count() != 0)
							@foreach($active_colleges as $college )
							<tr>
								<td> <?= $college->college_number ?> </td>
								<td> <?= $college->college_name ?> </td>
								<td> <?= $college->college_description ?> </td>
									<td> <?= $college->created_at ?> </td>
								@if(Auth::check() && Auth::user()->position == "super_admin")
									<td>
										<a href="{{ route('edit_college_form' ,['security'=>md5('security'),'college_id'=>$college->id]) }}" class="btn btn-md btn-primary" title="EDIT <?= strtoupper($college->college_name) ?>"> <i class="zmdi zmdi-edit"></i>
										</a></td>
									<td><a href="{{ route('delete_college' ,['security'=>md5('security'),'college_id'=>$college->id]) }}" class="btn btn-md btn-danger" title="DE-REGISTER <?= strtoupper($college->college_name) ?>"> <i
											  class="zmdi zmdi-delete"></i> </a></td>
								@endif
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5" class="text-center text-danger"> NO ACTIVE COLLEGES REGISTERED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!--- ALL INACTIVE COLLGES CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-danger">
			All DE-REGISTERED COLLEGES
		</strong>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="table-responsive">

				<table class="table table-striped">
          <thead class="table-secondary">
						<tr>
							<th> COLLEGE NUMBER </th>
							<th> COLLEGE NAME</th>
							<th> COLLEGE DESCRIPTION </th>
              <th> DE-REGISTERED ON </th>
              @if(Auth::check() && Auth::user()->position == "super_admin")
							<th></th>
              @endif
						</tr>
					</thead>
          <tbody>
						@if($inactive_colleges->count() != 0)
							@foreach($inactive_colleges as $college )
							<tr>
								<td> <?= $college->college_number ?> </td>
								<td> <?= $college->college_name ?> </td>
								<td> <?= $college->college_description ?> </td>
									<td> <?= $college->updated_at ?> </td>
								@if(Auth::check() && Auth::user()->position == "super_admin")
									<td>
										<a href="{{ route('reactivate_college' ,['security'=>md5('security'),'college_id'=>$college->id]) }}" class="btn btn-md btn-success" title="RE-REGISTER <?= strtoupper($college->college_name) ?>"> <i class="zmdi zmdi-undo"></i>
										</a></td>
								@endif
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5" class="text-center text-info"> NO COLLEGES DE-REGISTERED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
