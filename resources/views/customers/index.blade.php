@include('layouts.navigation')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
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

<div class="container">
    <h4 class="my-2 text-center">Listagem de Clientes</h4>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="text-danger text-sm fw-bold">{{ $error }}</p>
        @endforeach
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nome do Cliente</th>
                    <th>CPF</th>
                    <th class="text-center col-1">Ações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td> {{ $customer->CPF }}</td>

                        <td class="text-center">
                            <button type="button" class="btn p-0 border-0 bg-transparent text-warning me-3"
                                data-bs-toggle="modal" data-bs-target="#EditCustomerModal"><i
                                    class="bi bi-pencil-fill"></i></button>

                            <!-- Customers Modal -->
                            <div class="modal fade" id="EditCustomerModal" tabindex="-1"
                                aria-labelledby="CustomersModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="CustomersModalLabel">Editar informações do
                                                cliente - {{ $customer->name }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('customer.update', $customer->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="row g-3">
                                                    <div class="col-sm-7">
                                                        <label for="name" id="name"
                                                            class="text-sm text-secondary form-label">Nome</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $customer->name }}" aria-label="Name">
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="cpf" class="text-sm text-secondary">CPF</label>
                                                        <input type="text" name="cpf" class="form-control"
                                                            value="{{ $customer->CPF }}" aria-label="CPF">
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

                            <form method="post" action="{{ route('customer.destroy', $customer->id) }}">
                                @csrf
                                @method('delete')
                                <button type="button" href="{{ route('customer.destroy', $customer->id) }}"
                                    class="btn p-0 border-0 bg-transparent text-danger" title="Apagar"><i
                                        class="bi bi-trash-fill" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"></i></button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja mesmo apagar
                                                    os dados do cliente?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Atenção! Se você realizar esta ação, todos os dados do cliente serão
                                                perdidos!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary text-white"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Apagar cliente</button>
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
    @if ($customers)
        {{ $customers->links('pagination::bootstrap-5') }}
    @endif
</div>
