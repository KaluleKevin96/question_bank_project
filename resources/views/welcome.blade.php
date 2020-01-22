@extends('layouts.app')

@section('content')
 
            <div class="container">
                
				<div class="title-text">
                    What Question Papers may you be looking for ?
                </div>
				<div class="search_form">
					<form class="form" action="" method="">
						<div class="row">
							<div class = "col-md-3"> 
								
								<div class="form-group">
									<label for="college" > College </label>
									<select class="form-control" name="college" id="college" >
										<option value = ""> Select College </option>
									</select>
								</div>
								
							</div>
							<div class = "col-md-3"> 
							
								<div class="form-group">
									<label for="course" > Course </label>
									<select class="form-control" name="course" id="course" >
										<option value = ""> Select Course </option>
									</select>
								</div>
								
							</div>
							<div class = "col-md-3"> 
							
								<div class="form-group">
									<label for="semester" > Semester </label>
									<select class="form-control" name="semester" id="semester" >
										<option value = ""> Select Semester </option>
										<option value = "1"> First Semester </option>
										<option value = "2"> Second Semester </option>
									</select>
								</div>
								
							</div>
							<div class = "col-md-3"> 
							
								<div class="form-group" style="float: right;margin-top: 14%;">
									<input type="button" class="btn btn-primary btn-md" name="search_query_button" value = "SEARCH" />
								</div>
								
							</div>
						</div>
					</form>
				</div>
				
				<div class="question_papers_table table-responsive">
					
					<table class="table table-hover" id="question_papers_table" >
						<thead>
							<th> TITLE </th>
							<th> COURSE NAME </th>
							<th> COLLEGE </th>
							<th> SEMESTER </th>
							
						</thead>
						<tbody>
							<td> Paper 1 </td>
							<td> Course 1 </td>
							<td> College 1 </td>
							<td> First </td>
							<td> <a href="#" class="btn btn-outline-info" > <i class="fa fa-download"></i> </a> </td>
						</tbody>
						
					</table>
				</div>
			
            </div>
		<script>
			
			$('question_papers_table').dataTable();
			
		</script>
 @endsection
