<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Painel de cadastro de vendas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h5 class="fw-bold text-secondary text-center mt-3">REGISTRAR VENDA</h5>
                </div>

                <div class="container">
                    <form class="row g-3" method="POST" action="{{ route('sale.store') }}">
                        @csrf
                        <div class="col-md-6">
                            <div class="d-flex align-items-end gap-2">
                                <div class="flex-grow-1">
                                    <label for="product" class="form-label fw-semibold text-secondary">Selecione o
                                        produto</label>
                                    <select id="product" name="product_id" class="form-select">
                                        <option selected>Selecione...</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex align-items-end gap-2">
                                <div class="flex-grow-1">
                                    <label for="customer" class="form-label fw-semibold text-secondary">Selecione o
                                        cliente</label>
                                    <select id="customer" name="customer_id" class="form-select">
                                        <option selected>Selecione...</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary">Quantidade</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary">Valor Unitário</label>
                            <input type="text" name="unit_price" id="unit_price" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary">Total</label>
                            <input type="text" name="total" id="total" class="form-control" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-secondary">Forma de Pagamento</label>
                            <select id="payment" name="payment" class="form-select">
                                <option selected>Selecione...</option>
                                <option value="A vista">A vista</option>
                                <option value="Personalizado">Personalizado</option>
                            </select>
                        </div>

                        <div id="parcelamento" class="row g-3 mt-2 d-none">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Qtd Parcelas</label>
                                <input type="number" name="quota_qtd" id="quota_qtd" class="form-control"
                                    min="1">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Data 1ª Parcela</label>
                                <input type="date" name="date_payment" id="date_payment" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Valor 1ª Parcela</label>
                                <input type="number" step="0.01" id="firstQuota" class="form-control">
                            </div>

                            <div class="col-12" id="inputsParcelas">
                                <!-- Inputs de parcelas serão gerados dinamicamente aqui -->
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100">Cadastrar Venda</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h5 class="fw-bold text-secondary text-center mt-3">LISTAGEM DE VENDAS</h5>

                    <table class="table table-bordered mt-4">
                        <thead class="table-dark">
                            <tr>
                                <th>Produto</th>
                                <th>Cliente</th>
                                <th>Qtd</th>
                                <th>Valor Unit.</th>
                                <th>Total</th>
                                <th>Parcelas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                    <td>{{ $sale->product->name }}</td>
                                    <td>{{ $sale->customer->name }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>R$ {{ number_format($sale->unit_price, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($sale->total, 2, ',', '.') }}</td>
                                    <td>
                                        @if ($sale->payment === 'Personalizado' && $sale->quota_details)
                                            @php
                                                $parcelas = json_decode($sale->quota_details, true);
                                            @endphp
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($parcelas as $parcela)
                                                    <li>
                                                        {{ \Carbon\Carbon::parse($parcela['data'])->format('d/m/Y') }}
                                                        -
                                                        R$ {{ number_format($parcela['valor'], 2, ',', '.') }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            À vista
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('sale.edit', $sale->id) }}" class="btn btn-sm btn-warning text-white">Editar</a>
                                        <form method="POST" action="{{ route('sale.destroy', $sale->id) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Tem certeza?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
