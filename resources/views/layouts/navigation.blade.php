@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (Session::has('message'))
    <script>
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: '{{ Session::get('message') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@if (Session::has('error'))
    <script>
        Swal.fire({
            position: 'top',
            icon: 'error',
            title: '{{ Session::get('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Tecnical Case</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Home</a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Button trigger modal(end of code) -->
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#CustomersModal">Cadastrar
                                    Clientes</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#ProductsModal">Cadastrar Produtos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Listagem
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('customer.index')}}">Clientes</a></li>
                            <li><a class="dropdown-item" href="{{route('product.index')}}">Produtos</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Sair</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Customers Modal -->
<div class="modal fade" id="CustomersModal" tabindex="-1" aria-labelledby="CustomersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="CustomersModalLabel">Cadastrar Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('customer.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" placeholder="Nome"
                                aria-label="Name">
                        </div>
                        <div class="col-sm">
                            <input type="text" name="cpf" class="form-control" placeholder="CPF"
                                aria-label="CPF">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Cadastrar Cliente</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!-- Products Modal -->
<div class="modal fade" id="ProductsModal" tabindex="-1" aria-labelledby="ProductsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ProductsModalLabel">Cadastrar Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('product.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" placeholder="Nome do produto"
                                aria-label="Name">
                        </div>
                        <div class="col-sm">
                            <input type="text" name="price" class="form-control" placeholder="Valor"
                                aria-label="price">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Cadastrar Produto</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
