@extends('layouts.app')

@section('content')

<!--<div class="au-card">-->
<!--	<div class="au-card-inner">-->
<!---->
<!--	</div>-->
<!--</div>-->
<!--- ALL ACTIVE USERS CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-success">
			All ACTIVE USERS
			@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin")
			<small>
				<span class="float-right mt-1">
					<a href="{{ route('add_user_form') }}" class="btn btn-md btn-primary" title="Register New User"> <i class="zmdi zmdi-account-add"></i> </a>
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
							<th> USER NUMBER </th>
							<th> USER NAME</th>
							<th> CONTACT </th>
							<th> EMAIL </th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@if($active_users->count() != 0)
							@foreach($active_users as $user )
							<tr>
								<td> <?= $user->user_number ?> </td>
								<td> <?= $user->last_name . " " . $user->first_name ?> </td>
								<td> <?= $user->contact ?> </td>
								<td> <?= $user->email ?> </td>
								@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::user()->position == "admin")
								@if(Auth::user()->user_number == $user->user_number)
									<td><a href="{{ route('edit_user_form' ,['security'=>md5('security'),'user_id'=>$user->id]) }}" class="btn btn-md btn-primary" title="Edit Your Account"> <i class="zmdi zmdi-edit"></i> </a></td>
									<td></td>
									@else
									<td>
										<a href="{{ route('edit_user_form' ,['security'=>md5('security'),'user_id'=>$user->id]) }}" class="btn btn-md btn-primary" title="EDIT <?= $user->last_name . " ". $user->first_name?>'S ACCOUNT"> <i class="zmdi zmdi-edit"></i>
										</a></td>
									<td><a href="{{ route('delete_user' ,['security'=>md5('security'),'user_id'=>$user->id]) }}" class="btn btn-md btn-danger" title="DE-ACTIVATE <?= $user->last_name . " ". $user->first_name?>'S ACCOUNT"> <i
											  class="zmdi zmdi-delete"></i> </a></td>
									@endif
									@else
									@if(Auth::user()->user_number == $user->user_number)
										<td><a href="{{ route('edit_user_form' ,['security'=>md5('security'),'user_id'=>$user->id]) }}" class="btn btn-md btn-primary" title="Edit Your Account"> <i class="zmdi zmdi-edit"></i> </a></td>
										<td></td>
										@endif
										@endif
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5" class="text-center text-danger"> NO ACTIVE USERS REGISTERED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!--- ALL ACTIVE USERS CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-danger">
			All IN-ACTIVE USERS
		</strong>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="table-responsive">

				<table class="table table-striped">
					<thead class="table-secondary">
						<tr>
							<th> USER NUMBER </th>
							<th> USER NAME</th>
							<th> CONTACT </th>
							<th> EMAIL </th>
							<th>INACTIVATED ON</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@if($inactive_users->count() != 0)
							@foreach($inactive_users as $user )
							<tr>
								<td> <?= $user->user_number ?> </td>
								<td> <?= $user->last_name . " " . $user->first_name ?> </td>
								<td> <?= $user->contact ?> </td>
								<td> <?= $user->email ?> </td>
								<td> <?= $user->updated_at ?> </td>
								@if((Auth::check() && Auth::user()->position == "super_admin" || Auth::user()->position == "admin") && Auth::user()->user_number != $user->user_number)
									<td>
										<a href="{{ route('reactivate_user' ,['security'=>md5('security'),'user_id'=>$user->id]) }}" class="btn btn-md btn-success" title="RE-ACTIVATE <?= $user->last_name . " ". $user->first_name?>'S ACCOUNT"> <i class="zmdi zmdi-undo"></i>
										</a>
									</td>
									@else
										<td></td>
										@endif
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5" class="text-center text-success"> NO USERS HAVE BEEN INACTIVATED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
