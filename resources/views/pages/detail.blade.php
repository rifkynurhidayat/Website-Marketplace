@extends('layouts.app')
@section('title')
    Store Detail Page
@endsection
@section('content')
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-up" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="route('pages.home')" class="text-decoration-none">Home</a>
                                </li>
                                <li class="breadcrumb-item" active>Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" alt=""
                                class="w-100 main-image" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" alt="" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container mt-3" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->name }}</h1>
                            <div class="owner">By: {{ $product->user->store_name }}</div>
                            <div class="price">Rp. {{ number_format($product->price) }}</div>
                            <div class="price">Stok : {{ $product->stok }}</div>
                        </div>

                    </div>
                </div>
            </section>
            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-l2 col-lg-8">
                            <h5>Deskripsi Produk</h5>
                            <p class="lead text-primary font-weight-bold mb-3">{!! $product->description !!}</p>
                        </div>
                    </div>
                </div>
            </section>
            <div class="col-lg-12" data-aos="zoom-in">
                <div class="container">
                    @auth
                        <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-l2 col-lg-12 mb-3">
                                    <label for="stok">Jumlah yang dibeli</label>
                                    <input type="number" name="stok_buy" class="form-control" required>
                                </div>
                            </div>
                            <button class="btn btn-success px-4 text-white btn-block mb-3">
                                Add to Cart</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">Login</a>
                    @endauth
                </div>
            </div>


            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-3">
                            <h5>Customer Review(3)</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <img src="/images/customer-riview-1.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mt-1">Hazza rizky</h5>
                                        I thought it was not good for living room. I really happy to decided buy this
                                        product last week now feels like homey.
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/customer-riview-2.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mt-1">Anna Sukkirata </h5>
                                        Color is great with the minimalist concept. Even I thought it was
                                        made by Cactus industry. I do really satisfied with this.
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/customer-riview-3.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mt-1">Dakimu Wangi</h5>
                                        When I saw at first, it was really awesome to have with.
                                        Just let me know if there is another upcoming product like this.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->galleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ Storage::url($gallery->photo) }}",
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>

@if (session('warning'))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Peringatan',
        text: '{{ session('warning') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif


@endpush
