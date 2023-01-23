<!DOCTYPE html>
<html lang="en">
@section('head')
    @include('auth.layouts.head')
@show

<body>
    <main class="auth">
        @yield('content')
        @section('footer')
            @include('auth.layouts.footer')
        @show
    </main><!-- /.auth -->
</body>
@section('script')
    @include('auth.layouts.script')
@show

</html>
