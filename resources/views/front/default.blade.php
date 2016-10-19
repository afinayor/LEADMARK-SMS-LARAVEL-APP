{{--extending the main template--}}
@extends('template')



@section('content')


    <!-- BLOG TITLE -->
    <div class="project-title parallax-section">
        <div class="parallax-overlay">
            <div class="container">
                <div class="title-holder">
                    <div class="title-text">

                        <h2>Title Of The Page</h2>

                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li class="active">Post Name</li>
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

                    <h2 class="shortcodes-title">Normal Page</h2>


                </div><!--=======  col-md-8 END HERE =========-->

                <div class="col-md-3 col-sm-4 col-md-pull-9">  <!--=======  col-md-4 START =========-->

                    @include('partials.sidebar')

                </div>  <!--=======  col-md-3 END HERE =========-->




            </div>
        </div>
    </section>



@stop