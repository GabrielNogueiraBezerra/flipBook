<nav class="navbar navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('bibliotecas/img/logo2.png') }}" alt="">
        </a>
        <form class="form-inline" method="GET" action="/pesquisa">
            <input id="pesquisa" name="pesquisa" class="form-control mr-sm-2" type="search" placeholder="Digite a sua pesquisa"
                   aria-label="Search">
            <button class="btn btn-outline-warning my-2 my-sm-0" 
                    type="submit">Pesquisar</button>
        </form>
    </div>
</nav>