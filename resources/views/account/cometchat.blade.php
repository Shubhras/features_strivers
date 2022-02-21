{{--
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
--}}
@extends('layouts.master')



@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
<div class="main-container">
    <div class="container">
        <div class="row">

            @if (session()->has('flash_notification'))
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        @include('flash::message')
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-3 page-sidebar">
                @includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
            </div>
            <!--/.page-sidebar-->

            <div class="col-md-9 page-content">

                <div class="inner-box default-inner-box">



                    <div class="header-data text-center-xs">
                        {{-- Threads Stats --}}
                        <div class="hdata">
                            <div class="mcol-left">
                                <i class="fas fa-phone-alt ln-shadow"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of messages --}}
                                <p>
                                    <a href="{{ url('account/messages') }}">
                                        {{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
                                        <!-- <em>{{ trans_choice('global.count_mails', getPlural($countThreads), [], config('app.locale')) }}</em> -->
                                        <em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>
                                    </a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        {{-- Traffic Stats --}}
                        <div class="hdata">
                            <div class="mcol-left">
                                <i class="fas fa-comments ln-shadow"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of visitors --}}
                                <p>
                                    <a href="{{ url('account/chat') }}">
                                        <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                        {{ \App\Helpers\Number::short($totalPostsVisits) }}
                                        <!-- <em>{{ trans_choice('global.count_visits', getPlural($totalPostsVisits), [], config('app.locale')) }}</em> -->
                                        <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
                                    </a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>



                        {{-- Favorites Stats --}}
                        <div class="hdata">
                            <div class="mcol-left">
                                <i class="fas fa-bell ln-shadow"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of favorites --}}
                                <p>
                                    <a href="{{ url('account/favourite') }}">
                                        {{ \App\Helpers\Number::short($countFavoritePosts) }}
                                        <em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
                                    </a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                   
                </div>

                <div class="inner-box default-inner-box">

                    <div id="cometchat"></div>
                    <script>
                        valueArray = <?php echo json_encode($auth_user_name->username); ?>;
                        
                        window.addEventListener('DOMContentLoaded', (event) => {
                            CometChatWidget.init({
                                "appID": "201196c7af88afe8",
                                "appRegion": "us",
                                "authKey": "d7ed27f7c12eafedb544130c6681425f0ae2fdf2"
                            }).then(response => {
                                console.log("Initialization completed successfully");
                                //You can now call login function.
                                CometChatWidget.login({
                                    "uid": valueArray
                                }).then(response => {
                                    CometChatWidget.launch({
                                        "widgetID": "45bab00b-f5d7-44c7-a970-94115a5db2b7",
                                        "target": "#cometchat",
                                        "roundedCorners": "true",
                                        "height": "600px",
                                        "width": "800px",
                                        "defaultID": valueArray, //default UID (user) or GUID (group) to show,
                                        "defaultType": 'user' //user or group
                                    });
                                }, error => {
                                    console.log("User login failed with error:", error);
                                    //Check the reason for error and take appropriate action.
                                });
                            }, error => {
                                console.log("Initialization failed with error:", error);
                                //Check the reason for error and take appropriate action.
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('after_styles')
<style>
    .action-td p {
        margin-bottom: 5px;
    }
</style>
@endsection

@section('after_scripts')
<script defer src="https://widget-js.cometchat.io/v3/cometchatwidget.js"></script>

<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#addManageTable').footable().bind('footable_filtering', function(e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });

        $('.clear-filter').click(function(e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.demo').trigger('footable_clear_filter');
        });

        $('.from-check-all').click(function() {
            checkAll(this);
        });

        $('a.delete-action, button.delete-action, a.confirm-action').click(function(e) {
            e.preventDefault(); /* prevents the submit or reload */
            var confirmation = confirm("{{ t('confirm_this_action') }}");

            if (confirmation) {
                if ($(this).is('a')) {
                    var url = $(this).attr('href');
                    if (url !== 'undefined') {
                        redirect(url);
                    }
                } else {
                    $('form[name=listForm]').submit();
                }
            }

            return false;
        });
    });
</script>
{{-- include custom script for ads table [select all checkbox]  --}}
<script>
    function checkAll(bx) {
        if (bx.type !== 'checkbox') {
            bx = document.getElementById('checkAll');
            bx.checked = !bx.checked;
        }

        var chkinput = document.getElementsByTagName('input');
        for (var i = 0; i < chkinput.length; i++) {
            if (chkinput[i].type == 'checkbox') {
                chkinput[i].checked = bx.checked;
            }
        }
    }
</script>
@endsection