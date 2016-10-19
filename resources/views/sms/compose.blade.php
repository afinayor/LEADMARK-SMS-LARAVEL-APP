{{--extending the main template--}}
@extends('template')

@section('head')

    {{--<link rel="stylesheet" type="text/css" href="/accordion/css/default.css" />--}}
    <link rel="stylesheet" type="text/css" href="{{asset('accordion/css/component.css')}}" />
    <script src="{{asset('accordion/js/modernizr.custom.js')}}"></script>
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
@endsection

@section('content')


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder">
                    <div class="title-text">

                        <h2>Compose Sms</h2>

                        <ol class="breadcrumb">
                            <li><a href="">Home</a></li>
                            <li class="active">Compose Sms</li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Normal contents--}}
    <section>
        <div class="container">


            <div class="row general">
                <div class="col-md-9 col-sm-8 col-md-push-3"> <!--=======  col-md-8 START =========-->

                    <h2 class="shortcodes-title">Compose Sms</h2>
                    <form id="composeform" action="{{route('sendSMS')}}" method="post" role="form">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 ">

@include('partials.flashAlert')
                            	<div id="form-subject-error" class="form-group {{ $errors->has('subject') ? ' error has-error ' : '' }} ">
                            		<label for="">Subject Or Sender Id</label>
                            		<input type="text" placeholder="Subject Of SMS Message" class="form-control" value="{{isset($message->subject) ? $message->subject: Request::old('subject')}}" name="subject" id="">
                                    <span id="subject-error" class="help-block"></span>
                                    @if($errors->has('subject'))
                                        <span class="help-block">
                                                        {{$errors->first('subject')}}
                                                    </span>
                                    @endif
                                </div>
                                <div id="form-recipients-error" class="form-group {{ $errors->has('recipients') ? ' error has-error ' : '' }} ">
                                    <label for="">Recipients</label>
                                    <textarea class="form-control" placeholder="Seperate Multiple Phone Numbers By Comma(,) E.g 08022222222,08033333333,07022222222" name="recipients">{{isset($message->recipients) ? $message->recipients: Request::old('recipients')}}</textarea>
                                    <span id="recipients-error" class="help-block"></span>
                                    @if($errors->has('recipients'))
                                        <span class="help-block">
                                                        {{$errors->first('recipients')}}
                                                    </span>
                                    @endif
                                </div>
                                <div id="form-body-error" class="form-group {{ $errors->has('body') ? ' error has-error ' : '' }} ">
                                    <label for="">Message Body</label>
                                    <textarea id="content" class="form-control" placeholder="Content Of Your SMS Message" name="body">{{isset($message->content) ? $message->content : Request::old('body')}}</textarea>
                                    <p id="data"></p>
                                    <span id="body-error" class="help-block"></span>
                                    @if($errors->has('body'))
                                        <span class="help-block">
                                                        {{$errors->first('body')}}
                                                    </span>
                                    @endif
                                </div>
                            <input name="_token" value="{{Session::token()}}" type="hidden"/>



                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="widget">

                                <h3 class="widget-title">
                                    <span class="widget-title-line"></span>
                                    <span class="widget-title-text" data-toggle="tooltip" data-placement="top" title="Add Contact Group Contacts To List Of Recipients">Contact Groups</span>
                                </h3>

                                <div class="widget-content">
                                    <ul class="blog_archieve">
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach($groups as $group)
                                            <li <?php echo ($no >3)? "class='showNON' style='display: none;'":""?> ><input type="checkbox" data-toggle="tooltip" data-placement="top" title="Click To Add {{$group->contacts->count()}} Contacts From The {{$group->name}} Contact Group" name="group[]" number="{{$group->contacts->count()}}" class="option-input checkbox" id="group-{{$group->id}}" value="{{$group->id}}"> {{$group->name}} ({{$group->contacts->count()}})</li>
                                        <?php $no++;?>
                                            @endforeach

                                    </ul>
                                    @if(count($groups) >3)
                                    <div id="showLI" style="text-align: center;margin-top:5px;cursor: pointer;"><a>Click To List All Groups</a></div>
                                    @endif
                                </div>

                            </div>
                            <div class="widget">

                                <h3 class="widget-title">
                                    <span class="widget-title-line"></span>
                                    <span class="widget-title-text" data-toggle="tooltip" data-placement="top" title="Insert Links Of Pages, Social Media Pages, Landing Pages Into Message Body">Automatic Inserts</span>
                                </h3>
                                <div class="widget-content">
                                    <ul id="cbp-ntaccordion" class="cbp-ntaccordion">
                                        <li>
                                            <h3 class="cbp-nttrigger">Landing Pages</h3>
                                            <div class="cbp-ntcontent">
                                                <p>first</p>

                                            </div>
                                        </li>
                                        <li>
                                            <h3 class="cbp-nttrigger">Forms</h3>
                                            <div class="cbp-ntcontent">
                                                <p>first</p>

                                            </div>
                                        </li>
                                        <li>
                                            <h3 class="cbp-nttrigger">Pages</h3>
                                            <div class="cbp-ntcontent">
                                                <p>Profile Page</p>
                                                <p>Facebook Page</p>
                                                <p>Twitter Page</p>
                                                <p>Instagram Page</p>

                                            </div>
                                        </li>
                                    </ul>

                                </div>



                            </div>
                        </div>
                    </div>
                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Send Message" class="btn btn-primary">SEND NOW</button>
                        <button type="button" id="schedule" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Schedule Messages">SEND LATER</button>
                        <button type="button" id="save" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Save Message To Draft Messages">SAVE AS DRAFT</button>
                        <button type="button" id="recipientSave" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Save Phone Numbers In Recipients Field To Phonebook Group">SAVE NUMBERS TO GROUP</button>
                        <button type="button" id="autoschedule" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Send Autogenerated SMS to Your Contacts">Auto Schedule</button>
                    </form>
                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    @include('partials.sidebar')

                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



@stop
@section('scripts')

    <script src="{{asset('accordion/js/jquery.cbpNTAccordion.min.js')}}"></script>
    <script>
        /*
         *
         * Accordion Plugin
         *
         * */
        $( function() {
            /*
             - how to call the plugin:
             $( selector ).cbpNTAccordion( [options] );
             - destroy:
             $( selector ).cbpNTAccordion( 'destroy' );
             */

            $( '#cbp-ntaccordion' ).cbpNTAccordion();

        } );
    </script>
    <script>
        /*
         *
         * Saving to draft
         *
         * */
        $("#save").click(function (event) {
            event.preventDefault();
            $('.loading').show();
            var form = $('#composeform');
            var formData = form.serializeArray();
//            var formData = new FormData($(this)[0]);
            var url = '<?php echo route('savedraft')?>';
            console.log(formData);
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function (data) {
                    console.log(data);
//                    alert(data.fail);
                    $('.loading').hide();
                    if (data.fail) {
                        sweetAlert(
                                'Oops...',
                                'Some Fields Are Empty',
                                'warning'
                        )
                        $('#composeform input, #composeform textarea').each(function () {
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
                    } else {
                        swal(
                                'Good job!',
                                'SMS Message Saved To Drafts',
                                'success'
                        )
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });

            return false;
        });
       $("#content").keyup(function (){

            var content = $("#content").val();

            var no = content.length;
            //var pageno = 0;
            var rem = no%160;
           var div = no/160;

           var pageno;

           if(no == 0){
               pageno = 0;
//               console.log('middle');
           }else if(no <= 160 && no != 0){
               pageno = 1;
//               console.log('top');
           } else if(rem == 0){
                pageno = Math.floor(div);
//                console.log('bottom ' + div + ' ' + no);
            }else{
               pageno = Math.floor(div)+1;
//               console.log('last ' + div + ' ' + no);
           }
            var data = "<p>Characters Left: "+(160-rem)+" Pages: "+pageno+" Characters Typed: "+no+"</p>";
            $('#data').html(data);

        });



    </script>

    <script>
        $('#showLI').click(function(){
           $('.showNON').fadeIn();
        });


        /*
         *
         * Saving to Recipients to the database
         *
         * */

        $('#recipientSave').click(function(){
            swal({
                title: 'Select Group To Add To',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save To Group',
                cancelButtonText: 'Create New Group',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-primary',
                buttonsStyling: false,
                input: 'select',
                inputOptions: {
                    @foreach($groups as $group)
                        '{{$group->id}}' : '{{$group->name}}',
                    @endforeach
                },
                inputPlaceholder: 'Select Group',
                showCancelButton: true,
                inputValidator: function(value) {
                    return new Promise(function(resolve, reject) {
                        if (value) {
                            var valueData = value;
                            resolve(valueData);
                        } else {
                            reject('You need to select a group or click New Group');
                        }
                    });
                }
            }).then(function(valueData) {
                /*saving the contacts from recipients to group selected*/
                var form = $('#composeform');
                var formData = form.serializeArray();
                var url = '<?php echo route('saverecipients')?>';
                formData.push({'name':'group','value':valueData});
//                formData = formData + '&group='+valueData;
                console.log(formData);
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    success: function (data) {
                        console.log(data);
//                    alert(data.fail);
                        $('.loading').hide();
                        if (data.fail) {
                            sweetAlert(
                                    'Oops...',
                                    'Recipients Field Is Empty',
                                    'warning'
                            )
                            $('#composeform input, #composeform textarea').each(function () {
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
                        } else {
                            swal(
                                    'Success',
                                    'Contacts Saved To Group',
                                    'success'
                            );
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });


            }, function(dismiss) {
                // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Input Name OF New Group',
                        input: 'text',
                        showCancelButton: true,
                        inputValidator: function(value) {
                            return new Promise(function(resolve, reject) {
                                if (value) {
                                    resolve();
                                } else {
                                    reject('You need to write a name!');
                                }
                            });
                        }
                    }).then(function(result) {
                        var form = $('#composeform');
                        var formData = form.serializeArray();
                        var url = '<?php echo route('saverecipients')?>';
                        formData.push({'name':'group','value':result});
                        formData.push({'name':'new','value':'true'});
//                        formData = formData + '&group='+result+'&new=true';
                        console.log(formData);
                        $.ajaxSetup({
                            headers:{
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: formData,

                            success: function (data) {
                                console.log(data);
//                    alert(data.fail);
                                $('.loading').hide();
                                if (data.fail) {
                                    sweetAlert(
                                            'Oops...',
                                            'Recipients Field Is Empty',
                                            'warning'
                                    )
                                    $('#composeform input, #composeform textarea').each(function () {
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
                                } else {
                                    swal({
                                        type: 'success',
                                        html: 'Phone Contacts Saved To New Group ' + result
                                    });
                                }
                            },
                            error: function (xhr, textStatus, errorThrown) {
                                alert(errorThrown);
                            }
                        });


                    })
                }
            })


        });


        /*
        *
        * Saving to schedule.
        *
        * */

        $('#schedule').click(function (event) {
            event.preventDefault();
            $('.loading').show();
            var form = $('#composeform');
            var formData = form.serializeArray();

            var url = '<?php echo route('scheduleSMS')?>';

            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: formData,

                success: function (data) {
                    console.log(data);
//                    alert(data.fail);
                    $('.loading').hide();
                    if (data.fail) {
                        sweetAlert(
                                'Oops...',
                                'Some Fields Are Empty',
                                'warning'
                        );
                        $('#composeform input, #composeform textarea').each(function () {
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
                    } else {

//                        swal(
//                                '',
//                                'SMS Message Saved',
//                                'success'
//                        )
                        window.location.assign(data.url);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
            return false;
        });


        $('#autoschedule').click(function (event) {
            event.preventDefault();
            $('.loading').show();
            var form = $('#composeform');
            var formData = form.serializeArray();
            var url = '<?php echo route('autoscheduler')?>';

            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: formData,

                success: function (data) {
                    console.log(data);
//                    alert(data.fail);
                    $('.loading').hide();
                    if (data.fail) {
                        sweetAlert(
                                'Oops...',
                                'Some Fields Are Empty',
                                'warning'
                        );
                        $('#composeform input, #composeform textarea').each(function () {
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
                    } else {

//                        swal(
//                                '',
//                                'SMS Message Saved',
//                                'success'
//                        )
                        window.location.assign(data.url);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
            return false;
        });

    </script>




@endsection