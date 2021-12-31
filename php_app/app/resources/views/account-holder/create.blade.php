@extends('layouts.app')

@section('template_title')
    Create Account Holder
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Account Holder</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('account-holders.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('account-holder.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
