<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Venda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h5 class="fw-bold text-secondary text-center mt-3">EDITAR VENDA</h5>
                </div>

                <div class="container">
                    <form class="row g-3" method="POST" action="{{ route('sale.update', $sale->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Produto --}}
                        <div class="col-md-6">
                            <label for="product" class="form-label fw-semibold text-secondary">Produto</label>
                            <select id="product" name="product_id" class="form-select">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        data-price="{{ $product->price }}"
                                        {{ $sale->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Cliente --}}
                        <div class="col-md-6">
                            <label for="customer" class="form-label fw-semibold text-secondary">Cliente</label>
                            <select id="customer" name="customer_id" class="form-select">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $sale->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Quantidade --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary">Quantidade</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"
                                min="1" value="{{ $sale->quantity }}">
                        </div>

                        {{-- Valor Unitário --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary">Valor Unitário</label>
                            <input type="text" name="unit_price" id="unit_price" class="form-control"
                                value="{{ $sale->unit_price }}" readonly>
                        </div>

                        {{-- Total --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary">Total</label>
                            <input type="text" name="total" id="total" class="form-control"
                                value="{{ $sale->total }}" readonly>
                        </div>

                        {{-- Forma de Pagamento --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold text-secondary">Forma de Pagamento</label>
                            <select id="payment" name="payment" class="form-select">
                                <option value="A vista" {{ $sale->payment == 'A vista' ? 'selected' : '' }}>A vista</option>
                                <option value="Personalizado" {{ $sale->payment == 'Personalizado' ? 'selected' : '' }}>Personalizado</option>
                            </select>
                        </div>

                        {{-- Parcelamento --}}
                        <div id="parcelamento" class="row g-3 mt-2 {{ $sale->payment == 'Personalizado' ? '' : 'd-none' }}">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Qtd Parcelas</label>
                                <input type="number" name="quota_qtd" id="quota_qtd" class="form-control"
                                    min="1" value="{{ $sale->quota_qtd }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Data 1ª Parcela</label>
                                <input type="date" name="date_payment" id="date_payment" class="form-control"
                                    value="{{ $sale->date_payment }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Valor 1ª Parcela</label>
                                <input type="number" step="0.01" id="firstQuota" class="form-control"
                                    value="{{ $sale->quota_details[0]['valor'] ?? '' }}">
                            </div>

                            <div class="col-12" id="inputsParcelas">
                                @if ($sale->quota_details)
                                    @foreach ($sale->quota_details as $i => $parcela)
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <input type="date" name="parcelas[{{ $i }}][data]" class="form-control"
                                                    value="{{ $parcela['data'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" step="0.01" name="parcelas[{{ $i }}][valor]" class="form-control"
                                                    value="{{ $parcela['valor'] ?? '' }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Botão --}}
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">Atualizar Venda</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
