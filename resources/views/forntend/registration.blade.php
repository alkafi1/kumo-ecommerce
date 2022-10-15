@extends('forntend.master')

@section('content')
    <!-- ======================= Top Breadcrubms ======================== -->
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Top Breadcrubms ======================== -->

    <!-- ======================= Login Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-between">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-auto">
                    <div class="mb-3">
                        <h3>Register</h3>
                    </div>
                    <form action="{{ route('customer.reg.store') }}" method="POST" class="border p-3 rounded">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Full Name *</label>
                                <input type="text" class="form-control" name="name" placeholder="Full Name">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="text" class="form-control" name="email" placeholder="Email*">
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Password *</label>
                                <input type="password" class="form-control" name="password" placeholder="Password*">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm Password *</label>
                                <input type="password" class="form-control" name="con_password" placeholder="Confirm Password*">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create An Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Login End ======================== -->
@endsection