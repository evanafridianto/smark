@extends('auth.layouts.main')
@section('content')
    <header id="auth-header" class="auth-header">
        <h1>
            <span style="color: #ED3237">S</span>MARK
            </svg> <span class="sr-only">Sign In</span>
        </h1>
        <p> Sistem Marketing Audit
        </p>
    </header><!-- form -->
    <div class="auth-form">
        <div class="form-group">
            <p class="mb-4">Masukkan email registrasi, sistem akan mengirim link reset password ke email Anda! </p>
        </div><!-- /.form-group -->
        <!-- .form-group -->

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                    placeholder="Email" autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-block d-md-inline-block mb-2">
                <button class="btn btn-block btn-info" type="submit">Kirim email reset password</button>
            </div>
            <div class="d-block d-md-inline-block">
                <a href="{{ route('login') }}" class="btn btn-block btn-light">Log In</a>
            </div>
        </form>
    </div><!-- /.auth-form -->
    <script>
        @if (session('status'))
            bootprompt.alert({
                message: "Email link reset password berhasil dikirim!",
                title: "Success!",
                size: "small",
                buttons: {
                    ok: {
                        label: "OK",
                        className: "btn-info",
                    },
                },
            });
        @endif
    </script>
@endsection
