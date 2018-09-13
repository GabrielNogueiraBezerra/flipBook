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

        <script type="text/javascript">
            $(document).ready(function () {
                $("#estado").change(function () {
                    var URLLocal = 'http://localhost:8000/buscarCidades/' + this.value;
                    var select = document.getElementById("cidade");
                    $("#cidade").empty();

                    $.ajax({

                        type: 'GET',

                        url: URLLocal,

                        dataType: 'json',

                        data: {'value': $(this).val()},

                        success: function (result) {
                            for (var i = 0; i < result.length; i++) {
                                var option = new Option(result[i].descricao, result[i].id);
                                select.add(option);
                            }

                        },
                    });
                });
            });
        </script>
    </body>
</html>