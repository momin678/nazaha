@extends('frontend.layouts.app')

@section('content')
    {{-- Categories , Sliders . Today's deal --}}
    <div class="home-banner-area mb-3">
        <div class="col-lg-2 d-none d-lg-block" style="position: absolute; z-index: 101; left: 80px; height: 370px; background: #fff; padding-right: 0; padding-left: 0;">
            <div class="aiz-category-menu bg-white rounded @if(Route::currentRouteName() == 'home') shadow-sm" @else shadow-lg" id="category-sidebar" @endif>
                <div class="bg-soft-primary d-none d-lg-block rounded-top all-category position-relative text-left">
                </div>
                <ul class="cat_menu" >
                    @foreach (\App\Models\Category::where('level', 0)->get()->take(12) as $key => $category)
                        <li class="liFirst">
                            <a class="text-truncate text-reset d-block">
                                <span class="cat-name">{{ $category->getTranslation('name') }}</span>
                                 <i class="fas fa-chevron-right liFirst1"></i>
                            </a>
                            <ul class="nzh-site-menu-sub" >
                                @foreach (\App\Models\Category::where('level', 1)->get() as $key => $subCategory)
                                    @if ($subCategory->parent_id  == $category->id)
                                        <li class="liSecond">
                                            <a href="{{route('products.category', $subCategory->slug)}}">{{ $subCategory->name }}<i class="fas fa-chevron-right liSecond2"></i></a>
                                            <ul>
                                                @foreach (\App\Models\Category::where('level', 2)->get() as $key => $subSubCategory)
                                                    @if ($subSubCategory->parent_id  == $subCategory->id)
                                                        <li>
                                                            <a href="{{route('products.category', $subSubCategory->slug)}}">{{ $subSubCategory->name }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if (get_setting('home_slider_images') != null)
            <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true" data-infinite="true">
                @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                @foreach ($slider_images as $key => $value)
                    <div class="carousel-box">
                        <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                            <img
                                class="d-block mw-100 lazyload img-fit rounded shadow-sm"
                                src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset($slider_images[$key]) }}"
                                alt="{{ env('APP_NAME')}} promo"
                                height="370"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                            >
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
        
    <!--// home promotion section 1-->
    <div class="mb-1 mt-1">
        <div class="container">
            @if (get_setting('promotion_banner1_image') != null)
                <div class="">
                    <a href="{{ get_setting('promotion_banner1_link') }}" class="d-block text-reset">
                        <img src="{{ uploaded_asset(get_setting('promotion_banner1_image')) }}" class="w-100 mw-100 h-150px h-lg-auto img-fit">
                    </a>
                </div>
            @endif
        </div>
    </div>
    {{-- Banner section 1 --}}
    @if (get_setting('home_banner1_images') != null)
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                @foreach ($banner_1_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif


    {{-- Flash Deal --}}
    @php
        $flash_deal = \App\Models\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">

                <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Flash Sale') }}</span>
                    </h3>
                    <div class="aiz-count-down ml-auto ml-lg-3 align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                    <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
                </div>

                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                    @foreach ($flash_deal->flash_deal_products->take(20) as $key => $flash_deal_product)
                        @php
                            $product = \App\Models\Product::find($flash_deal_product->product_id);
                        @endphp
                        @if ($product != null && $product->published != 0)
                            <div class="carousel-box">
                                @include('frontend.partials.product_box_1',['product' => $product])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--Show top categories-->
    <section id="top_categories">
    </section>
    <style>
    .nopadding {
       padding-left: 4px !important;
       padding-right: 4px !important;
    }
    </style>
    <div class="container mb-4" id="best_collection_product">
       
    </div>
    <!--Show product suggest-->
    <section class="mb-4" id="product_suggest">
    </section>
    <!--show top brand with letast product-->
    <section class="mb-4" id="top_brands"></section>


@endsection

@section('script')
    <script>
       $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
            }
        });
        // top-categories-ajax-request
        window.onload = function(){
            $.ajax({
               url:"{{ route('top-categories-request') }}",
               method:"POST",
               data:{id:'data'},
               success:function(data){
                    $('#top_categories').html(data);
                }
            });
            $.ajax({
               url:"{{ route('best-collection-request') }}",
               method:"POST",
               data:{id:'data'},
               success:function(data){
                    $('#best_collection_product').html(data);
                }
            });
        };
        // product-suggest-ajax-request
            setTimeout(function(){
                $.ajax({
                   url:"{{ route('product-suggest-request') }}",
                   method:"POST",
                   data:{id:'data'},
                   success:function(data){
                        $('#product_suggest').html(data);
                    }
                });
            }, 1000);
        // more-product-suggest-ajax-request
        $("body").on("click", "#load_more", function(){
            $.ajax({
               url:"{{ route('more-product-suggest-request') }}",
               method:"POST",
               data:{id:'data'},
               success:function(data){
                    $('#more_product_suggest').append(data);
                }
            });
        });
        // top brand with letast product of this brand ajax-request
        setTimeout(function(){
            $.ajax({
                url:"{{url('top-brand-request')}}",
                method:"POST",
                data:{id:'data'},
                success:function(data){
                    $('#top_brands').html(data);
                }
            });
        }, 1000);
    </script>
@endsection
