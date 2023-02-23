<style>
    .nopadding {
   padding-left: 4px !important;
   padding-right: 4px !important;
}
</style>

<div class="container">
    <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
         <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
            <h3 class="h5 fw-700 mb-0">
                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Inspired by Your Choice') }}</span>
            </h3>
        </div>
        <div class="row">
            @foreach($product_suggest as $product)
                <div class="col-md-2 nopadding md-50 my-2">
                    <div class="aiz-card-box border border-light rounded hov-shadow-md has-transition">
                        <div class="position-relative">
                            <a href="{{ route('product', $product->slug) }}" class="d-block">
                                <img
                                    class="img-fit lazyload mx-auto h-140px h-md-210px"
                                    src=""
                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    alt=""
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                            </a>
                            <div class="absolute-top-right aiz-p-hov-icon">
                                <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                                    <i class="las la-sync"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                                    <i class="las la-sync"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                                    <i class="las la-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-md-3 p-2 text-px-2 py-4 px-md-4 py-md-3 left">
                            
                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{  $product->name  }}</a>
                            </h3>
                            <div class="fs-15">
                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                    <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product->id) }}</del>
                                @endif
                                <span class="fw-700 text-primary">{{ home_discounted_base_price($product->id) }}</span>
                            </div>
                            <div class="rating rating-sm mt-1">
                                {{ renderStarRating($product->rating) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="more_product_suggest" class="row"></div>
            <div class="btn btn-primary" id="load_more" style="margin: 0 auto;">Load More</div>
        </div>
        
    </div>
</div>