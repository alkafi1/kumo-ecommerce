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
    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-between">
            
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-auto ">
                    <div class="mb-3">
                        <h3>Password Reset Form</h3>
                    </div>
                    <form class="border p-3 rounded" action="{{ route('customer.pass.reset.req') }}" method="POST">	
                        @csrf			
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="text" name="email" class="form-control" placeholder="Email*">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Login End ======================== -->
@endsection