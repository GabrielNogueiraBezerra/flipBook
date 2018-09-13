<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="{{ asset('bibliotecas/js/jquery/jquery-2.2.4.min.js') }}"></script>
<!-- Popper js -->
<script src="{{ asset('bibliotecas/js/popper.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('bibliotecas/js/bootstrap.min.js') }}"></script>
<!-- Plugins js -->
<script src="{{ asset('bibliotecas/js/plugins.js') }}"></script>
<!-- Active js -->
<script src="{{ asset('~bibliotecas/js/active.js') }}"></script>
<!-- Active js -->
<script src="{{ asset('bibliotecas/js/temp.js') }}"></script>

@if(@explode('/', Request::url())[3] == 'register')
<script src="{{ asset('bibliotecas/js/buscaCidades.js') }}"></script>
@endif