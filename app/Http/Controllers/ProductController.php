<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(Product $product) {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(ProductRequest $request) {
        $data = $request->all();
        $formatNumber = $request->input('price');
        if(strpos($formatNumber, ',') !== false) {
            $formatedNumber = str_replace(',', '.', $formatNumber);
        } else {
            $formatedNumber = $formatNumber;
        }

        $data['price'] = $formatedNumber;

        Product::create($data);
        return redirect()->route('product.index')->with('message', 'Produto cadastrado com sucesso');
    }

    public function update($id, ProductRequest $request) {
        $product = Product::find($id);

        $validator = Validator::make(
            data: [
                'name' => $request->name,
                'price' => $request->price,
            ],
            rules: [
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'price' => ['required', 'numeric', 'gt:0'],
            ]
        );

        if($validator->fails()) { return redirect()->back()->withErrors($validator);};

        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();
        return redirect()->route('product.index')->with('message', 'Produto editado com sucesso');

    }

    public function destroy($id) {
        if(!$product = Product::find($id)) {
            return redirect()->back()->with('error', 'Produto não encontrado');
        }

        $product->delete();
        return redirect()->route('product.index')->with('message', 'Venda excluída com sucesso!');
    }
}
