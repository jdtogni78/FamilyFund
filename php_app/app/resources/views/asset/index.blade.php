@extends('layouts.app')

@section('template_title')
    Asset
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Asset') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('assets.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Name</th>
										<th>Type</th>
										<th>Source Feed</th>
										<th>Feed Id</th>
										<th>Last Price</th>
										<th>Last Price Date</th>
										<th>Deactivated</th>
										<th>Created</th>
										<th>Updated</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assets as $asset)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $asset->name }}</td>
											<td>{{ $asset->type }}</td>
											<td>{{ $asset->source_feed }}</td>
											<td>{{ $asset->feed_id }}</td>
											<td>{{ $asset->last_price }}</td>
											<td>{{ $asset->last_price_date }}</td>
											<td>{{ $asset->deactivated }}</td>
											<td>{{ $asset->created }}</td>
											<td>{{ $asset->updated }}</td>

                                            <td>
                                                <form action="{{ route('assets.destroy',$asset->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('assets.show',$asset->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('assets.edit',$asset->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $assets->links() !!}
            </div>
        </div>
    </div>
@endsection
