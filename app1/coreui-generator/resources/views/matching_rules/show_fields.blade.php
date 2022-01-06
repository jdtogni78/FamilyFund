<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $matchingRules->name }}</p>
</div>

<!-- Dollar Range Start Field -->
<div class="form-group">
    {!! Form::label('dollar_range_start', 'Dollar Range Start:') !!}
    <p>{{ $matchingRules->dollar_range_start }}</p>
</div>

<!-- Dollar Range End Field -->
<div class="form-group">
    {!! Form::label('dollar_range_end', 'Dollar Range End:') !!}
    <p>{{ $matchingRules->dollar_range_end }}</p>
</div>

<!-- Date Start Field -->
<div class="form-group">
    {!! Form::label('date_start', 'Date Start:') !!}
    <p>{{ $matchingRules->date_start }}</p>
</div>

<!-- Date End Field -->
<div class="form-group">
    {!! Form::label('date_end', 'Date End:') !!}
    <p>{{ $matchingRules->date_end }}</p>
</div>

<!-- Match Percent Field -->
<div class="form-group">
    {!! Form::label('match_percent', 'Match Percent:') !!}
    <p>{{ $matchingRules->match_percent }}</p>
</div>

