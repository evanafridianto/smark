   @extends('auth.layouts.main')
   @section('content')
       <header id="auth-header" class="auth-header">
           <h1>
               <span style="color: #ED3237">S</span>MARK
           </h1>
           <p> Sistem Marketing Audit</p>
           {{--  <h4>Log In Admin</h4>  --}}
       </header><!-- form -->
       <form class="auth-form" method="POST" action="{{ route('login') }}">
           @csrf
           <div class="form-group">
               <label for="email">Email</label>
               <input type="text" id="email" name="email" class="form-control" placeholder="Email" autofocus="">
               @error('email')
                   <small class="text-danger">{{ $message }}</small>
               @enderror
           </div><!-- /.form-group -->
           <!-- .form-group -->
           <div class="form-group">
               <label for="password">Password</label>
               <input type="password" id="password" name="password" class="form-control" placeholder="Password">
               @error('password')
                   <small class="text-danger">{{ $message }}</small>
               @enderror
           </div><!-- /.form-group -->
           <!-- .form-group -->
           <div class="form-group">
               <div class="text-center pt-3">
                   <div class="custom-control custom-control-inline custom-checkbox">
                       <input type="checkbox" class="custom-control-input" id="remember_me" name="remember" />
                       <label class="custom-control-label" for="remember_me">Remember me?</label>
                   </div> <span class="mx-2">·</span>
                   <a href="{{ route('password.request') }}" class="link-text">Lupa Password?</a>
               </div>
               {{--    --}}
           </div><!-- /.form-group -->
           <div class="form-group">
               <button class="btn btn-lg btn-info btn-block" type="submit">Log In</button>
           </div><!-- /.form-group -->
       </form>
   @endsection
