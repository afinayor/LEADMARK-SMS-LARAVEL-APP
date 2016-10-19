{{--extending the main template--}}
@extends('template')



@section('content')


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder" style="display:inline-block ;margin-top: 20px;">
                    <div class="row">
                    <img src="{{asset("images\\profile-photos\\$user->profile_pic")}}" alt="{{$user->username}}" class="img-circle img-responsive img-raised">
                   </div>
                    <div class="row">


                            <h2 style="text-align: center">{{$user->getName()}}</h2>
                        <h6 class="l-title">{{$user->title}}</h6>
                        <h6 class="social-big2 ">
                            @if($user->facebook)
                                <span><a href="http://www.facebook.com/{{$user->facebook}}" class="facebook"><i class="fa fa-facebook"></i></a></span>
                            @endif
                            @if($user->twitter)
                                    <span><a href="http://www.twitter.com/{{$user->twitter}}" class="twitter"><i class="fa fa-twitter"></i></a></span>
                            @endif
                            @if($user->linkedin)
                                    <span><a href="http://www.linkedin.com/{{$user->linkedin}}" class="linkedin"><i class="fa fa-linkedin"></i></a></span>
                            @endif
                            @if($user->instagram)
                                    <span><a href="http://www.instagram.com/{{$user->instagram}}" class="instagram"><i class="fa fa-instagram"></i></a></span>
                            @endif
                            @if($user->google_plus)
                                    <span><a href="http://www.googleplus.com/{{$user->google_plus}}" class="google-plus"><i class="fa fa-google-plus"></i></a></span>
                            @endif
                        </h6>


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

                    <h2 class="section-title">Profile</h2>

                    <p for=""><b>Username: </b> {{$user->username}}</p>
                    <p for=""><b>Email: </b> {{$user->email}}</p>
                    <p for=""><b>Phone: </b> {{$user->phone}}</p>
                    <p for=""><b>Website: </b> <a href="{{$user->website}}">{{$user->website}}</a></p>
                    <p for=""><b>Address: </b> {{$user->address}}</p>

                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    @include('partials.sidebar')

                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



@stop