<div class="form-group"><p>{!! Form::label('name', 'Name:') !!} {{ $api['name'] }}</p></div>
<div class="form-group"><p>{!! Form::label('shares', 'Shares:') !!} {{ $api['summary']['shares'] }}</p></div>
<div class="form-group"><p>{!! Form::label('unallocated_shares', 'Unallocated Shares:') !!} {{ $api['summary']['unallocated_shares'] }}</p></div>
<div class="form-group"><p>{!! Form::label('value', 'Total Value:') !!} {{ $api['summary']['value'] }}</p></div>
<div class="form-group"><p>{!! Form::label('shares', 'Share Price:') !!} {{ $api['summary']['share_value'] }}</p></div>
<div class="form-group"><p>{!! Form::label('asof', 'As Of:') !!} {{ $api['as_of'] }}</p></div>

