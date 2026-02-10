<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function create() {
        return view('invoice.create');
    }
    public function index() {
        // Saari invoices database se uthao (Latest pehle)
        $invoices = Invoice::orderBy('created_at', 'desc')->get();
        
        return view('invoice.index', compact('invoices'));
    }

    public function download(Request $request) 
    {
        // 1. Validation
        $request->validate([
            'client_name' => 'required',
            'item' => 'required',
            'price' => 'required|numeric',
        ]);

        // 2. Save to Database
        $invoice = Invoice::create([
            'invoice_number'   => 'INV-' . strtoupper(uniqid()),
            'client_name'      => $request->client_name,
            'client_email'     => $request->client_email,
            'item_description' => $request->item,
            'quantity'         => $request->qty,
            'price'            => $request->price,
            'total_amount'     => $request->qty * $request->price,
        ]);

        // 3. Generate PDF (Pass the $invoice object)
      // Step 3 wala hissa aisay badlein:
$pdf = Pdf::loadView('invoice.pdf_template', [
    'invoice'          => $invoice,              // $invoice->client_name chalay ga
    'client_name'      => $invoice->client_name, // $client_name bhi chalay ga
    'client_email'     => $invoice->client_email,
    'item'             => $invoice->item_description, // $item ab chal pare ga!
    'price'            => $invoice->price,
    'qty'              => $invoice->quantity,
    'total'            => $invoice->total_amount,
]);

return $pdf->download($invoice->invoice_number . '.pdf');
    }
    public function reDownload($id) {
        // Database se specific invoice dhoondo ID ke zariye
        $invoice = Invoice::findOrFail($id);
    
        // Wahi PDF load karo purane data ke sath
        $pdf = Pdf::loadView('invoice.pdf_template', [
            'invoice'          => $invoice,
            'client_name'      => $invoice->client_name,
            'client_email'     => $invoice->client_email,
            'item'             => $invoice->item_description,
            'price'            => $invoice->price,
            'qty'              => $invoice->quantity,
            'total'            => $invoice->total_amount,
        ]);
    
        return $pdf->download($invoice->invoice_number . '.pdf');
    }
}
