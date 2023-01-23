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
            <p class="mb-4">Sistem telah mengirim link ke email registrasi untuk memverifikasi akun anda! </p>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="d-block d-md-inline-block mb-2">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button class="btn btn-lg btn-block btn-info" type="submit">Kirim ulang email verifikasi</button>
            </form>
        </div>
        <div class="d-block d-md-inline-block">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-lg btn-block btn-light">Log Out</button>
            </form>
        </div>
    </div><!-- /.auth-form -->
    <script>
        @if (session('status') == 'verification-link-sent')
            bootprompt.alert({
                message: "Link verifikasi baru berhasil dikirim!",
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
