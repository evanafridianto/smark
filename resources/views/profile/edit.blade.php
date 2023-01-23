@extends('layouts.main')
@section('content')
    <div class="d-xl-none">
        <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
    </div><!-- .card -->
    <div id="base-style" class="card">
        <!-- .card-body -->
        <div class="card-body">
            <!-- .form -->
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <!-- .fieldset -->
                <fieldset>
                    <legend>Update Profile</legend> <!-- .form-group -->
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="Nama"
                            value="{{ old('name', $user->name) }}" autofocus autocomplete="name" />
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div><!-- /.form-group -->
                    <!-- .form-group -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control form-control-lg" name="email"
                            value="{{ old('email', $user->email) }}" autocomplete="email" placeholder="Email" />
                        @error('email')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div><!-- /.form-group -->
                    <button type="submit" class="btn btn-info ">Save</button>
                </fieldset><!-- /.fieldset -->
            </form><!-- /.form -->
        </div><!-- /.card-body -->
        <!-- .card-body -->
        <div class="card-body border-top">
            <!-- .form -->
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <!-- .fieldset -->
                <fieldset>
                    <legend>Update Password</legend> <!-- .form-group -->
                    <div class="form-group">
                        <label>Password saat ini</label>
                        <input type="password" class="form-control form-control-lg" name="current_password"
                            placeholder="Password saat ini" autocomplete="current-password" id="curent_password" />
                        @error('current_password', 'updatePassword')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div><!-- /.form-group -->
                    <!-- .form-group -->
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password"
                            placeholder="Password Baru" autocomplete="new-password" />
                        @error('password', 'updatePassword')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div><!-- /.form-group -->
                    <!-- .form-group -->
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" class="form-control form-control-lg" name="password_confirmation"
                            id="password_confirmation" placeholder="Konfirmasi Password Baru" autocomplete="new-password" />
                        @error('password_confirmation', 'updatePassword')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div><!-- /.form-group -->
                    <button type="submit" class="btn btn-info ">Save</button>
                </fieldset><!-- /.fieldset -->
            </form><!-- /.form -->
        </div><!-- /.card-body -->
    </div><!-- /.card -->
    <script>
        @if (session('status') === 'profile-updated')
            bootprompt.alert({
                message: "Profile updated!",
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
        @if (session('status') === 'password-updated')
            bootprompt.alert({
                message: "Password updated!",
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
