@extends('layouts.dashboard')
@section('title')
    Store Dashboard Account
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Account</h2>
                <p class="dashboard-subtitle">Update your current profile</p>
                <div class="dashboard-content">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('dashboard-account-redirect', 'dashboard-account') }}" id="locations"
                                method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ $user->name }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        value="{{ $user->email }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="addres_one">Address 1</label>
                                                    <input type="text" class="form-control" name="addres_one"
                                                        id="addres_one" value="{{ $user->addres_one }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="addres_two">Address 2</label>
                                                    <input type="text" class="form-control" name="addres_two"
                                                        id="addres_two" value="{{ $user->addres_two }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="provinces_id">Provinces</label>
                                                    <select name="provinces_id" id="provinces_id" class="form-control"
                                                        v-if="provinces" v-model="provinces_id" required>
                                                        <option :value="province.id" v-for="province in provinces">
                                                            @{{ province.name }}</option>
                                                    </select>
                                                    <select name="" class="form-control" v-else
                                                        id=""></select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="regencies_id">City</label>
                                                    <select name="regencies_id" id="regencies_id" class="form-control"
                                                        v-if="regencies" v-model="regencies_id" required>
                                                        <option :value="regency.id" v-for="regency in regencies">
                                                            @{{ regency.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="postal_code">Postal Code</label>
                                                    <input type="text" class="form-control" name="zip_code"
                                                        id="zip_code" value="{{ $user->zip_code }}" />
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
                                                    <label for="mobile">Mobile</label>
                                                    <input type="text" class="form-control" name="phone_number"
                                                        id="phone_number" value="{{ $user->phone_number }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-right">
                                                <button class="btn btn-success px-3">Save now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
@endpush
