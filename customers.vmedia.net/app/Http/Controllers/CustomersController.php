<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;

class CustomersController extends Controller
{
    public function create(){
        return view('customers.create');
    }

    public function store(Requests\CustomerRequest $request){
        Customer::create($request->all());
        return redirect('customers');
    }

    public function index(){
        $customers=Customer::all();
        return view('customers.index',compact('customers'));
    }

    public function show($cId){
        $customer= Customer::findOrFail($cId);
        return view('customers.show',compact('customer'));
    }

    public function edit($id){
        $customer=Customer::findOrFail($id);
        return view('customers.edit',compact('customer'));
    }

    public function update($id,Requests\CustomerRequest $request){
        $customer=Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect('customers');
    }
}
