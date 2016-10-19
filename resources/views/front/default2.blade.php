{{--extending the main template--}}
@extends('template')

@section('head')
	<link rel="stylesheet" type="text/css" href="/tabs/css/tabs.css" />
	<link rel="stylesheet" type="text/css" href="/tabs/css/tabstyles.css" />
	<script src="/tabs/js/modernizr.custom.js"></script>


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

					<h2 class="shortcodes-title">Phone Book</h2>

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
								<section id="section-linebox-1"><p>1</p></section>
								<section id="section-linebox-2"><p>2</p></section>
								<section id="section-linebox-3"><p>3</p></section>
								<section id="section-linebox-4"><p>4</p></section>

							</div><!-- /content -->
						</div><!-- /tabs -->

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
	<script src="/tabs/js/cbpFWTabs.js"></script>
	<script>
		(function() {

			[].slice.call( document.querySelectorAll( '#tabstylez' ) ).forEach( function( el ) {
				new CBPFWTabs( el );
			});

		})();
	</script>

@stop





<div class="panel panel-default">
	<!-- Progress table -->
	<div class="table-responsive">
		<table class="table v-middle">
			<thead>
			<tr>
				<th width="20">
					<div class="checkbox">
						<label>
							<input id="select_all" type="checkbox" aria-label="check all">
						</label>
					</div>
				</th>
				<th>Subject</th>
				<th width="250px">Body</th>
				<th>Type</th>
				<th>Status</th>
				<th class="text-right">Action</th>
			</tr>
			</thead>
			<tbody id="responsive-table-body">
			<tr>
				<td>
					<div class="checkbox">
						<label>
							<input  type="checkbox" aria-label="check" name="check[]" class="checkbox">
						</label>
					</div>
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="text-right">
					<a href="#" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
					<a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><i
								class="fa fa-times"></i></a>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<!-- // Progress table -->

	<div class="panel-footer padding-none text-center">
		<ul class="pagination">
			<li class="disabled"><a href="#">&laquo;</a></li>
			<li class="active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">&raquo;</a></li>
		</ul>
	</div>
</div>