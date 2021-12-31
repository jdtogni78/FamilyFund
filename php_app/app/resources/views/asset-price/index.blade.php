@extends('layouts.app')

@section('template_title')
    Asset Price
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Asset Price') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('asset-prices.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Asset Id</th>
										<th>Price</th>
										<th>Created</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assetPrices as $assetPrice)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $assetPrice->asset_id }}</td>
											<td>{{ $assetPrice->price }}</td>
											<td>{{ $assetPrice->created }}</td>

                                            <td>
                                                <form action="{{ route('asset-prices.destroy',$assetPrice->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('asset-prices.show',$assetPrice->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('asset-prices.edit',$assetPrice->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $assetPrices->links() !!}
            </div>
        </div>
    </div>
@endsection
