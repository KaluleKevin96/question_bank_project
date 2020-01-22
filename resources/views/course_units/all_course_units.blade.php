@extends('layouts.app')

@section('content')

<?php use App\Http\Controllers\HelpersController; ?>
<!--<div class="au-card">-->
<!--	<div class="au-card-inner">-->
<!---->
<!--	</div>-->
<!--</div>-->
<!--- ALL ACTIVE COURSE UNITS CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-success">
			All REGISTERED COURSE UNITS
			@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin")
			<small>
				<span class="float-right mt-1">
					<a href="{{ route('add_course_unit_form') }}" class="btn btn-md btn-primary" title="Register New Course Unit"> <i class="fa fa-plus-square"></i> </a>
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
							<th> COURSE UNIT CODE </th>
							<th> COURSE UNIT NAME</th>
							<th> COURSE </th>
				            <th> CREDIT UNITS </th>
				            <th> SEMESTER </th>
 @if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
							<th></th>
							<th></th>
@endif
						</tr>
					</thead>
					<tbody>
						@if($active_course_units->count() != 0)
							@foreach($active_course_units as $course_unit )
							<tr>
								<td> <?= $course_unit->course_unit_code ?> </td>
								<td> <?= $course_unit->course_unit_name ?> </td>
								<td> <?= $course_unit->associated_course ?> </td>
                <td> <?= $course_unit->credit_units ?> CU </td>
                <td class="text-center"> {{ HelpersController::number_to_position_word($course_unit->course_unit_semester) }} </td>
								@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
									<td>
										<a href="{{ route('edit_course_unit_form' ,['security'=>md5('security'),'course_unit_id'=>$course_unit->id]) }}" class="btn btn-md btn-primary" title="EDIT <?= strtoupper($course_unit->course_unit_name) ?>"> <i class="zmdi zmdi-edit"></i>
										</a></td>
									<td><a href="{{ route('delete_course_unit' ,['security'=>md5('security'),'course_unit_id'=>$course_unit->id]) }}" class="btn btn-md btn-danger" title="DE-REGISTER <?= strtoupper($course_unit->course_unit_name) ?>"> <i
											  class="zmdi zmdi-delete"></i> </a></td>
								@endif
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="7" class="text-center text-danger"> NO ACTIVE COURSE UNITS REGISTERED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!--- ALL INACTIVE COURSES CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-danger">
			All DE-REGISTERED COURSE UNITS
		</strong>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="table-responsive">

				<table class="table table-striped">
          <thead class="table-secondary">
            <tr>
							<th> COURSE UNIT CODE </th>
							<th> COURSE UNIT NAME</th>
							<th> COURSE </th>
              <th> CREDIT UNITS </th>
              <th> SEMESTER </th>
              <th> DE-REGISTERED ON </th>
              @if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
							<th></th>
              @endif
						</tr>
					</thead>
          <tbody>
						@if($inactive_course_units->count() != 0)
							@foreach($inactive_course_units as $course_unit )
                <tr>
  								<td> <?= $course_unit->course_unit_code ?> </td>
  								<td> <?= $course_unit->course_unit_name ?> </td>
  								<td> <?= $course_unit->associated_course ?> </td>
                  <td> <?= $course_unit->credit_units ?> </td>
                  <td class="text-center"> <?= $course_unit->course_unit_semester ?> Years </td>
  									<td> <?= $course_unit->updated_at ?> </td>
  								@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
  									<td>
  										<a href="{{ route('reactivate_course_unit' ,['security'=>md5('security'),'course_unit_id'=>$course_unit->id]) }}" class="btn btn-md btn-success" title="RE-REGISTER <?= strtoupper($course_unit->course_unit_name) ?>"> <i class="zmdi zmdi-undo"></i>
  										</a></td>
  								@endif
  							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5" class="text-center text-info"> NO COURSE UNITS DE-REGISTERED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
