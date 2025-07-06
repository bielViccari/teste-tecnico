<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{Customer, Product, Sale};
use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $customers = Customer::all();

        $sales = Sale::with(['product', 'customer'])->latest()->get();

        return view('dashboard', compact('products', 'customers', 'sales'));
    }


public function edit(Sale $sale)
{
    $products = Product::all();
    $customers = Customer::all();

if (is_string($sale->quota_details)) {
    $sale->quota_details = json_decode($sale->quota_details, true);
}

    return view('sale.edit', compact('sale', 'products', 'customers'));
}


public function store(SaleRequest $request)
{
    $data = $request->validated();

    $data['total'] = $data['quantity'] * $data['unit_price'];

    if (
        $data['payment'] === 'Personalizado'
        && $request->has('parcelas')
    ) {
        $parcelas = array_values($request->input('parcelas'));
        $data['quota_details'] = json_encode($parcelas);

        $data['date_payment'] = $parcelas[0]['data'] ?? null;

        $data['quota_qtd'] = count($parcelas);
    } else {
        $data['quota_details'] = null;
        $data['quota_qtd'] = null;
        $data['date_payment'] = null;
    }
    Sale::create($data);
    return redirect()->route('dashboard')->with('message', 'Venda registrada com sucesso!');
}
    public function destroy($id)
    {
        if(!$sale = Sale::find($id)) {
            return redirect()->back()->with('error', 'Venda não encontrada');
        }

        $sale->delete();

        return redirect()->route('dashboard')->with('message', 'Venda excluída com sucesso!');
    }

    public function update(SaleRequest $request, Sale $sale)
{
    $data = $request->validated();
    $data['total'] = $data['quantity'] * $data['unit_price'];

    if (
        $data['payment'] === 'Personalizado' &&
        isset($data['parcelas']) && !empty($data['parcelas'])
    ) {
        $parcelas = array_map(function ($p) {
            return "{$p['data']}: R${$p['valor']}";
        }, $data['parcelas']);

        $data['quota_details'] = implode("\n", $parcelas);
    } else {
        $data['quota_details'] = null;
        $data['quota_qtd'] = null;
        $data['date_payment'] = null;
    }

    $sale->update($data);

    return redirect()->route('dashboard')->with('message', 'Venda atualizada com sucesso!');
}
}

