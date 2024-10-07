@extends('layouts.admin-dashboard')
@section('title')
    Edit Data Pages
@endsection
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">User</h2>
                <p class="dashboard-subtitle">Edit Data User</p>
                <div class="dashboard-content">
                    <div class="row">
                        <div class="col-md-12">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('user.update', $item->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Nama User</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="{{ $item->email }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password">
                                                    <p class="text-muted">Kosongkan jika tidak ingin mengganti password</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Roles</label>
                                                    <select name="roles" id="" class="form-control">
                                                        <option value="ADMIN" value="{{$item->roles  }}">Admin</option>
                                                        <option value="USER">User</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-success">Save Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
