<!-- ##### Footer Area Start ##### -->
<footer class="footer_area clearfix">
    <div class="container">
        <div class="row align-items-center">
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-4">
                <div class="single_widget_area">
                    <!-- Logo -->
                    <div class="footer-logo mr-50">
                        <a href="/"><img src="{{asset('bibliotecas/img/logo2.png')}}" alt=""></a>
                    </div>
                    <!-- Copywrite Text -->
                    <p class="copywrite">

                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> 
                        Todos os direitos reservados
                    </p>
                </div>
            </div>
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-8">
                <div class="single_widget_area">
                    <!-- Footer Menu -->
                    <div class="footer_menu">
                        <nav class="navbar navbar-expand-lg justify-content-end">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" 
                                    data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                            <div class="collapse navbar-collapse" id="footerNavContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item {{ @$url == '/' ? ' active ' : ''}}">
                                        <a class="nav-link" href="/">Início</a>
                                    </li>
                                    @if (Auth::guest())
                                    <li class="nav-item {{ @$url == 'login' ? ' active' : '' }}">
                                        <a class="nav-link" href="/login">Minha conta</a>
                                    </li>
                                    @else
                                    <li class="nav-item"><a class="nav-link" href="/home">Olá, {{ Auth::user()->nome }}</a></li>
                                    <li class="nav-item {{ @$url == 'livros' ? ' active ' : ''}}">
                                        <a class="nav-link" href="/livros">Meus Livros</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/sair">Sair</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>