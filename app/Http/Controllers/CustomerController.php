<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pesanan;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function welcome()
    {
        $customerCount = Customer::count(); // Retrieve the count of customers
        $orderCount = Pesanan::count(); // Retrieve the count of orders
        return view('welcome', compact('customerCount', 'orderCount'));
    }

    public function index(Request $request)
    {   
        $customers = Customer::select("*");

        if ($request->has('view_deleted')) {
            $customers = $customers->onlyTrashed();
        }

        $customers = $customers->paginate(8);

        return view('customer.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id); 
        return view('customer.show', compact('customer'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }
    

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'customer_id' => 'required',
        'address' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        if ($request->expectsJson()) {
            return response()->json($validator->errors(), 422);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    $customer = new Customer([
        'name' => $request->name,
        'customer_id' => $request->customer_id,
        'address' => $request->address,
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName);
        $customer->image = $imageName;
    }

    $customer->save();

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $customer
        ]);
    } else {
        return redirect()->route('customers.index')->with('success', 'Customer successfully created');
    }
}

public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'customer_id' => 'required',
            'address' => 'required',
        ]);
        try {
            $customer = Customer::findOrFail($id);
            $customer->name = $request->name;
            $customer->customer_id = $request->customer_id;
            $customer->address = $request->address;
    
            // Check if a file is uploaded
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
                $customer->image = $imageName;
            }
            $customer->save();
            
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Customer created successfully.',
            ]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => 'Customer failed to create.',
            ]);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer successfully deleted');
    }

    public function restore($id)
    {
        Customer::withTrashed()->find($id)->restore();

        return redirect()->route('customers.index')->with('success', 'Customer successfully restored');
    }

    public function restoreAll()
    {
        Customer::onlyTrashed()->restore();

        return redirect()->route('customers.index')->with('success', 'All deleted customers successfully restored');
    }

    public function forceDelete($id)
    {
        $customer = Customer::withTrashed()->find($id);
        $customer->forceDelete();

        return redirect()->route('customers.index')->with('success', 'Customer permanently deleted');
    }
}
