<div class="form-group row showcase_row_area">
    <div class="col-md-3 showcase_text_area">
        <label for="inputType1">Team Name</label>
    </div>
    <div class="col-md-9 showcase_content_area">
        {!! Form::text('name',
        $data_bundle['team']->name ?? '',
        array('class'=>'form-control','placeholder'=>'Team Name')) !!}
        <span class="invalid-feedback" id="form-error-name"></span>
    </div>
</div>


<div class="form-group row showcase_row_area">
    <div class="col-md-3 showcase_text_area">
        <label for="inputType1">Status</label>
    </div>
    <div class="col-md-9 showcase_content_area">
        {!! Form::select('status',['1'=>'Active','0'=>'Block'],$data_bundle['team']->active ?? '', array('class'=>'form-control','placeholder'=>'Select Status')) !!}
        <span class="invalid-feedback" id="form-error-status"></span>
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