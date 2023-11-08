@extends("auth.layout")
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 15%">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="text-align: center">{{ __('Login') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row" style="margin-top: 2%">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      

                        <div class="form-group row" style="margin-top: 2%">
                            <label for="password" class="col-md-4 col-form-label text-md-right" >{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                     

                        <div class="form-group row mb-0"  style="margin-top: 2%;">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('login') }}
                                </button>
                            </div>
                        </div>

                        <div style="margin-top: 4%;text-align: center">
                            <span >No have account?<a href="register" style="text-decoration: none;">Sign Up</a></span>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
