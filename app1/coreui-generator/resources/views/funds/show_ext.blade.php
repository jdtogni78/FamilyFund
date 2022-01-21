@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('funds.index') }}">Fund</a>
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
                                  <a href="{{ route('funds.index') }}" class="btn btn-light">Back</a>
                             </div>
                             <div class="card-body">
                                 @include('funds.show_fields_ext')
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
                                @include('funds.performance_table')
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
                                <strong>Accounts<strong>
                            </div>
                            <div class="card-body">
                                @include('funds.accounts_table')
                                <div class="pull-right mr-3">
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
          </div>
    </div>
@endsection
