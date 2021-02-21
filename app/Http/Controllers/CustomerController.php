<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Customer;
class CustomerController extends Controller
{
    public function store(Request $request)
    {
        try {
            $uniqueEmail = $this->validate($request, [
                'email_address' => 'required|unique:man_customers,email_address'
            ]);
            $form_data = $request->input();
            $data = \App\Models\Customer::create($form_data);
            return response($data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::where('id', $id)->first();
            $customer->customer_lname = $request->input('customer_lname');
            $customer->customer_fname = $request->input('customer_fname');
            $customer->branch_name = $request->input('branch_name');
            $customer->contact_number = $request->input('contact_number');
            $customer->address = $request->input('address');
            $customer->company_name = $request->input('company_name');
            $customer->save();
            return response($customer);
        } catch (Exception $e) {
            return response('There was an error upon updating!');
        }
    }
}
