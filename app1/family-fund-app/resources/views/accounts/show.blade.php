@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('accounts.index') }}">Account</a>
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
                                  <a href="{{ route('accounts.index') }}" class="btn btn-light">Back</a>
                             </div>
                             <div class="card-body">
                                 @include('accounts.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Goals</strong>
                            </div>
                            <div class="card-body">
                                @foreach($account->goals as $goal)
                                    <h3>{{ $goal->name }} ({{ $goal->id }})</h3>
                                    @include('goals.progress_bar')
                                    @include('goals.progress_details')
                                @endforeach
                            </div>
                        </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
