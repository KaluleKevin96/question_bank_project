@extends('layouts.app')

@section('content')

<!--<div class="au-card">-->
<!--	<div class="au-card-inner">-->
<!---->
<!--	</div>-->
<!--</div>-->
<!--- ALL ACTIVE COURSES CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-success">
			All REGISTERED COURSES
			@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin")
			<small>
				<span class="float-right mt-1">
					<a href="{{ route('add_course_form') }}" class="btn btn-md btn-primary" title="Register New Course"> <i class="fa fa-plus-square"></i> </a>
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
							<th> COURSE CODE </th>
							<th> COURSE NAME</th>
							<th> COLLEGE </th>
              <th> COURSE DURATION </th>
              <th> REGISTERED ON </th>
              @if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
							<th></th>
							<th></th>
              @endif
						</tr>
					</thead>
					<tbody>
						@if($active_courses->count() != 0)
							@foreach($active_courses as $course )
							<tr>
								<td> <?= $course->course_code ?> </td>
								<td> <?= $course->course_name ?> </td>
								<td> <?= $course->associated_college ?> </td>
                <td class="text-center"> <?= $course->course_duration ?> Years </td>
									<td> <?= $course->created_at ?> </td>
								@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
									<td>
										<a href="{{ route('edit_course_form' ,['security'=>md5('security'),'course_id'=>$course->id]) }}" class="btn btn-md btn-primary" title="EDIT <?= strtoupper($course->course_name) ?>"> <i class="zmdi zmdi-edit"></i>
										</a></td>
									<td><a href="{{ route('delete_course' ,['security'=>md5('security'),'course_id'=>$course->id]) }}" class="btn btn-md btn-danger" title="DE-REGISTER <?= strtoupper($course->course_name) ?>"> <i
											  class="zmdi zmdi-delete"></i> </a></td>
								@endif
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="7" class="text-center text-danger"> NO ACTIVE COURSES REGISTERED </td>
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
			All DE-REGISTERED COURSES
		</strong>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="table-responsive">

				<table class="table table-striped">
          <thead class="table-secondary">
            <tr>
							<th> COURSE CODE </th>
							<th> COURSE NAME</th>
							<th> COLLEGE </th>
              <th> COURSE DURATION </th>
              <th> DE-REGISTERED ON </th>
              @if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
							<th></th>
              @endif
						</tr>
					</thead>
          <tbody>
						@if($inactive_courses->count() != 0)
							@foreach($inactive_courses as $course )
                <tr>
  								<td> <?= $course->course_code ?> </td>
  								<td> <?= $course->course_name ?> </td>
  								<td> <?= $course->associated_college ?> </td>
                  <td class="text-center"> <?= $course->course_duration ?> Years </td>
  									<td> <?= $course->updated_at ?> </td>
  								@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
  									<td>
  										<a href="{{ route('reactivate_course' ,['security'=>md5('security'),'course_id'=>$course->id]) }}" class="btn btn-md btn-success" title="RE-REGISTER <?= strtoupper($course->course_name) ?>"> <i class="zmdi zmdi-undo"></i>
  										</a></td>
  								@endif
  							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5" class="text-center text-info"> NO COURSES DE-REGISTERED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
