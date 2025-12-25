<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $salutation = "Mr";
        $name = "Anton Kokofibo";
        $invoice_number = "INV-001";
        $company = "Kokofibo Digital";
        $due_date = "2024-07-31";
        $invoice_date = "2024-07-01";
        $total = "1500000";
        return view(
            'pdf.invoiceEmailTemplate',
            [
                'title' => $salutation,
                'custName' => $name,
                'invoice_number' => $invoice_number,
                'company' => $company,
                'due_date' => tanggal($due_date),
                'invoice_date' => tanggal($invoice_date),
                'total' => $total
            ],
        );
    }
}
