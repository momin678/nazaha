@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('Add New Product')}}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('products.best-collections') }}" class="btn btn-circle btn-info">
                <span>{{translate('See All Collections')}}</span>
            </a>
        </div>
    </div>
</div>
<div class="">
    <form class="form form-horizontal mar-top" action="{{route('collection.update', $collection->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
        <div class="row gutters-5">
            <div class="col-lg-8">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Select Category')}}</h5>
                    </div>
                    <div class="card-body">
    					<div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('Collection Title')}} <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="title" required value="{{$collection->title}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Banner')}} <small>(600x600)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="banner" value="{{$collection->banner}}" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                <small class="text-muted">{{translate('These images are visible in product Banner. Use 600x600 sizes images.')}}</small>
                            </div>
                        </div>
                    <div class="btn-group" role="group" aria-label="Second group">
                        <button type="submit" name="button" class="btn btn-success">{{ translate('Save') }}</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection('content')