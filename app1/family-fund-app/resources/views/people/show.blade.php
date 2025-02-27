@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('people.index') }}">Person</a>
            </li>
            <li class="breadcrumb-item active">Detail</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Details</strong>
                                 <a href="{{ route('people.index') }}" class="btn btn-light">Back</a>
                                 <a href="{{ route('people.edit', $person->id) }}" class="btn btn-primary">Edit</a>
                             </div>
                             <div class="card-body">
                                 <div class="row">
                                     @include('people.show_fields')
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
