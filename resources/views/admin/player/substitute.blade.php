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
                <li class="breadcrumb-item active" aria-current="page">Substitute</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <div class="grid">
                    <p class="grid-header">Substitute Player</p>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="row mb-3">

                                <div class="col-md-8 mx-auto">

                                    {!! Form::open(array('id'=>'data-form','class'=>'form','url'=> url('teams/substitute'),'callback'=> url('teams/players', array($data_bundle['player']->team['id'])))) !!}
                                        
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Main Player</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{ $data_bundle['player']->name }}
                                                {!! Form::hidden('main_player', $data_bundle['player']->id) !!}
                                                <span class="invalid-feedback" id="form-error-main_player"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Substitute Player</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::select('sub_player',$data_bundle['sub_players'], '', array('class'=>'form-control team-dropdown','placeholder'=>'Select a team')) !!}
                                                <span class="invalid-feedback" id="form-error-sub_player"></span>
                                            </div>
                                        </div>
                                                                                            
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                        
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                        
                                                @include('admin.partials.submit-button')
                                        
                                            </div>
                                        </div>
                                    

                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
    {!! Html::script('form-handle/ajax-form.js') !!}
    @push('page-specific-script')
    <script>
        $('.add-more').click(function(e) {
        e.preventDefault();
        console.log('Clicked');
        $('#contact-person-item').children().clone().appendTo('.contacts');
    })
    </script>
    @endpush
    @stop
