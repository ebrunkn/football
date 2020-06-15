@extends ('admin.layout.master')

@section('content')
  <div class="page-content-wrapper-inner">
          <div class="viewport-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb has-arrow">
                <li class="breadcrumb-item">
                  <a href="/">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="/requirement">Requirement </a>
                </li>
                <li class="breadcrumb-item">
                  <a href="/requirement/food">Food </a>
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
                    Food Request List
                  
                    <a href="{{url('requirement/food/add')}}" class="btn btn-sm btn-success float-right">
                      <i class="mdi mdi-plus"></i>
                      Order
                    </a>
                  </p>
                  <div class="item-wrapper">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>

                          <tr>
                            <th>Meal Type</th>
                            <th>Cuisine Type</th>
                            <th>Qty Requested</th>
                            <th>Building / Person</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                            <th></th>
                          </tr>

                        </thead>
                        <tbody>
                          @foreach($data_bundle['items'] as $item)
                            <tr>
                              <td class="">
                                {{$item->getFoodTime->name}}
                              </td>
                              <td class="">
                                {{$item->getFoodCuisine->name}}
                              </td>
                              <td>{{$item->requested_qty}}</td>
                              <td>{{$item->getBuilding->building_name ?? $item->individual_name.'('.$item->individual_mobile.')'}}</td>
                              <td>{{Carbon::parse($item->created_at)->format('d M, Y   h:i A')}}</td>
                              <td>
                              <span class="badge badge-{{$data_bundle['status_label_color'][$item->status]}}">{{$item->status_label}}</span>
                              </td>
                              <td class="actions">
                                {{-- @switch($item->status)
                                @case(2)
                                <a href="#" class="btn btn-xs
                                        btn-success" title="Delivered">Delivered</a>
                                @break
                                @case(1)
                                <a href="{{url('requirement/' . $item->type . '/edit', array($item->id))}}"
                                    class="btn btn-xs
                                        btn-primary" title="Change to Delivered">Processing</a>
                                @break
                                @default
                                <a href="{{url('requirement/' . $item->type . '/edit', array($item->id))}}"
                                    class="btn btn-xs
                                        btn-danger" title="Change to Processing">New</a>
                                @break
                                @endswitch --}}
                                <a href="{{url('requirement/' . $item->type . '/edit', array($item->id))}}"
                                  class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></i></a>
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

            <div class="row">
              <div class="col-12">
                {!! $data_bundle['items']->render() !!}
              </div>
            </div>
          </div>
        </div>
@stop

@push('page-specific-js-lib')
  {!! Html::script('admin/label-free/js/vendor.addons.js') !!}
@endpush
