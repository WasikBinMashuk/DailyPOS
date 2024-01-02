<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PdfController extends Controller
{
    public function downloadInvoice(Request $request)
    {
        try {
            $pdfData = DB::table('sells as a')
                ->select('d.name as customer_name', 'd.email as customer_email', 'd.mobile as customer_mobile', 'e.branch_name', 'c.product_name', 'b.quantity', 'b.price', 'b.total_price', 'a.subtotal', 'f.payment_method', 'f.due')
                ->leftJoin('sell_details as b', 'a.id', '=', 'b.sell_id')
                ->leftJoin('products as c', 'b.product_id', '=', 'c.id')
                ->leftJoin('customers as d', 'a.customer_id', '=', 'd.id')
                ->leftJoin('branches as e', 'a.branch_id', '=', 'e.id')
                ->leftJoin('sell_payments as f', 'a.id', '=', 'f.sell_id')
                ->where('a.id', '=', $request->sell_id)
                ->get();

            $date = now()->format('d-m-Y');
            $pdf = Pdf::loadView('backend.invoice.invoicePDF', compact('pdfData', 'date'));
            $pdfTitle = 'billing-invoice-' . now() . '.pdf';

            /**
             * using this session to handle this alert because when we press the download button this code runs again
             *so using this session as a trigger. Starting from posController and forgeting after executing once
             */
            if (session()->has('trigger')) {
                Alert::success('Product Sold!', '');
            }
            session()->forget('trigger');

            // return $pdf->download($pdfTitle);
            return $pdf->stream($pdfTitle);
        } catch (Exception $e) {
            // dd($e->getMessage());
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
}
