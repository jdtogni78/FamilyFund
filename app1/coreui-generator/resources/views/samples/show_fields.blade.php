<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $sample->title }}</p>
</div>

<!-- Post Date Field -->
<div class="form-group">
    {!! Form::label('post_date', 'Post Date:') !!}
    <p>{{ $sample->post_date }}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <p>{{ $sample->body }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $sample->email }}</p>
</div>

<!-- Author Gender Field -->
<div class="form-group">
    {!! Form::label('author_gender', 'Author Gender:') !!}
    <p>{{ $sample->author_gender }}</p>
</div>

<!-- Post Type Field -->
<div class="form-group">
    {!! Form::label('post_type', 'Post Type:') !!}
    <p>{{ $sample->post_type }}</p>
</div>

<!-- Post Visits Field -->
<div class="form-group">
    {!! Form::label('post_visits', 'Post Visits:') !!}
    <p>{{ $sample->post_visits }}</p>
</div>

<!-- Category Field -->
<div class="form-group">
    {!! Form::label('category', 'Category:') !!}
    <p>{{ $sample->category }}</p>
</div>

<!-- Category Short Field -->
<div class="form-group">
    {!! Form::label('category_short', 'Category Short:') !!}
    <p>{{ $sample->category_short }}</p>
</div>

<!-- Is Private Field -->
<div class="form-group">
    {!! Form::label('is_private', 'Is Private:') !!}
    <p>{{ $sample->is_private }}</p>
</div>

<!-- Writer Id Field -->
<div class="form-group">
    {!! Form::label('writer_id', 'Writer Id:') !!}
    <p>{{ $sample->writer_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $sample->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $sample->updated_at }}</p>
</div>

