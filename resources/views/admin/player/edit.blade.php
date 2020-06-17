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
                        <a href="#">Player</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="content-viewport">
            <div class="row">
                <div class="col-lg-12">
                    <div class="grid">
                        <p class="grid-header">Edit Player</p>
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">

                                    <div class="col-md-8 mx-auto">

                                        {!! Form::model($data_bundle['player'], array('id'=>'data-form','class'=>'form','url'=> url('players/save', array($data_bundle['player']->id)),'callback'=> url('players'))) !!}
                                            
                                            @include('admin.player._form')

                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@push('page-specific-js-lib')
    {!! Html::script('form-handle/ajax-form.js') !!}
@endpush