@extends ('admin.layout.master')

@section('content')
  <div class="page-content-wrapper-inner">
          <div class="viewport-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb has-arrow">
                <li class="breadcrumb-item">
                  <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Logs</li>
              </ol>
            </nav>
          </div>
          <div class="content-viewport">
            <div class="row">
              <div class="col-lg-12">
                <div class="grid">
                  <p class="grid-header">
                    Application Log List 
                  </p>
                  <div class="item-wrapper">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>

                          <tr>
                            <th>Admin</th>
                            <th>Model</th>
                            <th>Action</th>
                            <th>Log</th>
                          </tr>

                        </thead>
                        <tbody>
                          @forelse($data_bundle['logs'] as $log)
                            <tr>
                              <td class="">
                                {{$log->admin['name']}}
                              </td>
                              <td>{{$log->model ?? 'NA'}}</td>
                              <td>{{$log->action ?? 'NA'}}</td>
                              <td>{{$log->log ?? 'NA'}}</td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="4" class="text-center">
                                <h4 class="my-5">No Log Report Found</h4>
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
                {!! $data_bundle['logs']->render() !!}
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
