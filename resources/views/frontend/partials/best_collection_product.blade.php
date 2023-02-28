@if(count($section) > 0)
<section class="mb-4 mt-4">
    <div class="container">
        <div class="gutters-10">
            <div class="col-lg-12 mbl-nopadding">
                <div class="d-flex mb-3 align-items-baseline border-bottom">
                    
                </div>
                <div class="row gutters-5">
                @foreach($section as $section)
                    <?php 
                        $best_section_products =\App\Models\BestCollection::where("best_collections_id", $section->id)->limit(4)->orderBy('id', 'DESC')->get();
                        $product_count = count($best_section_products);
                    ?>
                    @if(count($best_section_products) > 0)
                        <div class="col-md-3 col-lg-3 col-12" id="ctgbox">
                            <div class= "col-md-12 bg-white p-3">
                            <div>
                            <p class="h5 fw-700 mb-0 pt-1 pb-2"style="display: block;/* or inline-block */ text-overflow: ellipsis; word-wrap: break-word;  overflow: hidden;  max-height: 2em; line-height: 1.8em;">{{$section->title}}</p>
                            </div>
                            <div class="row">
                                @foreach($best_section_products as $best_section_product)
                                <div class="@if($product_count == 1 ) col-md-12 @elseif($product_count == 2)col-md-12 col-6 @else col-6 @endif ">
                                    @foreach($all_categoty as $category)
                                        @if($best_section_product->best_callection_category == $category->id)
                                            <a href="{{route('products.category', $category->slug)}}" class="d-block" @if($product_count == 1 ) style="height: 250px; max-height: 250px; " @endif>
                                                <img
                                                    class="img-fit lazyload mx-auto @if($product_count >= 2)h-114px @endif "
                                                    @if($best_section_product->best_callection_product_thumbnail_img != null)
                                                        data-src="{{ uploaded_asset($best_section_product->best_callection_product_thumbnail_img) }}"
                                                    @elseif($best_section_product->best_callection_banner)
                                                        data-src="{{ uploaded_asset($best_section_product->best_callection_banner) }}"
                                                    @else
                                                        data-src="{{ uploaded_asset($category->banner) }}"
                                                    @endif
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                               
                                                >
                                            </a>
                                        <a href="{{route('products.category', $category->slug)}}" class="fs-12 text-truncate-2 text-reset lh-1-4 mb-0 pt-1 pb-2"style="display: block;/* or inline-block */text-overflow: ellipsis;word-wrap: break-word; overflow: hidden;max-height: 1.8em;">{{$category->name}}</a>
                                        @endif
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            <!--<a href="">See more</a>-->
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            </div>
        </div>
    </div>
</section>
 @endif