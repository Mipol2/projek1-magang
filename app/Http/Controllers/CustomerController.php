<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CustomerController extends Controller
{
    public function index(Request $request)
    {   
        $customers = customer::select("*");
  
        if ($request->has('view_deleted')) {
            $customers = $customers->onlyTrashed();
        }
  
        $customers = $customers->paginate(8);
          
        return view('Customer.index', compact('customers'));
    }
    public function show($id)
    {
       $customer = Customer::findOrFail($id); 
       return view('Customer.show', compact('customer'));
    }

    public function create()
    {
        return view('Customer.create');
    }

    public function edit(Customer $customer)
    {
        return view('Customer.edit', compact('customer'));
    }

    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->customer_id = $request->customer_id;
        $customer->address = $request->address;
        $customer->save();
        $message = 'Custommer Successfully Created';
        return redirect()->route('customers.index')->with($message);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        // Isi dengan field lainnya
        $customer->name = $request->name;
        $customer->customer_id = $request->customer_id;
        $customer->address = $request->address;
    
        // Check if a file is uploaded
        if ($request->hasFile('image')) {
            if($customer->avatar){
                Storage::delete('public/images/'.$customer->avatar);
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $customer->avatar = $imageName;
        }
    
        $customer->save();
    
        return redirect()->route('customers.index')
            ->with('success', 'Data updated successfully!');
    }
    
    
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
    
        $message = 'Customer Successfully Deleted';
        return redirect()->route('customers.index')->with($message);
    }

    public function upload($id)
    {
        $customer = Customer::findOrFail($id);
        return view('Customer.upload', compact('customer'));
    }
    

    public function storeImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
    
        $image->move(public_path('images'), $imageName);
    
        $customer = Customer::findOrFail($id);
        $customer->avatar = $imageName;
        $customer->save();
        return  redirect()->route('customers.index')
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }

    public function restore($id)
    {
        Customer::withTrashed()->find($id)->restore();
  
        return redirect()->route('customers.index');
    }  
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function restoreAll()
    {
        Customer::onlyTrashed()->restore();
  
        return redirect()->route('customers.index');
    }

    public function forceDelete($id){
        $customer = Customer::withTrashed()->find($id);
        $customer->forceDelete();
  
        return redirect()->route('customers.index');
    }
}
