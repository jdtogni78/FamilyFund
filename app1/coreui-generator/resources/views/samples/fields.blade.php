<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Post Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_date', 'Post Date:') !!}
    {!! Form::text('post_date', null, ['class' => 'form-control','id'=>'post_date']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#post_date').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Author Gender Field -->
<div class="form-group col-sm-12">
    {!! Form::label('author_gender', 'Author Gender:') !!}
    <label class="radio-inline">
        {!! Form::radio('author_gender', "1", null) !!} Male
    </label>

    <label class="radio-inline">
        {!! Form::radio('author_gender', "0", null) !!} Female
    </label>

</div>

<!-- Post Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('post_type', 'Post Type:') !!}
    <label class="radio-inline">
        {!! Form::radio('post_type', "Public", null) !!} Public
    </label>

    <label class="radio-inline">
        {!! Form::radio('post_type', "Private", null) !!} Private
    </label>

</div>

<!-- Post Visits Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_visits', 'Post Visits:') !!}
    {!! Form::number('post_visits', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::select('category', ['Technology' => 'Technology', 'LifeStyle' => 'LifeStyle', 'Education' => 'Education', 'Games' => 'Games'], null, ['class' => 'form-control']) !!}
</div>

<!-- Category Short Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_short', 'Category Short:') !!}
    {!! Form::select('category_short', ['tech' => 'Technology', 'ls' => 'LifeStyle', 'edu' => 'Education', 'game' => 'Games'], null, ['class' => 'form-control']) !!}
</div>

<!-- Is Private Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_private', 'Is Private:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_private', 0) !!}
        {!! Form::checkbox('is_private', '1', null) !!}
    </label>
</div>


<!-- Writer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('writer_id', 'Writer Id:') !!}
    {!! Form::text('writer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('samples.index') }}" class="btn btn-secondary">Cancel</a>
</div>
