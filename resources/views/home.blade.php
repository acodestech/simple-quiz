@extends('layouts.default')

@section('title', 'Simple Quiz')

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
@endsection

@section('body', 'text-center')

@section('content')
<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
  	<header class="masthead mb-auto">
    	<div class="inner">
      		<h3 class="masthead-brand">Simple Quiz</h3>
    	</div>
  	</header>
	<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered modal-sm">
	    	<div class="modal-content d-flex justify-content-center align-items-center">
	    	</div>
	  	</div>
	</div>
  	<main role="main" class="inner cover">
    	<h1 class="cover-heading">Enter Your Desired Date</h1>
    	<form class="form" method="POST" id="date-form">
    		@csrf
        	<div class="row d-flex justify-content-center">
              	<div class="col-md-9 col-sm-6">
              		<input type="input" class="form-control" id="input_date" name="input_date" placeholder="yyyy-mm-dd" autocomplete="off">
              	</div>
            </div>
        	<p class="lead">Output data will be based on weekdays or weekend.</p>
		</form>
    	<p class="lead">
      		<a href="#" data-type="json" class="btn btn-lg btn-secondary submit-button">Click to retrive</a>
    	</p>
    	<div class="d-flex justify-content-center">
    		<div class="card" style="width: 100%">
			  	<div class="card-body">
			  	</div>
			</div>
    	</div>
  	</main>
  	<footer class="mastfoot mt-auto">
    	<div class="inner">
      		<p><h6>For GetAsia <a href="index.php">Simple Quiz</a>, by <a href="index.php">@heinchiong</a>.</h6></p>
		</div>
  	</footer>
</div>
@endsection('content')

@push('scripts')
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! $validator !!}
<script type="text/javascript">

$(document).ready(function() {
	$('#input_date').mask('0000-00-00', {
	    translation: {
	      	'0': {
	        	pattern: /[0-9]/
	      	},
	    }
	});

    $('.submit-button').click(function() {
    	var valid = $("#date-form").valid();
    	$('.card-body').empty().css("color","white");
    	if (valid) {
    		$("#input_date").next().remove();
    		$.ajax({
                url: 'api/data',
                type: 'post',
                dataType: 'json',
                data: new FormData($("#date-form")[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                	$(".card-body").text(JSON.stringify(response));
                	if (!response.status) {
                        $(".card-body").css("color","#ffb9b9");
                    }
                }
            });
    	}
    });
});
</script>
@endpush