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

                        <h2>SMS HISTORY</h2>

                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('compose')}}">SMS</a></li>
                            <li class="active">SMS History</li>
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

                    <h2 class="shortcodes-title">SMS HISTORY</h2>
                    <div id="content"></div>


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
<script>

$("#content").on('change','#select_all',function(){
    var status = this.checked; // "select all" checked status
        $('.checkbox').each(function(){ //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
});
$("#content").on('change','.checkbox',function(){
        if(this.checked == false) { //if this item is unchecked
            $("#select_all")[0].checked = false; //change "select all" checked status to false
        }
});


    //select all checkboxes
//    $("#select_all").change(function(){  //"select all" change
//        var status = this.checked; // "select all" checked status
//        $('.checkbox').each(function(){ //iterate all listed checkbox items
//            this.checked = status; //change ".checkbox" checked status
//        });
//    });
//
//    uncheck "select all", if one of the listed checkbox item is unchecked
//    $('.checkbox').change(function(){ //".checkbox" change
//        if(this.checked == false){ //if this item is unchecked
//            $("#select_all")[0].checked = false; //change "select all" checked status to false
//        }
//    });

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
        ajaxLoad('{{route('listHistory')}}');
    });
</script>
@endsection