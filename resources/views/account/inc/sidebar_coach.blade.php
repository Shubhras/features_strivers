<aside>

    <nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 dform" style="padding: 15px;">
        <a class="d-xl-none d-lg-none d-md-none text-inherit  font-weight-bold" href="#">Menu</a>
        <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" style="padding-right: 15px;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse TABM" id="navbarNavDropdown">
            <div class="navbar-nav flex-column w-100  ">
                <div class="border-bottom py-4 p-md-4 d-flex justify-content-between text-reset">
                    <div class="d-flex align-items-center">
                        <img src="../assets/images/avatar-1.png" alt="" class="rounded-circle avatar-lg">
                        <div class="ms-3 lh-1 ">
                            <h5 class="mb-1 newl">Coach Dashboard</h5>
                            <!-- <small>Free Member</small> -->
                        </div>
                    </div>
                </div>
                <div class="py-4 p-md-4 ">
                    <!-- <span class="heading ">Account</span> -->
                    <ul class="list-unstyled mb-4 mt-2">
                        <li class="nav-item ">
                            <a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/dashboard') }}">
                                <h5 class="collapse-title no-border">
                                    <i class="fas fa-th-list"></i> {{ t('dashboard') }}&nbsp;

                                </h5>

                            </a>
                        </li>
                        <li class="nav-item ">
                            <a {!! ($pagePath=='' ) ? 'class="active" ' : '' !!} href="{{ url('account') }}">
                                <h5 class="collapse-title no-border">
                                    <i class="fas fa-user-edit"></i>
                                    {{ t('Edit_Profile') }}&nbsp;

                                </h5>
                            </a>
                        </li>
                        <?php
                        $index_and_footer_logo = DB::table('logo_header_and_footer_and_images_change')->select('logo_header_and_footer_and_images_change.*')->first();

                        ?>
                        <li class="nav-item  ">
                            <a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/my_striver') }}">
                                <h5 class="collapse-title no-border">
                                    <i class="fas fa-users"></i>
                                    My {{$index_and_footer_logo->change_strivre_name}}&nbsp;

                                </h5>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a {!! ($pagePath=='' ) ? 'class="active "' : '' !!} href="{{ url('account/my_courses') }}">
                                <h5 class="collapse-title no-border">
                                    <!-- <i class="fas fa-user-edit"></i> -->
                                    <i class="fas fa-book-open"></i>
                                    Consultation &nbsp;

                                </h5>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a {!! ($pagePath=='' ) ? 'class="active "' : '' !!} href="{{ url('account/my_payments') }}">
                                <h5 class="collapse-title no-border">
                                    <!-- <i class="fas fa-user-edit"></i> -->
                                    <i class="fas fa-credit-card"></i>
                                    {{ ('My payment') }} &nbsp;

                                </h5>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a {!! ($pagePath=='article' ) ? 'class="active "' : '' !!} href="{{ url('account/article') }}">
                                <h5 class="collapse-title no-border">
                                    <!-- <i class="fas fa-user-edit"></i> -->
                                    <i class="fas fa-pencil"></i>
                                    {{ ('My Articles') }} &nbsp;

                                </h5>
                            </a>

                        </li>

                        <?php
                        $user = auth()->user()->id;
                        $message =  DB::table('threads_participants')->select('threads_participants.*')->where('threads_participants.user_id', $user)->where('threads_participants.last_read', null)->get();

                        $total_unread_message =  count($message);
                        //  print($total_unread_message);die;
                        ?>
                        <!-- <li class="nav-item active ">
                            <a {!! ($pagePath=='messenger' ) ? 'class="active" ' : '' !!}href="{{ url('account/messages') }}">
                                <h5 class="collapse-title no-border">
                                    <i class="fas fa-envelope"></i> {{ t('messenger') }}&nbsp;
                                    <span class="badge badge-pill count-threads-with-new-messages hide" style="color:black; font-size: 12px;">{{$total_unread_message}}</span>
                                </h5>
                            </a>
                        </li> -->

                        <li class="nav-item active ">
                            <a {!! ($pagePath=='video_recorded_list' ) ? 'class="active" ' : '' !!}href="{{ url('account/video_recorded_list') }}">
                                <h5 class="collapse-title no-border">
                                    <i class="fas fa-video"></i> Video Recorded List&nbsp;
                                    
                                </h5>
                            </a>
                            <!-- <video id="V1">
                        <source src="filename.mp4" type="video/mp4" />
                      
                        <a href="filename.mp4" download>Download video</a> .
                    </video> -->
                        </li>

                       

                    </ul>
                    <!-- <span class="heading border-top pt-4 d-block">Billing</span>

                                    <ul class="list-unstyled mb-0">
                                        <li class="nav-item ">
                                            <a class="nav-link" href="dashboard-payment-plan.html">Plan &amp;
                                                Payment</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="dashboard-payment-history.html">Payment
                                                History</a>
                                        </li>
                                    </ul> -->
                </div>
            </div>
        </div>
    </nav>
</aside>