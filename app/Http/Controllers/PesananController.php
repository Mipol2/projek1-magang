<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{

    public function index(Request $request)
    {
        $customers = Customer::all();
        $barangs = Barang::all();
        $pesanans = Pesanan::with('barang')->get();
        $pesanans = Pesanan::with('customer')->get();
        return view('Pesanan.index', compact('customers', 'barangs', 'pesanans'));   
    }
    
    public function show($id)
    {
        $pesanan = Pesanan::with('barang')->findOrFail($id); 
        $pesanan = Pesanan::with('customer')->findOrFail($id);
        return view('Pesanan.show', compact('pesanan'));   
    }

    public function create()
    {
        $customers = Customer::all();
        $barangs = Barang::all();
        return view('Pesanan.create', compact('customers', 'barangs'));
    }

    public function edit(Pesanan $pesanan)
    {
        $customers = Customer::all();
        $barangs = Barang::all();
        return view('Pesanan.edit', compact('pesanan', 'customers', 'barangs'));  
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_customer' => 'required',
            'id_barang' => 'required',
            'jumlah_barang' => 'required',
            'harga_total' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $pesanan = Pesanan::create([
            'id_customer'     => $request->id_customer, 
            'id_barang'   => $request->id_barang,
            'jumlah_barang'   =>  $request->jumlah_barang,
            'harga_total' => $request->harga_total
        ]);


        $pesanan->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $pesanan  
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_customer' => 'required',
            'id_barang' => 'required',
            'jumlah_barang' => 'required',
            'harga_total' => 'required',
        ]);

        try {
            $pesanan = Pesanan::findOrFail($id);
            // Isi dengan field lainnya
            $pesanan->id_customer = $request->id_customer;
            $pesanan->id_barang = $request->id_barang;
            $pesanan->jumlah_barang = $request->jumlah_barang;
            $pesanan->harga_total = $request->harga_total;
            $pesanan->save();

            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Pesanan created successfully.',
            ]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => 'Pesanan failed to create.',
            ]);
        }
        
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        $message = 'Pesanan Successfully Deleted';
        return redirect()->route('pesanans.index')->with($message);  
    }  
}
