@extends('layouts.app')
@section('title')
    Store Category Page
@endsection
@section('content')
    <div class="page-content page-home">
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5>All Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementCategory = 0 @endphp
                    @forelse ($categories as $category)
                    <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{  $incrementCategory += 100}}">
                        <a href="{{ route('categories.detail', $category->slug) }}" class="component-categories d-block">
                            <div class="categories-image">
                                <img src="{{ Storage::url($category->photo) }}" class="w-100" alt="" />
                            </div>
                            <div class="categories-text">{{ $category->name }}</div>
                        </a>
                    </div>
                    @empty
                        <div class="col-md-12 text-center py-5">
                            <h6 class="text-muted">Category not Found</h6>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="store-new-product">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5 class="mb-4">New Products</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementProduct = 0 @endphp
                    @forelse ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct += 100 }}">
                        <a href="{{ route('details', $product->slug) }}" class="component-products d-block">
                            <div class="products-thumbnail">
                                <div class="products-image" 
                                style="
                                @if ($product->galleries->isNotEmpty())
                                    background-image: url('{{ Storage::url($product->galleries->first()->photo) }}');
                                @else 
                                    background-color: #eee;
                                @endif
                                "></div>
                            </div>
                            <div class="products-text">{{ $product->name }}</div>
                            <div class="products-price">Rp. {{ number_format($product->price) }}</div>
                        </a>
                    </div>
                    @empty
                        <div class="col-md-12 text-center py-5">
                            <h6 class="text-muted">Product not Found</h6>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
