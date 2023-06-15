<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\Customer;
use Illuminate\Http\Request;


class PesananController extends Controller
{

    public function index(Request $request)
    {
        $pesanans = Pesanan::with('barang')->get();
        $pesanans = Pesanan::with('customer')->get();
        return view('Pesanan.index', compact('pesanans'));   
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
        $pesanan = new Pesanan;
        $pesanan->id_customer = $request->id_customer;
        $pesanan->id_barang = $request->id_barang;
        $pesanan->jumlah_barang = $request->jumlah_barang;
        $pesanan->harga_total = $request->harga_total;
        $pesanan->save();
        $message = 'Pesanan Successfully Created';
        return redirect()->route('pesanans.index')->with($message);
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        // Isi dengan field lainnya
        $pesanan->id_customer = $request->id_customer;
        $pesanan->id_barang = $request->id_barang;
        $pesanan->jumlah_barang = $request->jumlah_barang;
        $pesanan->harga_total = $request->harga_total;
        $pesanan->save();
        $message = 'Pesanan Successfully Updated';
        return redirect()->route('pesanans.index')->with($message);
        
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        $message = 'Pesanan Successfully Deleted';
        return redirect()->route('pesanans.index')->with($message);  
    }  
}
