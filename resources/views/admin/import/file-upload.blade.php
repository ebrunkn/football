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
                    <a href="#">Team</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Import</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <div class="grid">
                    <p class="grid-header">
                        Bulk Import (Excel Format)
                        <a href="{{url('teams/sample-excel')}}" class="btn btn-sm btn-info float-right">
                        <i class="mdi mdi-file-excel"></i>
                            Download Sample Excel
                        </a>
                    </p>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="row mb-3">

                                <div class="col-md-8 mx-auto">

                                    {!! Form::open(array('id'=>'data-form','class'=>'','url'=> url('teams/import'), 'files' => true, 'callback'=> url('teams'))) !!}
                                        
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Team Name</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::file('data_file') !!}
                                                <span class="invalid-feedback" id="form-error-name"></span>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                        
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                @include('admin.partials.submit-button')
                                                {{-- {!! Form::submit('Update', array('class'=>'btn btn-success btn-block',
                                                'id' => 'form-submit')) !!} --}}
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
