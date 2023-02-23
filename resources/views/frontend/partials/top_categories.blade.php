
     {{-- Top 10 categories and Brands --}}
    <section class="mb-4 mt-4">
        <div class="container">
            <div class="gutters-10">
                @if (get_setting('top10_categories') != null)
                    <div class="col-lg-12 mbl-nopadding">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Categories') }}</span>
                            </h3>
  
                        </div>
                        <div class="row gutters-5">
                           @php $top10_categories = json_decode(get_setting('top10_categories')); @endphp
                            @foreach ($top10_categories as $key => $value)
                                @php $category = \App\Models\Category::find($value); @endphp
                                @if ($category != null)
                                    <div class="top-cetagory-index mbl-nopadding" id="ctgbox">
                                        <a href="{{ route('products.category', $category->slug) }}" class="bg-white border d-block text-reset hov-shadow-md mbl-nomargin-bottom" style="height: 100%;">
                                            <div class="align-items-center no-gutters"style="">
                                                <div class="col-12 text-center"style="">
                                                    <img
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($category->banner) }}"
                                                        alt="{{ $category->getTranslation('name') }}"
                                                        class="img-fluid img lazyload"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                                    >
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-truncat-2 fs-13 text-center"style="padding: 20px 0 5px;">{{ $category->getTranslation('name') }}</div>
                                                </div>
                                               
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach 
                            
                        </div>
                    </div>
                @endif
				
            </div>
        </div>
    </section>
