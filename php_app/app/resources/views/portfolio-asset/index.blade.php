@extends('layouts.app')

@section('template_title')
    Portfolio Asset
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Portfolio Asset') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('portfolio-assets.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Portfolio Id</th>
										<th>Asset Id</th>
										<th>Shares</th>
										<th>Created</th>
										<th>Updated</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($portfolioAssets as $portfolioAsset)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $portfolioAsset->portfolio_id }}</td>
											<td>{{ $portfolioAsset->asset_id }}</td>
											<td>{{ $portfolioAsset->shares }}</td>
											<td>{{ $portfolioAsset->created }}</td>
											<td>{{ $portfolioAsset->updated }}</td>

                                            <td>
                                                <form action="{{ route('portfolio-assets.destroy',$portfolioAsset->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('portfolio-assets.show',$portfolioAsset->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('portfolio-assets.edit',$portfolioAsset->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $portfolioAssets->links() !!}
            </div>
        </div>
    </div>
@endsection
