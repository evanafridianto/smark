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
            <p class="mb-4">Masukkan email registrasi dan password baru Anda! </p>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}"
                    class="form-control" placeholder="Email" autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Konfirmasi Password" />
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-block d-md-inline-block mb-2">
                <button class="btn btn-block btn-info" type="submit">Reset password</button>
            </div>
            <div class="d-block d-md-inline-block">
                <a href="{{ route('login') }}" class="btn btn-block btn-light">Log In</a>
            </div>
        </form>
    </div><!-- /.auth-form -->
    <script>
        @if (session('status'))
            bootprompt.alert({
                message: "Password berhasil diupdate!",
                title: "Success!",
                size: "small",
                buttons: {
                    ok: {
                        label: "OK",
                        className: "btn-info",
                    },
                },
                callback: (result) => {
                    window.location.href = "{{ route('login') }}";
                }
            });
        @endif
    </script>
@endsection
