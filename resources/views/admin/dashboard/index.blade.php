@extends ('admin.layout.master')

@push('page-specific-css-lib')
<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
@endpush

@section('content')


<div class="page-content-wrapper-inner">
    <div class="content-viewport">
      <div class="row">
        <div class="col-12 py-5">
          <h4>Dashboard</h4>
          <p class="text-gray">Welcome aboard, {{auth()->guard('admin')->user()->name}}</p>
        </div>
      </div>
      <div class="row">


        <div class="col-md-4 col-12 equel-grid">
            <div class="grid">
              <div class="grid-body text-gray">
                <div class="text-center">
                  <h3 class="d-flex align-items-center justify-content-center ajax-element total_players">
                    
                  </h3>
                </div>
                <hr>
                <p class="text-black text-center"><a href="buildings" class="">Players</a></p>
              </div>
            </div>
          </div>


        <div class="col-md-4 col-12 equel-grid">
          <div class="grid">
            <div class="grid-body text-gray">
              <div class="text-center">
                <h3 class="d-flex align-items-center justify-content-center">
                  {{$data_bundle['food_request']['received'] ?? 'no value'}} <small> &nbsp; Total Requests</small>
                </h3>
                <h3 class="d-flex align-items-center justify-content-center">
                  {{$data_bundle['food_request']['completed'] ?? 'no value'}} <small> &nbsp; Completed Requests</small>
                </h3>
                <h3 class="d-flex align-items-center justify-content-center">
                  {{$data_bundle['food_request']['processing'] ?? 'no value'}} <small> &nbsp; Processing Requests</small>
                </h3>
                <h3 class="d-flex align-items-center justify-content-center">
                  {{$data_bundle['food_request']['pending'] ?? 'no value'}} <small> &nbsp; Pending Requests</small>
                </h3>
              </div>
              <hr>
              <p class="text-black text-center"><a href="requirement/food" class="">Food Requests</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12 equel-grid">
          <div class="grid">
            <div class="grid-body text-gray">
              <div class="text-center">
                <h3 class="d-flex align-items-center justify-content-center">
                  {{$data_bundle['warehouse_request']['received'] ?? 'no value'}} &nbsp; <small> Total Requests</small>
                </h3>
                <h3 class="d-flex align-items-center justify-content-center">
                  {{$data_bundle['warehouse_request']['completed'] ?? 'no value'}} &nbsp; <small> Completed Requests</small>
                </h3>
                <h3 class="d-flex align-items-center justify-content-center">
                  {{$data_bundle['warehouse_request']['processing'] ?? 'no value'}} <small> &nbsp; Processing Requests</small>
                </h3>
                <h3 class="d-flex align-items-center justify-content-center">
                  {{$data_bundle['warehouse_request']['pending'] ?? 'no value'}} &nbsp; <small> Pending Requests</small>
                </h3>
              </div>
              <hr>
              <p class="text-black text-center"><a href="requirement/warehouse" class="">Warehouse Requests</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content viewport ends -->

@stop

@push('page-specific-js-lib')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>


{!! Html::script('admin/vendors/apexcharts/apexcharts.min.js') !!}
{!! Html::script('admin/vendors/chartjs/Chart.min.js') !!}
{!! Html::script('admin/js/charts/chartjs.addon.js') !!}
{!! Html::script('admin/js/dashboard.js') !!}
@endpush

@push('page-specific-script')
<script>
	$(document).ready(function(){
		
		$('.ajax-element').html('<small>Loading Data</small>');

		function dashboardData(url){
			$.ajax({
				type: "GET",
				url: url,
				dataType: 'json',
				success: function(result)
				{
					console.log( result.data );
					$('.total_players').html(result.data.players.total ?? 0);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log( result );
				}
			});
		}

		dashboardData("{{ url('ajax-data') }}");

		setInterval(function(){ dashboardData("{{ url('ajax-data') }}"); }, 5000);

	});
</script>
@endpush
