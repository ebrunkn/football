<div class="form-group row showcase_row_area">
    <div class="col-md-3 showcase_text_area">
        <label for="inputType1">Player Name</label>
    </div>
    <div class="col-md-9 showcase_content_area">
        {!! Form::text('name', $data_bundle['player']->name ?? '', array('class'=>'form-control','placeholder'=>'Player Name')) !!}
        <span class="invalid-feedback" id="form-error-name"></span>
    </div>
</div>

<div class="form-group row showcase_row_area">
    <div class="col-md-3 showcase_text_area">
        <label for="inputType1">Choose the team (Optional)</label>
    </div>
    <div class="col-md-9 showcase_content_area">
        {!! Form::select('team',$data_bundle['teams'], $data_bundle['player']->team_id ?? '', array('class'=>'form-control','placeholder'=>'Select a team')) !!}
        <span class="invalid-feedback" id="form-error-teams"></span>
    </div>
</div>

<div class="form-group row showcase_row_area">
    <div class="col-md-3 showcase_text_area">
        <label for="inputType1">Status</label>
    </div>
    <div class="col-md-9 showcase_content_area">
        {!! Form::select('status',['1'=>'Active','0'=>'Block'],$data_bundle['player']->active ?? '', array('class'=>'form-control','placeholder'=>'Select Status')) !!}
        <span class="invalid-feedback" id="form-error-status"></span>
    </div>
</div>

<div class="form-group row showcase_row_area">
    <div class="col-md-3 showcase_text_area">

    </div>
    <div class="col-md-9 showcase_content_area">

        @include('admin.partials.submit-button')

    </div>
</div>