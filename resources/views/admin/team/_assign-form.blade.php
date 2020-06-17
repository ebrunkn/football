<div class="form-group row showcase_row_area">
    <div class="col-md-3 showcase_text_area">
        <label for="inputType1">Team Name</label>
    </div>

    <div class="col-md-9 showcase_content_area">
        @if(app('request')->teamId)
            {{ $data_bundle['team']->name }}
            {!! Form::hidden('team', $data_bundle['team']->id) !!}
        @else
            {!! Form::select('team',$data_bundle['teams'], $data_bundle['player']->team_id ?? '', array('class'=>'form-control','placeholder'=>'Select a team')) !!}
        @endif
        <span class="invalid-feedback" id="form-error-team"></span>
    </div>
</div>

<div class="form-group row showcase_row_area">
    <div class="col-md-3 showcase_text_area">
        <label for="inputType1">Players</label>
    </div>
    <div class="col-md-9 showcase_content_area">
        {!! Form::select('player',$data_bundle['players'], '', array('class'=>'select-2-dropdown form-control','placeholder'=>'Select Status')) !!}
        <span class="invalid-feedback" id="form-error-player"></span>
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