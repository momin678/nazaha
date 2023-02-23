
     {{-- Disable Top 10 Brands --}}
    <div class="container"> 
        <div class="col-lg-12">
            <div class="d-flex mb-5 align-items-baseline border-bottom">
                <h3 class="h5 fw-700 mb-0">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 12 Brands') }}</span>
                </h3>
            </div>
            <div class="row gutters-6">
                @php 
                    $brands = \App\Models\Brand::inRandomOrder()->limit(20)->get();
                    $totalBrand = 0;
                @endphp
                @foreach($brands as $brand)
                @if($totalBrand == 12)  @break @endif
                    @php $product = \App\Models\Product::where('brand_id',$brand->id)->select('thumbnail_img')->first(); @endphp
                        @if($product)
                        @php  $totalBrand += 1; @endphp
                            <div class="col-sm-2 col-mb-4 mb-4 " style="padding-left:5px; padding-right:5px;">
                                <a href="{{ route('products.brand', $brand->slug) }}" class="bg-white border d-block text-reset rounded hov-shadow-md mb-3 mbl-max-height-160 mbl-min-height-160"  style="padding: 5px 5px 0 5px !IMPORTANT;min-height: 280px;max-height: 280px;">
                                    <div class="row align-items-center no-gutters" style=" background: #fff;padding-top: 30px;">
                                        <div class="col-12 text-center" style=" position: absolute; z-index: 98; right: 0px; top:-18px;">
                                            <img
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($brand->logo) }}"
                                                alt="{{ $brand->getTranslation('name') }}"
                                                class="img-fluid img lazyload h-50px"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';" style="border: 1px solid #e2e5ec;max-width: 50px;"
                                            >
                                        </div>
                                        <div class="col-12" style="position: relative;  z-index: 97; ">
                                            <img
                                                class="img-fit lazyload mx-auto mbl-h-100 mbl-height-83"
                                                src=""
                                                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                alt=""
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                style="height:207px"
                                            >
                                        </div>
                                    </div>
                                    <div class="text-center" style="padding: 10px 0;" id="max-cerecter-11">{{$brand->name}}</div>
                                </a>
                            </div>
                        @endif
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('brands.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md mb-3">{{ translate('View All Brands') }}</a>
            </div>
        </div>
    </div>