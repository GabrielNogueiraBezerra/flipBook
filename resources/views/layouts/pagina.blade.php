<html>
    <head>
        @include('include.head')
    </head>
    <body>
        @include('include.navbar')
        @include('include.search')
        <!-- ##### Main Content Wrapper Start ##### -->
        <div class="main-content-wrapper d-flex clearfix">
            @include('include.sidebar')

            <div class="products-catagories-area clearfix">
                @yield('content')
            </div>
        </div>
        @include('include.footer')
        @include('include.scripts')
    </body>
</html>