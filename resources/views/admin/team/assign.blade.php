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
                        <a href="#">Assign</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Team & Player</li>
                </ol>
            </nav>
        </div>
        <div class="content-viewport">
            <div class="row">
                <div class="col-lg-12">
                    <div class="grid">
                        <p class="grid-header">Assign Team & Player</p>
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">

                                    <div class="col-md-8 mx-auto">

                                        {!! Form::open(array('id'=>'data-form','class'=>'form','url'=> url('teams/assign'))) !!}
                                            
                                            @include('admin.team._assign-form')

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

@push('page-specific-css-lib')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('page-specific-js-lib')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
    {!! Html::script('form-handle/ajax-form.js') !!}
@endpush

@push('page-specific-script')
    <script>
        $(document).ready(function(){

            $('.add-more').click(function(e){
                e.preventDefault();
                // console.log('Clicked');
            });

            $('.select-2-dropdown').select2();

        });
            
    </script>
@endpush