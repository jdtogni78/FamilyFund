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
                                 @include('accounts.show_fields_ext')
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Performance<strong>
                            </div>
                            <div class="card-body">
                                @include('accounts.performance_table')
                                <div class="pull-right mr-3">
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Transactions<strong>
                            </div>
                            <div class="card-body">
                                @include('accounts.transactions_table')
                                <div class="pull-right mr-3">
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>                 
          </div>
    </div>
@endsection
