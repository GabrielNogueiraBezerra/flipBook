<html>
    <head>
        @include('include.head')
    </head>
    <body>
        @include('include.navbar')
        @include('include.search')
        <!-- ##### Main Content Wrapper Start ##### -->
        <div class="{{@ explode('/', Request::url())[3] != 'register' ? 'main-content-wrapper d-flex clearfix' : '' }}">
            @if(@explode('/', Request::url())[3] != 'register')
            @include('include.sidebar')
            @endif

            <div class="products-catagories-area clearfix">
                @yield('content')
            </div>
        </div>
        @include('include.footer')
        @include('include.scripts')
    </body>
</html>