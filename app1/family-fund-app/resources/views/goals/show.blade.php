@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('goals.index') }}">Goal</a>
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
                                  <a href="{{ route('goals.index') }}" class="btn btn-light">Back</a>
                             </div>
                             <div class="card-body">
                                 @include('goals.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Associated Accounts</strong>
                             </div>
                             <div class="card-body">
                                 @include('accounts.table', ['accounts' => $goal->accounts])
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
