            @extends('layouts.app')

            @section('content')

            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-file"></i>
                                    <h2> {!! $number_of_question_papers !!} </h2>
                                </div>
                                <div class="text">

                                    <span>Question Papers</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <!-- <canvas id="widgetChart1"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-library"></i>
                                    <h2>{!! $number_of_courses!!}</h2>
                                </div>
                                <div class="text">
                                    <!-- <h2>388,688</h2> -->
                                    <span>Registered Courses</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <!-- <canvas id="widgetChart2"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-store"></i>
                                    <h2>{!! $number_of_colleges !!}</h2>
                                </div>
                                <div class="text">
                                    <!-- <h2>1,086</h2> -->
                                    <span>Registered Colleges</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <!-- <canvas id="widgetChart3"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                    <h2> {!! $number_of_users !!}</h2>
                                </div>
                                <div class="text">
                                    <!-- <h2>10</h2> -->
                                    <span>Registered Students</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <!-- <canvas id="widgetChart4"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="overview-wrap">
                                        <!--<h2 class="title-1">WELCOME TO THE QUESTION BANK</h2>-->
                                      @if(Auth::check() && (Auth::user()->position == "super_admin" || Auth::check() && Auth::user()->position == "admin"))
                                        <a href="{{route('add_question_paper_form')}}" class="au-btn au-btn-icon au-btn--blue">
                                            <i class="zmdi zmdi-plus"></i>Upload Question Paper
                                        </a>
                                      @endif
                                    </div>
                                </div>
                            </div>
                            <!-- search form section -->
                            <div class="title-text">
                                What Question Papers may you be looking for ?
                            </div>

                            <div class="search_form">
                                <form class="form" action="" method="">
                                    <div class="row">
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label for="college"> College </label>
                                                <select class="form-control" name="college" id="college">
                                                    <option value=""> Select College </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label for="course"> Course </label>
                                                <select class="form-control" name="course" id="course">
                                                    <option value=""> Select Course </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label for="semester"> Semester </label>
                                                <select class="form-control" name="semester" id="semester">
                                                    <option value=""> Select Semester </option>
                                                    <option value="1"> First Semester </option>
                                                    <option value="2"> Second Semester </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group" style="float: right;margin-top: 14%;">
                                                <input type="button" class="btn btn-primary btn-md" name="search_query_button" value="SEARCH" />
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="title-1 m-b-25">SEARCH RESULTS </h2>
                    <div class="table-responsive table--no-card m-b-40">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th> TITLE </th>
                                    <th> COURSE NAME </th>
                                    <th> COLLEGE </th>
                                    <th> SEMESTER </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Paper 1 </td>
                                    <td> Course 1 </td>
                                    <td> College 1 </td>
                                    <td> First </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Ddownload">
                                                <i class="zmdi zmdi-download"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </button>-->
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Paper 2 </td>
                                    <td> Course 2 </td>
                                    <td> College 2 </td>
                                    <td> Second </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Ddownload">
                                                <i class="zmdi zmdi-download"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </button>-->
                                        </div>
                                    </td>
                                </tr>
                                <tr class="tr-shadow">
                                    <td> Paper 3 </td>
                                    <td> Course 3 </td>
                                    <td> College 3 </td>
                                    <td> First </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Ddownload">
                                                <i class="zmdi zmdi-download"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            <!--<button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                                <i class="zmdi zmdi-more"></i>
                                                            </button>-->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!--  <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                                                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                                                    <div class="bg-overlay bg-overlay--blue"></div>
                                                                    <h3>
                                                                        <i class="zmdi zmdi-account-calendar"></i>26 April, 2018</h3>
                                                                    <button class="au-btn-plus">
                                                                        <i class="zmdi zmdi-plus"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="au-task js-list-load">
                                                                    <div class="au-task__title">
                                                                        <p>Tasks for John Doe</p>
                                                                    </div>
                                                                    <div class="au-task-list js-scrollbar3">
                                                                        <div class="au-task__item au-task__item--danger">
                                                                            <div class="au-task__item-inner">
                                                                                <h5 class="task">
                                                                                    <a href="#">Meeting about plan for Admin Template 2018</a>
                                                                                </h5>
                                                                                <span class="time">10:00 AM</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="au-task__item au-task__item--warning">
                                                                            <div class="au-task__item-inner">
                                                                                <h5 class="task">
                                                                                    <a href="#">Create new task for Dashboard</a>
                                                                                </h5>
                                                                                <span class="time">11:00 AM</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="au-task__item au-task__item--primary">
                                                                            <div class="au-task__item-inner">
                                                                                <h5 class="task">
                                                                                    <a href="#">Meeting about plan for Admin Template 2018</a>
                                                                                </h5>
                                                                                <span class="time">02:00 PM</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="au-task__item au-task__item--success">
                                                                            <div class="au-task__item-inner">
                                                                                <h5 class="task">
                                                                                    <a href="#">Create new task for Dashboard</a>
                                                                                </h5>
                                                                                <span class="time">03:30 PM</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="au-task__item au-task__item--danger js-load-item">
                                                                            <div class="au-task__item-inner">
                                                                                <h5 class="task">
                                                                                    <a href="#">Meeting about plan for Admin Template 2018</a>
                                                                                </h5>
                                                                                <span class="time">10:00 AM</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="au-task__item au-task__item--warning js-load-item">
                                                                            <div class="au-task__item-inner">
                                                                                <h5 class="task">
                                                                                    <a href="#">Create new task for Dashboard</a>
                                                                                </h5>
                                                                                <span class="time">11:00 AM</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="au-task__footer">
                                                                        <button class="au-btn au-btn-load js-load-btn">load more</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                                                <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                                                    <div class="bg-overlay bg-overlay--blue"></div>
                                                                    <h3>
                                                                        <i class="zmdi zmdi-comment-text"></i>New Messages</h3>
                                                                    <button class="au-btn-plus">
                                                                        <i class="zmdi zmdi-plus"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="au-inbox-wrap js-inbox-wrap">
                                                                    <div class="au-message js-list-load">
                                                                        <div class="au-message__noti">
                                                                            <p>You Have
                                                                                <span>2</span>

                                                                                new messages
                                                                            </p>
                                                                        </div>
                                                                        <div class="au-message-list">
                                                                            <div class="au-message__item unread">
                                                                                <div class="au-message__item-inner">
                                                                                    <div class="au-message__item-text">
                                                                                        <div class="avatar-wrap">
                                                                                            <div class="avatar">
                                                                                                <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text">
                                                                                            <h5 class="name">John Smith</h5>
                                                                                            <p>Have sent a photo</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="au-message__item-time">
                                                                                        <span>12 Min ago</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="au-message__item unread">
                                                                                <div class="au-message__item-inner">
                                                                                    <div class="au-message__item-text">
                                                                                        <div class="avatar-wrap online">
                                                                                            <div class="avatar">
                                                                                                <img src="images/icon/avatar-03.jpg" alt="Nicholas Martinez">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text">
                                                                                            <h5 class="name">Nicholas Martinez</h5>
                                                                                            <p>You are now connected on message</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="au-message__item-time">
                                                                                        <span>11:00 PM</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="au-message__item">
                                                                                <div class="au-message__item-inner">
                                                                                    <div class="au-message__item-text">
                                                                                        <div class="avatar-wrap online">
                                                                                            <div class="avatar">
                                                                                                <img src="images/icon/avatar-04.jpg" alt="Michelle Sims">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text">
                                                                                            <h5 class="name">Michelle Sims</h5>
                                                                                            <p>Lorem ipsum dolor sit amet</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="au-message__item-time">
                                                                                        <span>Yesterday</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="au-message__item">
                                                                                <div class="au-message__item-inner">
                                                                                    <div class="au-message__item-text">
                                                                                        <div class="avatar-wrap">
                                                                                            <div class="avatar">
                                                                                                <img src="images/icon/avatar-05.jpg" alt="Michelle Sims">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text">
                                                                                            <h5 class="name">Michelle Sims</h5>
                                                                                            <p>Purus feugiat finibus</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="au-message__item-time">
                                                                                        <span>Sunday</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="au-message__item js-load-item">
                                                                                <div class="au-message__item-inner">
                                                                                    <div class="au-message__item-text">
                                                                                        <div class="avatar-wrap online">
                                                                                            <div class="avatar">
                                                                                                <img src="images/icon/avatar-04.jpg" alt="Michelle Sims">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text">
                                                                                            <h5 class="name">Michelle Sims</h5>
                                                                                            <p>Lorem ipsum dolor sit amet</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="au-message__item-time">
                                                                                        <span>Yesterday</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="au-message__item js-load-item">
                                                                                <div class="au-message__item-inner">
                                                                                    <div class="au-message__item-text">
                                                                                        <div class="avatar-wrap">
                                                                                            <div class="avatar">
                                                                                                <img src="images/icon/avatar-05.jpg" alt="Michelle Sims">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text">
                                                                                            <h5 class="name">Michelle Sims</h5>
                                                                                            <p>Purus feugiat finibus</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="au-message__item-time">
                                                                                        <span>Sunday</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="au-message__footer">
                                                                            <button class="au-btn au-btn-load js-load-btn">load more</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="au-chat">
                                                                        <div class="au-chat__title">
                                                                            <div class="au-chat-info">
                                                                                <div class="avatar-wrap online">
                                                                                    <div class="avatar avatar--small">
                                                                                        <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                                                    </div>
                                                                                </div>
                                                                                <span class="nick">
                                                                                    <a href="#">John Smith</a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="au-chat__content">
                                                                            <div class="recei-mess-wrap">
                                                                                <span class="mess-time">12 Min ago</span>
                                                                                <div class="recei-mess__inner">
                                                                                    <div class="avatar avatar--tiny">
                                                                                        <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                                                    </div>
                                                                                    <div class="recei-mess-list">
                                                                                        <div class="recei-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                                                                        <div class="recei-mess">Donec tempor, sapien ac viverra</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="send-mess-wrap">
                                                                                <span class="mess-time">30 Sec ago</span>
                                                                                <div class="send-mess__inner">
                                                                                    <div class="send-mess-list">
                                                                                        <div class="send-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="au-chat-textfield">
                                                                            <form class="au-form-icon">
                                                                                <input class="au-input au-input--full au-input--h65" type="text" placeholder="Type a message">
                                                                                <button class="au-input-icon">
                                                                                    <i class="zmdi zmdi-camera"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->


            @endsection
