{{--extending the main template--}}
@extends('template')

@section('head')
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

                        <h2>Auto Schedule SMS</h2>

                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('compose')}}">Compose SMS</a></li>
                            <li class="active">Auto Schedule SMS</li>
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
                    <h4>Auto Shedule SMS For Message : <b>{{$msgs->subject}}</b></h4>
                        <form id="form" action="" method="post" role="form">
                            <input name="msg_id" value="{{$msgs->id}}" type="hidden"/>
                        	<div class="form-group">
                        		<label for="">SEND SMS BASED ON</label>
                        		<select name="based" id="basedselect" class="form-control">
                        			<option value="none"> -- Select One -- </option>
                                    <option value="birthday">Selected Contacts Birthday </option>
                                    <option value="frequency"> Send Frequently</option>
                                    <option value="dates"> Chosen Date</option>
                        		</select>
                        	</div>
                            <div id="containment">


                            </div>



                        	<button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>




                    <blockquote style="margin-top: 50px;">
                        <p>Auto Schedule SMS helps you to auto generate SMS based on parameters that
                         you set for example, a chosen set of dates between certain period of times, on your contacts
                         birthdays, on special holidays like Christmas, New Years, Independence Days,
                        Children's Day, and so many more. You Also get to choose special days yourselves.</p>
                    </blockquote>


                {{--{{print_r($msgs)}}--}}
                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    @include('partials.sidebar')

                </div>  <!--=======  col-md-3 END HERE =========-->


                <div class="loading"></div>

            </div>
        </div>
    </section>



@stop

@section('scripts')

    <script src="{{asset('JQtimepicker/jquery.datetimepicker.full.min.js')}}"></script>
    <script>

        $('#form').on('focus','.time',function(){
//            console.log(this.id);
            $(this).datetimepicker({datepicker:false,
            format:'H:i'});

        });
        $('#form').on('focus','.pickdate',function(){
//            console.log(this.id);
            $(this).datetimepicker({timepicker:false,
                minDate:0,format:'Y/m/d'});

        });


    </script>

    <script>
        $('#form').on('click','#save-date',function(event){
            event.preventDefault();

            var data1 = $('#form #datename').val();
            var data2 = $('#form #datevalue').val();
            var url = '{{route('adddate')}}';
            var data = "name="+data1+"&date="+data2;
            console.log(data);
            $.ajaxSetup({
                headers: {
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
                    console.log(data.msg);
                        $("#form #modal-add").modal('hide');
                        swal(
                                'Success',
                                'Your Unique Has Been Saved',
                                'success'
                        )
                        ajaxLoad('{{route('dates')}}');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
            return false;
        });






        $('#basedselect').change(function() {
            var value = $(this).val()
            if(value == 'birthday'){

                ajaxLoad('{{route('birthday')}}');
            }else if(value == 'frequency')
            {
                ajaxLoad('{{route('frequency')}}');
            }else if(value == 'dates')
            {
                ajaxLoad('{{route('dates')}}');
            }else{

                $('#containment').empty();
            }

        });
        function ajaxLoad(filename, content) {
            content = typeof content !== 'undefined' ? content : 'containment';
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
                    $("#" + content).html(data);
                    $('.loading').hide();

                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    </script>


    <script>
        $('#form').submit(function(event){
            event.preventDefault();

            var data = $(this).serialize();
            var based = $("#basedselect").val();
            if(based == "birthday"){
                var url = '{{route('schedulebirthday')}}';
            }else if(based == "frequency"){
                var url = '{{route('schedulefrequency')}}';
            }else if(based == "dates"){
                var url = '{{route('scheduledates')}}';
            }else{
                swal(
                        'Notice',
                        'Select What Your Scheduling Will Be Based On',
                        'warning'
                );
                $("#basedselect").focus();
                return false;
            }

            $.ajaxSetup({
                headers: {
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
                    $('.loading').hide();
                    if (data.fail) {
                        sweetAlert(
                                'Oops...',
                                'Some Fields Are Empty',
                                'warning'
                        );
                    } else {

                        window.location.assign('{{route('compose')}}');
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