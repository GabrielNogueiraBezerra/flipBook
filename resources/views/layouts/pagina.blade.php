<html>
    <head>
        @include('include.head')
    </head>
    <body>

        @php
        $url = @explode('/', Request::url())[3]
        @endphp
        @include('include.navbar')
        @include('include.search')

        <!-- ##### Main Content Wrapper Start ##### -->
        @if(($url != 'register') and ($url != 'login'))
        <div class="main-content-wrapper d-flex clearfix">
            @include('include.sidebar')
            @else
            <div>
                @endif
                <div class="products-catagories-area clearfix">
                    @yield('content')
                </div>
            </div>
            @include('include.footer')
            @include('include.scripts')
    </body>
</html>