<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<!-- <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script> -->


@extends('layouts.master_new')

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">
</section>

@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])

<br>
<br>
<div class="">
    <div class="container">
        <div class="row">

            <h2 class="sec-title" style="font-weight: 700;">
                All Article

            </h2>

            <?php
            foreach ($article_list as  $article_list_data) {
            ?>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-course-item-4">
                        <div class="fcf-thumb">
                            <img src="{{ url('storage/'.$article_list_data->picture) }}" alt="" style="height: 244px;">
                            <a class="enroll" href="{{url('/letest_news/'.$article_list_data->slug)}}" onclick="customSession()">View Article</a>
                        </div>
                        <div class="fci-details">

                            <?php

                           
                                $name = json_decode($article_list_data->name);
                                $ss = array();
                                foreach ($name as $key => $sub) {
                                    $ss[$key] = $sub;
                                }

                            ?>
                      

                                <a href="{{url('/letest_news/'.$article_list_data->slug) }}" target="_blank" class="c-cate sort_name"><i class="fas fa-tags"></i>{{$ss['en']}}</a>

                            

                            <?php

                            if (!empty($article_list_data->title)) {


                                $name = json_decode($article_list_data->title);
                                $title = array();
                                foreach ($name as $key => $sub) {
                                    $title[$key] = $sub;
                                }

                            ?>

                                <h4><a href="{{url('/letest_news/'.$article_list_data->slug)}}">{{$title['en']}}</a></h4>

                            <?php  }
                            ?>
                            <div class="author">
                                <img src="{{ url('storage/'.$article_list_data->photo) }}" alt="">
                                <a href="{{url('/letest_news/'.$article_list_data->slug)}}">{{$article_list_data->user_name}}</a>
                            </div>


                            <div class="price-rate">
                                <div class="course-price">

                                    @if($article_list_data->price != null)

                                    <a>


                                        {{$article_list_data->price}}$ Credits
                                    </a>
                                    @else
                                    0 $ Credits
                                    @endif
                                </div>

                            </div>



                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
        <br>

    </div>
</div>

</div>


@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
<!-- /.main-container -->

<a href="#" id="back-to-top">
    <i class="fal fa-angle-double-up"></i>
</a>
<!-- Back To Top -->

<!-- Start Include All JS -->
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.appear.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/slick.js"></script>
<script src="../assets/js/jquery.nice-select.min.js"></script>
<script src="../assets/js/swiper-bundle.min.js"></script>
<script src="../assets/js/TweenMax.min.js"></script>
<script src="../assets/js/lightcase.js"></script>
<script src="../assets/js/jquery.plugin.min.js"></script>
<script src="../assets/js/jquery.countdown.min.js"></script>
<script src="../assets/js/jquery.easing.1.3.js"></script>
<script src="../assets/js/jquery.shuffle.min.js"></script>

<script src="../assets/js/theme.js"></script>

@endsection

@section('after_styles')
<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
@if (config('lang.direction') == 'rtl')
<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
@endif
<style>
    .krajee-default.file-preview-frame:hover:not(.file-preview-error) {
        box-shadow: 0 0 5px 0 #666666;
    }

    .file-loading:before {
        content: " {{ t('Loading') }}...";
    }
</style>
<style>
    /* Avatar Upload */
    .photo-field {
        display: inline-block;
        vertical-align: middle;
    }

    .photo-field .krajee-default.file-preview-frame,
    .photo-field .krajee-default.file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }

    .photo-field .file-input {
        display: table-cell;
        width: 150px;
    }

    .photo-field .krajee-default.file-preview-frame .kv-file-content {
        width: 150px;
        height: 160px;
    }

    .kv-reqd {
        color: red;
        font-family: monospace;
        font-weight: normal;
    }

    .file-preview {
        padding: 2px;
    }

    .file-drop-zone {
        margin: 2px;
        min-height: 100px;
    }

    .file-drop-zone .file-preview-thumbnails {
        cursor: pointer;
    }

    .krajee-default.file-preview-frame .file-thumbnail-footer {
        height: 30px;
    }

    /* Allow clickable uploaded photos (Not possible) */
    .file-drop-zone {
        padding: 20px;
    }

    .file-drop-zone .kv-file-content {
        padding: 0
    }
</style>


@endsection

@section('after_scripts')
<script src="{{ url('../assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{ url('../assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ url('../assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ url('js/fileinput/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>




<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>



<script>
    $('#course_hourse').keyup(function() {
        var consultation_fee_per_hour;
        var course_hourse;
        consultation_fee_per_hour = parseFloat($('#consultation_fee_per_hour').val());
        course_hourse = parseFloat($('#course_hourse').val());
        var total_consultation_fee = consultation_fee_per_hour * course_hourse;
        var creadit_required = total_consultation_fee / 5;
        $('#total_consultation_fee').val(total_consultation_fee.toFixed(0));
        $('#creadit_required').val(creadit_required.toFixed());
    });
</script>

<script>
    $('#consultation_fee_per_hour').keyup(function() {
        var consultation_fee_per_hour;
        var course_hourse;
        consultation_fee_per_hour = parseFloat($('#consultation_fee_per_hour').val());
        course_hourse = parseFloat($('#course_hourse').val());
        var total_consultation_fee = consultation_fee_per_hour * course_hourse;
        var creadit_required = total_consultation_fee / 5;
        $('#total_consultation_fee').val(total_consultation_fee.toFixed(0));
        $('#creadit_required').val(creadit_required.toFixed(0));
    });
</script>



<script>
    // when category dropdown changes





    $(document).ready(function() {

        $("form").submit(function(event) {
            var formData = {
                course_name: $("#course_name").val(),
                consultation_fee_per_hour: $("#consultation_fee_per_hour").val(),
                course_hourse: $("#course_hourse").val(),
                total_consultation_fee: $("#total_consultation_fee").val(),
                creadit_required: $("#creadit_required").val(),
                image: $("#image").val(),
                description: $("#description").val(),
                starting_time: $("#starting_time").val(),
                dated: $("#dated").val(),
            };

            $.ajax({
                type: "POST",
                url: "{{ url('account/create_course') }}",
                data: formData,
                dataType: "json",
                encode: true,
            }).success(function(data) {
                document.getElementsByClassName("close")[0].click = true;
                document.getElementById("myModal").style.display = "none";
                location.reload(); // console.log("hello welcome to digiprima technology");
            });

            event.preventDefault();
        });
    });
</script>

<style>
    .teacher-meta {
        position: relative;
        padding: 25px 15px 0;
    }


    .teacher-meta h5 {
        font-size: 16px;
        line-height: 24px;
        color: #2c234d;
        margin: 0 0 7px;
        font-weight: 700 !important;

    }
</style>


<style>
    /* .sort_name {
        display: inline-block;
        width: 120px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
        font-weight: 500;
    } */


    /* @media only screen and (max-width: 1440px) {
        .sort_name {
            display: inline-block;
            width: 237px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    }

	@media only screen and (min-width: 1441px) and (max-width: 2560px) {
        .sort_name {
            display: inline-block;
            width: 400px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    } */





    /* 
    @media only screen and (max-width: 1024px) {
        .sort_name {
            display: inline-block;
            width: 191px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    } */
</style>






@endsection