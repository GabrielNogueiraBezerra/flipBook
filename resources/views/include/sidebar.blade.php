<!-- Header Area Start -->
<header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            <li class="{{ @$url == '' ? ' active' : '' }}"><a href="/">Início</a></li>
            @if (Auth::guest())
            <li class="{{ @$url == 'login' ? ' active' : '' }}"><a href="/login">Minha conta</a></li>
            @else
            <li class="{{ @$url == 'perfil' ? ' active ' : ''}}" ><a href="/perfil">Olá, {{ Auth::user()->nome }}</a></li>
            <li class="{{ @$url == 'livros' ? ' active ' : ''}}"><a href="/livros">Meus Livros</a></li>
            <li class="{{ @$url == 'areaVendas' ? ' active ' : ''}}"><a href="/areaVendas">Minhas vendas</a></li>
            <li class="{{ @$url == 'areaCompras' ? ' active ' : ''}}"><a href="/areaCompras">Minhas Compras</a></li>
            <li><a href="/sair">Sair</a></li>
            @endif
        </ul>
    </nav>
</header>
<!-- Header Area End -->

<!-- Product Catagories Area Start -->