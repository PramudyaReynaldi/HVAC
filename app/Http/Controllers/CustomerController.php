<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::all();
        return view('list-customer', compact('customers'));
    }

    public function create() {
        return view('add-customer');
    }

    public function store(Request $request) {
        $request -> validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'purpose' => 'required|string|max:255'
        ]);

        $customer = new Customer();
        $customer->id = date('dmYHi');
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        $customer->purpose = $request->input('purpose');
        $customer->save();

        return redirect('/add-customer')->with('success', 'Customer created successfully!');
    }

    public function destroy($id) {
        $customer = Customer::find($id);

        if ($customer) {
            $customer->delete();
            //ini masih blom redirect ke path customers
            return response()->json(['success' => true, 'message' => 'Customer deleted succsesfully!']);
        } else {
            return response()->json(['error' => false, 'message' => 'Customer not found!'], 404);
        }
    }
}
