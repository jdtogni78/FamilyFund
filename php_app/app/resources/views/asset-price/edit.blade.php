@extends('layouts.app')

@section('template_title')
    Update Asset Price
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Asset Price</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('asset-prices.update', $assetPrice->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('asset-price.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
