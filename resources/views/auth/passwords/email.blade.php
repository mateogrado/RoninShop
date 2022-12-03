@extends('layouts.app2')

@section('content')
<div class="container">
    
        <div class="resetPassTitulo">Restablezca su contraseña</div>

                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="resetPassForm" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="loginCampo">
                            <label for="email" class="">{{ __('E-Mail Address') }}</label>

                           
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="loginCampo">
                            
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            
                        </div>
                    </form>
                </div>

</div>
@endsection
