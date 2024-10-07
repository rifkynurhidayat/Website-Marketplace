@extends('layouts.app')
@section('title')
    Store Cart Page
@endsection
@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-up" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/index.html" class="text-decoration-none">Home</a>
                                </li>
                                <li class="breadcrumb-item" active>Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name &amp; Seller</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0; @endphp
                                @foreach ($cart as $keranjang)
                                    <tr>
                                        <td style="width: 15%">
                                            @if ($keranjang->product->galleries)
                                                <img src="{{ Storage::url($keranjang->product->galleries->first()->photo) }}"
                                                    alt="" class="w-100 cart-image" />
                                            @endif
                                        </td>
                                        <td style="width: 30%">
                                            {{ $keranjang->product->name }}
                                            <div class="product-subtitle">by {{ $keranjang->user->store_name }}</div>
                                        </td>
                                        <td style="width: 30%">
                                            <div class="product-title">Rp. {{ number_format($keranjang->product->price) }}
                                            </div>
                                            <div class="product-subtitle">Rupiah</div>
                                        </td>
                                        <td style="width: 30%">
                                            <div class="product-title">{{ $keranjang->stok_buy }}
                                            </div>
                                        </td>

                                        <td style="width: 20%">
                                            <form action="{{ route('cart-delete', $keranjang->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-remove-cart">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $totalPrice += $keranjang->product->price * $keranjang->stok_buy; 
                                            
                                    @endphp

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-md-12">
                        <hr />
                        <h2 class="mb-4">Shipping Details</h2>
                    </div>
                </div>

                <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Address 1</label>
                                <input type="text" class="form-control" name="addres_one" id="addres_one"
                                    value="{{ $user->addres_one }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Address 2</label>
                                <input type="text" class="form-control" name="addres_two" id="addres_two"
                                    value="{{ $user->addres_two }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Provinces</label>
                                <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces"
                                    v-model="provinces_id" required>
                                    <option :value="province.id" v-for="province in provinces">@{{ province.name }} 
                                    </option>
                                </select>
                                <select name="" class="form-control" v-else id=""></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regencies_id">City</label>
                                <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies"
                                    v-model="regencies_id" required>
                                    <option :value="regency.id" v-for="regency in regencies">@{{ regency.name }}
                                    </option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Postal Code</label>
                                <input type="text" class="form-control" name="zip_code" id="zip_code"
                                    value="{{ $user->zip_code }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" id="country"
                                    value="{{ $user->country }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number"
                                    value="{{ $user->phone_number }}" />
                            </div>
                        </div>
                    </div>

                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-md-12">
                            <h2 class="mb-2">Payment Informations</h2>
                        </div>
                    </div>

                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-4 col-md-2">
                            <div class="product-title">Rp.10.000</div>
                            <div class="product-subtitle">Country Tax</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">Rp.10.000</div>
                            <div class="product-subtitle">Product Insurance</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title">Rp.10.000</div>
                            <div class="product-subtitle">Ship To Jakarta</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title">Rp. {{ number_format($totalPrice) }}</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-8 col-md-3">
                            <button type="submit" class="btn btn-success mt-4 px-4 btn-block">Checkout Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    @endsection

    @push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
        <script src="https://unpkg.com/vue-toasted"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            var locations = new Vue({
                el: "#locations",
                mounted() {
                    AOS.init();
                    this.getProvincesData();

                },
                data: {
                    provinces: null,
                    regencies: null,
                    provinces_id: null,
                    regencies_id: null
                },
                methods: {
                    getProvincesData() {
                        var self = this;
                        axios.get('{{ route('api-provinces') }}')
                            .then(function(response) {
                                self.provinces = response.data;
                            })
                    },
                    getRegenciesData() {
                        var self = this;
                        axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                            .then(function(response) {
                                self.regencies = response.data;
                            })
                    },
                },
                watch: {
                    provinces_id: function(val, oldVal) {
                        this.regencies_id = null;
                        this.getRegenciesData();
                    }
                }
            });
        </script>

@if (session('succes'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif
    @endpush
