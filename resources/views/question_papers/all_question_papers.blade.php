@extends('layouts.app')

@section('content')

<?php use App\Http\Controllers\HelpersController; ?>
<!--<div class="au-card">-->
<!--	<div class="au-card-inner">-->
<!---->
<!--	</div>-->
<!--</div>-->
<!--- ALL ACTIVE QUESTION PAPERS CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-success">
			All UPLOADED QUESTION PAPERS
			@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin")
			<small>
				<span class="float-right mt-1">
					<a href="{{ route('add_question_paper_form') }}" class="btn btn-md btn-primary" title="Upload Question Paper"> <i class="fa fa-plus-square"></i>  </a>
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
							<th> PAPER TITLE </th>
							<th> COURSE </th>
							<th> SEMESTER </th>
						</tr>
					</thead>
					<tbody>
						@if($all_question_papers->count() != 0)
							@foreach($all_question_papers as $paper)
							<tr>
								<td> <?= $paper->course_unit_code ?> </td>
								<td> <?= $paper->paper_title ?> </td>
								<td> <?= $paper->associated_course ?> </td>

                <td>
									<a href="#{{-- route('download_question_paper' ,['security'=>md5('security'),'question_paper_id'=>$paper->id]) --}}" class="btn btn-md btn-outline-info" title="DOWNLOAD <?= strtoupper($paper->paper_title) ?>"> <i class="zmdi zmdi-download"></i>
									</a>
								</td>

                <td class="text-center"> {{ HelpersController::number_to_position_word($paper->semester) }} </td>
								@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
									<td>
										<a href="{{ route('edit_question_paper_form' ,['security'=>md5('security'),'question_paper_id'=>$paper->id]) }}" class="btn btn-md btn-primary" title="EDIT <?= strtoupper($paper->paper_title) ?>"> <i class="zmdi zmdi-edit"></i>
										</a></td>
									<td><a href="{{ route('delete_question_paper' ,['security'=>md5('security'),'quest
									'=>$paper->id]) }}" class="btn btn-md btn-danger" title="DE-REGISTER <?= strtoupper($paper->paper_title) ?>"> <i class="zmdi zmdi-delete"></i> </a></td>
								@endif
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="7" class="text-center text-danger"> NO QUESTION PAPERS UPLOADED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!--- ALL INACTIVE QUESTION PAPERS CARD -->
<div class="card">
	<div class="card-header">
		<strong class="card-title title-text text-center text-danger">
			All DE-REGISTERED QUESTION PAPERS
		</strong>
	</div>
	<div class="card-body">
		<div class="container">
			<div class="table-responsive">

				<table class="table table-striped">
          <thead class="table-secondary">
            <tr>
							<th> COURSE UNIT CODE </th>
							<th> PAPER TITLE </th>
							<th> COURSE </th>
							<th> SEMESTER </th>
							<th> DE-REGISTERED ON</th>
              @if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
							<th></th>
              @endif
						</tr>
					</thead>
          <tbody>
						@if($inactive_question_papers->count() != 0)
							@foreach($inactive_question_papers as $paper )
                <tr>
  								<td> <?= $paper->course_unit_code ?> </td>
  								<td> <?= $paper->paper_title ?> </td>
  								<td> <?= $paper->associated_course ?> </td>
                  <td class="text-center"> {{ HelpersController::number_to_position_word($paper->semester) }} </td>
  									<td> <?= $paper->updated_at ?> </td>
  								@if(Auth::check() && Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "college_admin")
  									<td>
  										<a href="{{ route('reactivate_question_paper' ,['security'=>md5('security'),'question_paper_id'=>$paper->id]) }}" class="btn btn-md btn-success" title="RE-REGISTER <?= strtoupper($paper->paper_title) ?>"> <i class="zmdi zmdi-undo"></i>
  										</a></td>
  								@endif
  							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5" class="text-center text-info"> NO QUESTION PAPERS DE-REGISTERED </td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
