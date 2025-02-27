@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('scheduledJobs.index') }}">Scheduled Job</a>
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
                                  <a href="{{ route('scheduledJobs.index') }}" class="btn btn-light">Back</a>
                                  <a href="{{ route('scheduledJobs.preview', ['id' => $scheduledJob->id, 'asOf' => new Carbon\Carbon()]) }}" class="btn btn-ghost-success"><i class="fa fa-play"></i></a>
                             </div>
                             <div class="card-body">
                                 @include('scheduled_jobs.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
