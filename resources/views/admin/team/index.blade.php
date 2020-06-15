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
                  <a href="#">Teams</a>
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
                    Team List
                    <a href="{{url('teams/add')}}" class="btn btn-sm btn-success float-right">
                      <i class="mdi mdi-plus"></i>
                      Add New
                    </a>
                  </p>
                  <div class="item-wrapper">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>

                          <tr>
                            <th>Team Name</th>
                            <th>Total Players</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>

                        </thead>
                        <tbody>
                          @forelse($data_bundle['teams'] as $team)
                            <tr>
                              <td class="">
                                <a href="{{ url('teams/players', array($team->id)) }}">
                                  {{$team->name ?? 'NA'}}
                                </a>
                              </td>
                              <td>{{$team->total_players ?? 0}}</td>
                              <td>{{$team->status_label}}</td>
                              <td class="actions">
                                
                                <a href="#" class="btn btn-xs btn-danger" data-toggle="popover" data-html="true" data-placement="left" title="Do you want delete?"
                                 data-content='<a class="btn btn-xs btn-success" href="{{url('teams/delete', array($team->id))}}">Yes</a> <a class="btn btn-xs btn-danger" href="#">No</a>'>
                                  <i class="mdi mdi-trash-can"></i>
                                </a>
                                <a href="{{url('teams/edit', array($team->id))}}" class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></i></a>
                                <a title="Players List" href="{{url('teams/players', array($team->id))}}" class="btn btn-xs btn-info"><i class="mdi mdi-account-multiple"></i></a>

                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="4" class="text-center">
                                <h4 class="my-5">No Teams Found</h4>
                              </td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-end">
                <div class="col align-self-end">
                {!! $data_bundle['teams']->render() !!}
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
