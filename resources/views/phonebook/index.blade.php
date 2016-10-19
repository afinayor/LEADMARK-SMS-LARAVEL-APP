{{--extending the main template--}}
@extends('template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{asset('tabs/css/tabs.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('tabs/css/tabstyles.css')}}" />
    <script src="{{asset('tabs/js/modernizr.custom.js')}}"></script>
    <meta name="_token" content="{{csrf_token()}}"/>
    <style>
        .loading {
            background: lightgoldenrodyellow url('{{asset('images/processing.gif')}}') no-repeat center 65%;
            height: 80px;
            width: 100px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }
    </style>


@stop


@section('content')


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder">
                    <div class="title-text">

                        <h2>Phone Book</h2>

                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="blog.html">Phone Book</a></li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Normal contents--}}
    <section>
        <div class="container">


            <div class="row">
                <div class="col-md-9 col-sm-8 col-md-push-3"> <!--=======  col-md-8 START =========-->

                    <h2 id="dd" class="shortcodes-title">Phone Book</h2>

                    <section style="padding-top: 0px;padding-bottom: 10px;">

                            <div id="tabstylez" class="tabs tabs-style-linebox">
                                <nav>
                                    <ul>
                                        <li><a href="#section-linebox-1"><span>Phone Book</span></a></li>
                                        <li><a href="#section-linebox-2"><span>Upload Contacts</span></a></li>
                                        <li><a href="#section-linebox-3"><span>Manage Group</span></a></li>
                                        <li><a href="#section-linebox-4"><span>Add Multiple</span></a></li>

                                    </ul>
                                </nav>
                                <div class="content-wrap">
                                    <section id="section-linebox-1">
                                        <div id="content"></div>

                                    </section>
                                    <section id="section-linebox-2">
                                        @include('phonebook.upload')
                                    </section>
                                    <section id="section-linebox-3">
                                        @include('phonebook.groups')
                                    </section>
                                    <section id="section-linebox-4">
                                        @include('phonebook.multiple')
                                    </section>

                                </div><!-- /content -->
                            </div><!-- /tabs -->
                        <div class="loading"></div>
                    </section>



                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    @include('partials.sidebar')

                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



@stop

@section('scripts')
    <script src="{{asset('tabs/js/cbpFWTabs.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script>
    $(document).ready(function(){
        $('#fullform').on('focus','.datepicker',function(){


            if($(this).length != 0){
                $(this).datepicker({
                    format:"yyyy/mm/dd",
                    weekStart:1
                });
            }
        });

    });

//        if($('.datepicker').length != 0){
//            $('#fullform .datepicker').datepicker({
//                weekStart:1
//            });
//        }
    </script>
    <script>


        (function() {

            [].slice.call( document.querySelectorAll( '#tabstylez' ) ).forEach( function( el ) {
                new CBPFWTabs( el );
            });

        })();
    </script>
    <script>
        function ajaxLoad(filename, content) {
            content = typeof content !== 'undefined' ? content : 'content';
            $('.loading').show();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: filename,
                contentType: false,
                success: function (data) {
                    $('.loading').hide();
                    $("#" + content).html(data);


                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }

            });

        }
        $(document).ready(function () {
            ajaxLoad('phonebook/list');
        });
    </script>
    <script>
        function loadform(filename){
            $('.loading').show();
            var non = $('.p_id_unique').length;
            var full_filename = filename + '&last=' + non;
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: full_filename,
                contentType: false,
                success: function (data) {
                    $("#formcontent").append(data);
                    $('.loading').hide();

                },
                error: function (xhr, status, error) {
                    sweetAlert(xhr.responseText);
                }
            });

        }
        $(document).ready(function(){

            $("#tabstylez nav ul li:nth-child(<?php echo Session::get('phonebook.default') ?>)").click();
//            $().addClass('btn');
        });
    </script>
    <script>
        $("#fullform").submit(function (event) {

            var non = $('.p_id_unique').length;
            $("#no_of_contacts").val(non);
            event.preventDefault();
            $('.loading').show();
            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
//                    alert(data.fail);
                    $('.loading').hide();
                    if (data.fail) {
                        $('#fullform input, #fullform textarea').each(function () {
                            index = $(this).attr('name');
                            if (index in data.errors) {
                                $("#form-" + index + "-error").addClass("has-error");
                                $("#" + index + "-error").html(data.errors[index]);

                            }
                            else {
                                $("#form-" + index + "-error").removeClass("has-error");
                                $("#" + index + "-error").empty();
                            }
                        });
                        $('#focus').focus().select();
                    } else {
                        $(".has-error").removeClass("has-error");
                        $(".help-block").empty();
                        $('.loading').hide();
                        location.reload();
//                        ajaxLoad(data.url, data.content);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
            return false;
        });
        $("#updategroup").submit(function (event) {
            alert('update');
            event.preventDefault();
            $('.loading').show();
            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
//                    alert(data.fail);
                    $('.loading').hide();
                    if (data.fail) {
                        $('#updategroup input, #fullform textarea').each(function () {
                            index = $(this).attr('name');
                            if (index in data.errors) {
                                $("#form-" + index + "-error").addClass("has-error");
                                $("#" + index + "-error").html(data.errors[index]);

                            }
                            else {
                                $("#form-" + index + "-error").removeClass("has-error");
                                $("#" + index + "-error").empty();
                            }
                        });
                        $('#focus').focus().select();
                    } else {
                        $(".has-error").removeClass("has-error");
                        $(".help-block").empty();
                        $('.loading').hide();
//                        location.reload();
//                        ajaxLoad(data.url, data.content);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
            return false;
        });
    </script>
    <script>
        $("#group-btn input").each(function(){
            $(this).click(function(){
                var value = $(this).val();
                $("#group-field").val(value);
            })
        })
        $(function(){
            $('[data-toggle = "tooltip"]').tooltip();
        });
    function confirmdelete(filename,warning){
        swal({
            title: 'Are you sure?',
            text: warning,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: filename,
                contentType: false,
                success: function (data) {
                    if(data){
//                        alert(data);
//                        swal(
//                                'Deleted!',
//                                'Your data has been deleted.',
//                                'success'
//                        );
                        location.reload();
                    }
//                    $('.loading').hide();

                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        })
    }

    </script>
@stop