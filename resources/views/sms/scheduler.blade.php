{{--extending the main template--}}
@extends('template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{asset('JQtimepicker/jquery.datetimepicker.min.css')}}">
    <meta name="_token" content="{{csrf_token()}}"/>

@endsection

@section('content')


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder">
                    <div class="title-text">

                        <h2>Schedule SMS</h2>

                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('compose')}}">Compose SMS</a></li>
                            <li class="active">Schedule SMS</li>
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

                    <h2 class="shortcodes-title">Schedule SMS</h2>
                    @include('partials.flashAlert')

                    <div class="general">
                    <h4>Shedule SMS For Message : <b>{{$msgs->subject}}</b></h4>
                    <form id="form" action="{{route('postSchedule')}}" method="post" role="form">


                    	<div id="form-schedule-1-error" class="form-group">
                    		<label for="">Select Date And Time To Schedule</label>
                            <input name="schedule-1" class="form-control calendar" placeholder="Click To Show Calender And Set Time" >
                            <span id="schedule-1-error" class="help-block"></span>
                        </div>
                        <div id="contain"></div>
                        <input name="msg_id" value="{{$msgs->id}}" type="hidden"/>
                        <input name="cam_id" value="{{$msgs->campaign_id}}" type="hidden"/>

                    	<button type="submit" class="btn btn-primary">Schedule</button>
                        <button id="add" type="button" class="btn btn-info">Add Another Date/Time</button>
                    </form>
                    </div>




                    <blockquote style="margin-top: 50px;">
                        <p>Scheduling helps you to save messages that will be sent to a later date and time.
                        You can select as many dates and times in the future to send to. Note that whenever
                        your message is ready to be sent, if your SMS Balance isn't enough, your message would
                        not be sent.</p>
                    </blockquote>


                {{--{{print_r($msgs)}}--}}
                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    @include('partials.sidebar')

                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



@stop

@section('scripts')

    <script src="{{asset('JQtimepicker/jquery.datetimepicker.full.min.js')}}"></script>
    <script>

        $('#form').on('click','input',function(){
//            console.log(this.id);
            $(this).datetimepicker({minDate:0});

        });



    </script>

    <script>
        var no = 2;
        $('#add').click(function(){
            var input = "<div id='form-schedule-"+ no +"-error' class='form-group'>" +
                    "<label>Select Another Date And Time To Schedule</label>"+
                    "<input id='test' name='schedule-"+no+"' class='form-control calendar' placeholder='Click To Show Calender And Set Time' >" +
                    "<span id='schedule-"+ no +"-error' class='help-block'></span>"+
                    "</div>";
            $('#contain').append(input);
            no++;
        });
    </script>
    <script>

        $("#form").submit(function (event) {
            event.preventDefault();
            $('.loading').show();
            var form = $(this);
            var data = $(this).serialize();
            var No = $('.calendar').length;
            data = data+"&No="+No;
            console.log(data);
            console.log(No);
            var url = form.attr("action");
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: url,
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
//                    alert(data.fail);
                    $('.loading').hide();
                    if (data.fail) {
                        $('#form input, #form textarea').each(function () {
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
//                        swal('Success',
//                        data.msg,
//                        'success');
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
    </script>
@endsection