{{--extending the main template--}}
@extends('template')
@section('head')

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

                        <h2>EMAIL LIST : {{title_case($data->name)}}</h2>

                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('home')}}">Email</a></li>
                            <li><a href="{{route('emailLists')}}">Lists</a></li>
                            <li class="active">{{title_case($data->name)}}</li>
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

                    <h2 class="shortcodes-title">LIST OVERVIEW <div class="pull-right">
                            <a href="{{route('emailLists')}}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Lists</a>
                        </div></h2>
                    @include('partials.flashAlert')
                    <div class="row">
                        <a href="">
                            <div class="col-md-3 col-sm-6">
                                <div class="icon-box-5 icon-box-5-edit">
                                    <div class="fact2 animated bounceIn visible" data-animation="bounceIn" data-animation-delay="1000">
                                        <div class="fact-icon">
                                            <i class="icon-profile-male fa-2x"></i>
                                        </div>
                                        <h4 class="total-number-3">2,700</h4>
                                        <p>Subscribers</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="">
                            <div class="col-md-3 col-sm-6">
                                <div class="icon-box-5 icon-box-5-edit">
                                    <div class="fact2 animated bounceIn visible" data-animation="bounceIn" data-animation-delay="1000">
                                        <div class="fact-icon">
                                            <i class="icon-target fa-2x"></i>
                                        </div>
                                        <h4 class="total-number-3">2,700</h4>
                                        <p>Segments</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="">
                            <div class="col-md-3 col-sm-6">
                                <div class="icon-box-5 icon-box-5-edit">
                                    <div class="fact2 animated bounceIn visible" data-animation="bounceIn" data-animation-delay="1000">
                                        <div class="fact-icon">
                                            <i class=" icon-adjustments fa-2x"></i>
                                        </div>
                                        <h4 class="total-number-3">2,700</h4>
                                        <p>Custom Fields</p>
                                    </div>

                                </div>
                            </div>
                        </a>
                        <a href="">
                            <div class="col-md-3 col-sm-6">
                                <div class="icon-box-5 icon-box-5-edit">
                                    <div class="fact2 animated bounceIn visible" data-animation="bounceIn" data-animation-delay="1000">
                                        <div class="fact-icon">
                                            <i class="icon-browser fa-2x"></i>
                                        </div>
                                        <h4 class="total-number-3">2,700</h4>
                                        <p>Pages</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="">
                            <div class="col-md-3 col-sm-6">
                                <div class="icon-box-5 icon-box-5-edit">
                                    <div class="fact2 animated bounceIn visible" data-animation="bounceIn" data-animation-delay="1000">
                                        <div class="fact-icon">
                                            <i class="icon-download fa-2x"></i>
                                        </div>
                                        <h4 class="total-number-3" style="font-size: 14px">Suscribers</h4>
                                        <p>Export</p>
                                    </div>
                                </div>
                            </div>
                        </a><a href="">
                            <div class="col-md-3 col-sm-6">
                                <div class="icon-box-5 icon-box-5-edit">
                                    <div class="fact2 animated bounceIn visible" data-animation="bounceIn" data-animation-delay="1000">
                                        <div class="fact-icon">
                                            <i class=" icon-upload fa-2x"></i>
                                        </div>
                                        <h4 class="total-number-3" style="font-size: 14px">Suscribers</h4>
                                        <p>Import</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    @include('partials.sidebar')
                    <div class="loading"></div>
                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



@stop
@section('scripts')

@endsection