@include('layouts.navigation')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container">
    <h4 class="my-2 text-center">Listagem de Produtos</h4>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="text-danger text-sm fw-bold">{{ $error }}</p>
        @endforeach
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nome do Produto</th>
                    <th>Preço</th>
                    <th class="text-center col-1">Ações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>

                        <td class="text-center">
                            <button type="button" class="btn p-0 border-0 bg-transparent text-warning me-3"
                                data-bs-toggle="modal" data-bs-target="#EditproductModal"><i
                                    class="bi bi-pencil-fill"></i></button>

                            <!-- products Modal -->
                            <div class="modal fade" id="EditproductModal" tabindex="-1"
                                aria-labelledby="productsModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="productsModalLabel">Editar informações do
                                                cliente - {{ $product->name }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('product.update', $product->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="row g-3">
                                                    <div class="col-sm-7">
                                                        <label for="name" id="name"
                                                            class="text-sm text-secondary form-label">Nome</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $product->name }}" aria-label="Name">
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="price"
                                                            class="text-sm text-secondary">Preço</label>
                                                        <input type="text" name="price" class="form-control"
                                                            value="{{ $product->price }}" aria-label="price">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-warning mt-3 w-100">Salvar
                                                    Alterações</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form method="post" action="{{ route('product.destroy', $product->id) }}">
                                @csrf
                                @method('delete')
                                <button type="button" href="{{ route('customer.destroy', $product->id) }}"
                                    class="btn p-0 border-0 bg-transparent text-danger" title="Apagar"><i
                                        class="bi bi-trash-fill" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal"></i></button>

                                <!-- Modal -->
                                <div class="modal fade" id="confirmModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja mesmo apagar
                                                    os dados do produto?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Atenção! Se você realizar esta ação, todos os dados do produto serão
                                                apagados!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary text-white"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Apagar produto</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@if($products)
    {{ $products->links('pagination::bootstrap-5') }}
@endif



</div>
