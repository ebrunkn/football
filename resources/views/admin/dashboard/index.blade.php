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
                  <h3 class="ajax-element">
                    <small>Total Players</small>
                    <br>
                    <span class="total_players"></span>
                  </h3>
                  <h3 class="ajax-element">
                    <small>Active Players</small>
                    <br>
                    <span class="active_players"></span>
                  </h3>
                  <h3 class="ajax-element">
                    <small>Blocked Players</small>
                    <br>
                    <span class="inactive_players"></span>
                  </h3>
                </div>
                <hr>
                <p class="text-black text-center"><a href="{{ url('players') }}" class="">Players</a></p>
              </div>
            </div>
		</div>


        <div class="col-md-4 col-12 equel-grid">
            <div class="grid">
              <div class="grid-body text-gray">
                <div class="text-center">
                  <h3 class="ajax-element">
                    <small>Total Teams</small>
                    <br>
                    <span class="total_teams"></span>
                  </h3>
                  <h3 class="ajax-element">
                    <small>Active Teams</small>
                    <br>
                    <span class="active_teams"></span>
                  </h3>
                  <h3 class="ajax-element">
                    <small>Blocked Teams</small>
                    <br>
                    <span class="inactive_teams"></span>
                  </h3>
                </div>
                <hr>
                <p class="text-black text-center"><a href="{{ url('teams') }}" class="">Teams</a></p>
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
		
		$('.ajax-element').find('span').html('<small>Loading Data</small>');

		function dashboardData(url){
			$.ajax({
				type: "GET",
				url: url,
				dataType: 'json',
				success: function(result)
				{
					console.log( result.data );
					$('.total_players').html(result.data.players.total ?? 0);
					$('.active_players').html(result.data.players.active ?? 0);
					$('.inactive_players').html(result.data.players.inactive ?? 0);

					$('.total_teams').html(result.data.teams.total ?? 0);
					$('.active_teams').html(result.data.teams.active ?? 0);
					$('.inactive_teams').html(result.data.teams.inactive ?? 0);
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
