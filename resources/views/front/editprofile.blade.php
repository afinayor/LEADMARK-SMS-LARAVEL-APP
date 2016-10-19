{{--extending the main template--}}
@extends('template')



@section('content')


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder" style="display:inline-block ;margin-top: 20px;">
                    <div class="row">
                        <a href="{{route('profile',['username'=>Auth::User()->username])}}"><img src="{{asset('images/profile-photos/'.Auth::User()->profile_pic)}}" alt="{{Auth::User()->username}}" class="img-circle img-responsive img-raised"></a>
                   </div>
                    <div class="row">


                            <h2 style="text-align: center">{{Auth::User()->getName()}}</h2>
                        <h6 class="l-title">{{Auth::User()->title}}</h6>



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

                    <h2 class="shortcodes-title">Edit Profile</h2>
                    <div class="general">
                        <form action="{{route('update_profile')}}" method="post" role="form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('first_name') ? ' error has-error ' : '' }} ">
                                        <label for="First_Name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="First_Name" value="{{Auth::User()->first_name ?: Request::old('first_name')}}" placeholder="First Name">
                                        @if($errors->has('first_name'))
                                            <span class="help-block">
                                                        {{$errors->first('first_name')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('last_name') ? ' error has-error ' : '' }} ">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{Auth::User()->last_name ?: Request::old('last_name')}}" placeholder="Last Name">
                                        @if($errors->has('last_name'))
                                            <span class="help-block">
                                                        {{$errors->first('last_name')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('phone') ? ' error has-error ' : '' }} ">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="{{Auth::User()->phone ?: Request::old('phone')}}" placeholder="Phone No">
                                        @if($errors->has('phone'))
                                            <span class="help-block">
                                                        {{$errors->first('phone')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('birthday') ? ' error has-error ' : '' }} ">
                                        <label for="birthday">Birthday</label>
                                        <input type="text" class="datepicker form-control" name="birthday" id="birthday" value="{{Auth::User()->birthday ?: Request::old('birthday')}}" placeholder="Your Birthday">
                                        @if($errors->has('birthday'))
                                            <span class="help-block">
                                                        {{$errors->first('birthday')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="form-group {{ $errors->has('title') ? ' error has-error ' : '' }} ">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{Auth::User()->title ?: Request::old('title')}}" placeholder="E.g CEO at XYZ Group of Companies">
                                @if($errors->has('title'))
                                    <span class="help-block">
                                                        {{$errors->first('title')}}
                                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('address') ? ' error has-error ' : '' }} ">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{Auth::User()->address ?: Request::old('address')}}" placeholder="Address">
                                @if($errors->has('address'))
                                    <span class="help-block">
                                                        {{$errors->first('address')}}
                                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('website') ? ' error has-error ' : '' }} ">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" name="website" id="website" value="{{Auth::User()->website ?: Request::old('website')}}" placeholder="Website Address E.g  http://www.leadmark.com.ng">
                                @if($errors->has('website'))
                                    <span class="help-block">
                                                        {{$errors->first('website')}}
                                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('facebook') ? ' error has-error ' : '' }} ">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{Auth::User()->facebook ?: Request::old('facebook')}}" placeholder="Facebook Username">
                                        @if($errors->has('facebook'))
                                            <span class="help-block">
                                                        {{$errors->first('facebook')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('twitter') ? ' error has-error ' : '' }} ">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{Auth::User()->twitter ?: Request::old('twitter')}}" placeholder="Twitter Username">
                                        @if($errors->has('twitter'))
                                            <span class="help-block">
                                                        {{$errors->first('twitter')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('google') ? ' error has-error ' : '' }} ">
                                        <label for="google">Google+</label>
                                        <input type="text" class="form-control" name="google" id="google" value="{{Auth::User()->google_plus ?: Request::old('google')}}" placeholder="Google+ Username">
                                        @if($errors->has('google'))
                                            <span class="help-block">
                                                        {{$errors->first('google')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('linkedin') ? ' error has-error ' : '' }} ">
                                        <label for="linkedin">Linkedin</label>
                                        <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{Auth::User()->linkedin ?: Request::old('linkedin')}}" placeholder="Linkedin Username">
                                        @if($errors->has('linkedin'))
                                            <span class="help-block">
                                                        {{$errors->first('linkedin')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('instagram') ? ' error has-error ' : '' }} ">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram" value="{{Auth::User()->instagram ?: Request::old('instagram')}}" placeholder="Instagram Username">
                                        @if($errors->has('instagram'))
                                            <span class="help-block">
                                                        {{$errors->first('instagram')}}
                                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="form-group {{ $errors->has('image') ? ' error has-error ' : '' }} ">
                                <img src="{{asset('images/profile-photos/'.Auth::User()->profile_pic)}}" class="img-responsive img-thumbnail" alt="Update Profile Picture">
                                <label for="profile_pics" class="control-label">Profile Picture</label>

                                     <input type="file" name="image" class="form-control" id="profile_pics" placeholder="Choose Image">
                                @if($errors->has('image'))
                                    <span class="help-block">
                                                        {{$errors->first('image')}}
                                                    </span>
                                @endif
                            </div>

                            <input name="_token" value="{{Session::token()}}" type="hidden"/>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    @include('partials.sidebar')

                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script>
        if($('.datepicker').length != 0){
            $('.datepicker').datepicker({
                weekStart:1
            });
        }
    </script>
@stop