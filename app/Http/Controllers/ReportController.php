<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use PDF;
use Illuminate\Http\Request;
class ReportController extends Controller
{
    public function index(Request $request)    
    {
        $customers = Customer::all();
        return view('Report.index', compact('customers'));
    }
    
    public function download() {
        $customers = Customer::all();
        $pdf = PDF::loadView('Report.download', compact('customers'));
        
        return $pdf->download('customers.pdf');
    }
}
