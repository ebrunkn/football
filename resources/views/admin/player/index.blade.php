@extends ('admin.layout.master')

@section('content')
  <div class="page-content-wrapper-inner">
          <div class="viewport-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb has-arrow">
                <li class="breadcrumb-item">
                  <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#">Players</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
              </ol>
            </nav>
          </div>
          <div class="content-viewport">
            <div class="row">
              <div class="col-lg-12">
                <div class="grid">
                  <p class="grid-header">
                    Players List 
                    
                    @if(app('request')->teamId) Of A Team 

                      <a href="{{url('players/assign')}}" class="btn btn-sm btn-success float-right ml-2">
                        <i class="mdi mdi-link-variant"></i>
                        Assign A Player
                      </a>

                    @endif


                    <a href="{{url('players/add')}}" class="btn btn-sm btn-success float-right">
                      <i class="mdi mdi-plus"></i>
                      Add New Player
                    </a>
                  </p>
                  <div class="item-wrapper">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>

                          <tr>
                            <th>Player Name</th>
                            <th>Assigned Team</th>
                            <th>Status</th>
                            <th></th>
                          </tr>

                        </thead>
                        <tbody>
                          @foreach($data_bundle['players'] as $player)
                            <tr>
                              <td class="">
                                {{$player->name}}
                              </td>
                              <td>
                                <a href="{{ url('teams/players', array($player->team['id'])) }}">
                                  {{$player->team['name'] ?? 'NA'}}
                                </a>
                              </td>
                              <td>{{$player->status_label}}</td>
                              <td class="actions">
                                
                                <a href="#" class="btn btn-xs btn-danger" data-toggle="popover" data-html="true" data-placement="left" title="Do you want delete?"
                                 data-content='<a class="btn btn-xs btn-success" href="{{url('players/delete', array($player->id))}}">Yes</a> <a class="btn btn-xs btn-danger" href="#">No</a>'>
                                  <i class="mdi mdi-trash-can"></i>
                                </a>
                                <a href="{{url('players/edit', array($player->id))}}" class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></i></a>

                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-end">
                <div class="col align-self-end">
                {!! $data_bundle['players']->render() !!}
              </div>
            </div>
          </div>
        </div>
@stop

@push('page-specific-js-lib')
  {!! Html::script('admin/label-free/js/vendor.addons.js') !!}
@endpush

@push('page-specific-script')
  <script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover({
            trigger: 'focus'
          });   
      });
    </script>
@endpush
