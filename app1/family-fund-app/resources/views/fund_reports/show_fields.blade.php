<!-- Fund Id Field -->
<div class="form-group">
    {!! Form::label('fund_id', 'Fund Id:') !!}
    <p>{{ $fundReport->fund_id }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $fundReport->type }}</p>
</div>

<!-- As Of Field -->
<div class="form-group">
    {!! Form::label('as_of', 'As Of:') !!}
    <p>{{ $fundReport->as_of }}</p>
</div>

<!-- Fund Report Schedule Id Field -->
<div class="form-group">
    {!! Form::label('scheduled_job_id', 'Scheduled Job Id:') !!}
    <p>{{ $fundReport->scheduled_job_id }}</p>
</div>

