@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All Collection')}}</h1>
        </div>
    </div>
</div>
    <div class="row">
    	<div class="col-md-8">
            <form class="form form-horizontal mar-top" action="{{route('collection.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
                @csrf
                <div class="card">
                    <div class="card-body">
    					<div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('Collection Title')}} <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Banner')}} <small>(600x600)</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="banner" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                <small class="text-muted">{{translate('These images are visible in product Banner. Use 600x600 sizes images.')}}</small>
                            </div>
                        </div>
                        <div class="btn-group text-right" role="group" aria-label="Second group">
                            <button type="submit" name="button" class="btn btn-success">{{ translate('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
    	</div>
    </div>
    
    <div id="accordion">
        @foreach($all_collections as $key=> $all_collection)
          <div class="card">
            <div class="card-header" id="headingTwo{{$all_collection->id}}">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo{{$all_collection->id}}" 
                aria-expanded="false" aria-controls="collapseTwo{{$all_collection->id}}">
                  Section {{$key+1}}
                </button>
              </h5>
            </div>
            <div id="collapseTwo{{$all_collection->id}}" class="collapse" aria-labelledby="headingTwo{{$all_collection->id}}" data-parent="#accordion">
              <table class="table aiz-table mb-0">
	            <thead>
	                <tr>
	                    <th>{{translate('Collection Title')}}</th>
	                    <th>{{translate('Banner')}}</th>
	                    <th class="text-right"> Option </th>
	                </tr>
	            </thead>
	            <tbody>
	                <tr>
	                    <td>{{ $all_collection->title }}</td>
	                    <td><img src="{{ uploaded_asset($all_collection->banner) }}" class="h-50px"></td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('collection.edit', $all_collection->id )}}" 
                            title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" 
                            data-href="{{route('collection.destroy', $all_collection->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
	                </tr>
	            </tbody>
	           </table>
                <div class="card-body">
    				<form action="{{ route('collection.section.update', $all_collection->id) }}" method="POST" enctype="multipart/form-data">
    					@csrf
    					<div class="form-group">
    						<label>{{ translate('Name, Banner, Links, Category') }}</label>
        						<div class="best_collection_secetion{{$all_collection->id}}">
                    	           @foreach($all_product_collectoins as $all_product_collectoin)
                	                @if($all_product_collectoin->best_collections_id ==  $all_collection->id)
                					<div class="row gutters-5 border p-2">
        								<div class="col-md-6">
        									<div class="form-group">
        									    <label> Name</label>
        									   <input type="text" class="form-control" placeholder="Name" name="best_callection_name[]" value="{{$all_product_collectoin->best_callection_name}}">
        									</div>
        								</div>
        								<div class="col-md-6">
        									<div class="form-group">
        									    <label>Description</label>
        										<input type="text" class="form-control" placeholder="Short Description" name="best_callection_description[]" value="{{$all_product_collectoin->best_callection_description}}">
        									</div>
        								</div>
        								<div class="col-md-6">
        									<div class="form-group">
        									    <label>Product</label>
        										<select class="form-control aiz-selectpicker" name="best_callection_product_id[]" data-live-search="true">
        											<option value="">Nothing Selected</option>
        										    @foreach ($all_product as $product)
        												<option value="{{ $product->id }}" @if($all_product_collectoin->best_callection_product_id == $product->id) selected @endif>{{ $product->name }}</option>
        											@endforeach
        			                            </select>
        									</div>
        								</div>
        								<div class="col-md-6">
        									<div class="form-group">
        									    <label>Categoty <small class="text-danger">( Caregery must be select )</small></label>
        										<select class="form-control aiz-selectpicker" name="best_callection_category[]" data-live-search="true" required>
        											<option value="">Nothing Selected</option>
        										    @foreach ($all_category as $category)
        												<option value="{{ $category->id }}" @if($all_product_collectoin->best_callection_category == $category->id) selected @endif>{{ $category->name }}</option>
        											@endforeach
        			                            </select>
        									</div>
        								</div>
        								<div class="col-md-6">
        									<div class="form-group">
        									    <label>URL</label>
        										<input type="text" class="form-control" placeholder="http://" name="best_callection_links[]" value="{{ $all_product_collectoin->best_callection_links}}">
        									</div>
        								</div>
            							<div class="col-md-5">
            								<div class="form-group">
    									    <label>Banner</label>
            									<div class="input-group" data-toggle="aizuploader" data-type="image">
            										<div class="input-group-prepend">
            											<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
            										</div>
            										<div class="form-control file-amount">{{ translate('Choose File') }}</div>
            										<input type="hidden" name="best_callection_banner[]" class="selected-files" value="{{$all_product_collectoin->best_callection_banner}}">
            									</div>
            									<div class="file-preview box sm">
            									</div>
            								</div>
                						</div>
        								<div class="col-md-auto">
        									<div class="form-group">
        										<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
        											<i class="las la-times"></i>
        										</button>
        									</div>
        								</div>
        							</div>
                	                @endif
                    	           @endforeach
        						</div>
        					<button
        						type="button"
        						class="btn btn-soft-secondary btn-sm mt-2"
        						data-toggle="add-more"
        						data-content='
        						<div class="row gutters-5 border p-2 mt-2">
        							<div class="col-md-6">
        								<div class="form-group">
    									    <label>Name</label>
        									<input type="text" class="form-control" placeholder="Title" name="best_callection_name[]">
        								</div>
        							</div>
        							<div class="col-md-6">
        								<div class="form-group">
    									    <label>Description</label>
        									<input type="text" class="form-control" placeholder="Short Description" name="best_callection_description[]">
        								</div>
        							</div>
    								<div class="col-md-6">
    									<div class="form-group">
    									    <label>Product</label>
    										<select class="form-control aiz-selectpicker" name="best_callection_product_id[]" data-live-search="true">
    											<option value="">Nothing Selected</option>
        										@foreach ($all_product as $product)
    												<option value="{{ $product->id }}">{{ $product->name }}</option>
    											@endforeach
    			                            </select>
    									</div>
    								</div>
        							<div class="col-md-6">
        								<div class="form-group">
    									    <label>Category <small class="text-danger">( Caregery must be select )</small></label>
        									<select class="form-control aiz-selectpicker" name="best_callection_category[]" data-live-search="true" required>
        									    <option value="">Nothing Selected</option>
        										@foreach ($all_category as $category)
    												<option value="{{ $category->id }}">{{ $category->name }}</option>
    											@endforeach
        									</select>
        								</div>
        							</div>
        							<div class="col-md-6">
        								<div class="form-group">
    									    <label>URL</label>
        									<input type="text" class="form-control" placeholder="http://" name="best_callection_links[]">
        								</div>
        							</div>
        							<div class="col-md-5">
        								<div class="form-group">
    									    <label>Banner</label>
        									<div class="input-group" data-toggle="aizuploader" data-type="image">
        										<div class="input-group-prepend">
        											<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
        										</div>
        										<div class="form-control file-amount">{{ translate('Choose File') }}</div>
        										<input type="hidden" name="best_callection_banner[]" class="selected-files">
        									</div>
        									<div class="file-preview box sm">
        									</div>
        								</div>
        							</div>
        							<div class="col-md-auto">
        								<div class="form-group">
        									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
        										<i class="las la-times"></i>
        									</button>
        								</div>
        							</div>
        						</div>'
        						data-target=".best_collection_secetion{{$all_collection->id}}">
        						{{ translate('Add New') }}
        					</button>
    					</div>
    					<div class="text-right">
    						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
    					</div>
    				</form>
    		    </div>
             </div>
          </div>
        @endforeach
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection