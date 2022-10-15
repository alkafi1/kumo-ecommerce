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
            @if(session('emailverify'))
                <div class="aler alert-warning mt-2">{{ session('emailverify') }}</div>
            @endif
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-auto ">
                    @if(session('emailverify'))
                        <div class="aler alert-warning mt-2">{{ session('emailverify') }}</div>
                    @endif
                    <div class="mb-3">
                        <h3>Login</h3>
                    </div>
                    <form class="border p-3 rounded" action="{{ route('customer.login.check') }}" method="POST">	
                        @csrf			
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="text" name="email" class="form-control" placeholder="Email*">
                            @if(session('notverify'))
                                <div class="aler alert-warning mt-2">{{ session('notverify') }}</div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" placeholder="Password*">
                        </div>
                        
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="eltio_k2">
                                    <a href="{{ route('customer.pass.reset') }}">Lost Your Password?</a>
                                </div>
                                @if(session('passreset'))
                                    <p class="text-warning">{{ session('passreset') }}</p>	
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Login End ======================== -->
@endsection