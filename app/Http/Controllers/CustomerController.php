<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function index(Customer $customer) {
        $customers = Customer::latest()->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function store(CustomerRequest $request) {
        $data = $request->all();

        $cpfValidator = Validator::make($data, [
        'cpf' => ['required', 'regex:/^\d{8,11}$/'],
        ]);

        if ($cpfValidator->fails()) {
            return redirect()->route('dashboard')->with('error', 'CPF inválido');
        }

        $nameValidator = Validator::make($data, [
            'name' => ['required', 'min:3'],
        ]);

        if ($nameValidator->fails()) {
            return redirect()->route('dashboard')->with('error', 'O nome deve ter mais de 3 caracteres');
        }

        Customer::create($data);
        return redirect()->route('customer.index')->with('message', 'Cliente cadastrado com sucesso');

    }

    public function update($id, CustomerRequest $request) {
        $customer = Customer::find($id);

        $validator = Validator::make(
            data: [
                'name' => $request->name,
                'CPF' => $request->CPF,
            ],
            rules: [
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'CPF' => ['required', 'string', 'min:9','max:11'],
            ]
        );

        if($validator->fails()) { return redirect()->back()->withErrors($validator);};

        $customer->name = $request->name;
        $customer->CPF = $request->CPF;

        $customer->save();
        return redirect()->route('customer.index')->with('message', 'Cliente editado com sucesso');
    }

    public function destroy($id) {
        if(!$customer = Customer::find($id)) {
            return redirect()->back()->with('error', 'Cliente não encontrado');
        }

        $customer->delete();
        return redirect()->route('customer.index')->with('message', 'Cliente deletado com sucesso');
    }
}
