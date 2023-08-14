<?php

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Quotation;

// function getContractNumber($id) {
//     try {
//         $data = Contract::where('customer_id', $id)->first();
//         if( $data->contract_number != null) {
//             return $data->contract_number;
//         } else {
//             return '';
//         }
//     } catch (\Exception $e) {
//          return $e->getMessage();
//     }
// }


function isEmailed($number) {
    $isEmailed = Invoice::where('number', $number)->first();
    if($isEmailed->status == 'Emailed'){
        return true;
    }else {
        return false;
    }
}

function getDetail($description)
{
    if ($description != null) {
        return explode(',', $description);
    }
}
function getCustomerfromInvoiceNo($number)
{
    $invoice = Invoice::where('number', $number)->first();
    $customer = Customer::find('id', $invoice->customer_id);
    dd($customer->name);
    return $customer;
}
function getBgColor($status)
{
    if ($status != null) {
        $bgColor = '';
        switch ($status) {
            case 'Draft':
                $bgColor = 'yellow-500';
                break;
            case 'Emailed':
                $bgColor = 'blue-500';
                break;
            case 'Paid':
                $bgColor = 'green-500';
                break;
            case 'Uncollectible':
                $bgColor = 'black';
                break;
        }
    }
    return $bgColor;
}

function getTextColor($status)
{
    if ($status != null) {
        $textColor = '';
        switch ($status) {
            case 'Draft':
                $textColor = 'black';
                break;
            case 'Emailed':
                $textColor = 'white';
                break;
            case 'Paid':
                $textColor = 'white';
                break;
            case 'Uncollectible':
                $textColor = 'white';
                break;
        }
    }
    return $textColor;
}

function total($price, $qty, $tax)
{
    return (($price * $qty) / (100 - $tax)) * 100;
}

function dueDate()
{
    // $now = Carbon::now();
    // $year = $now->year;
    // $month = $now->month + 1;
    // $dd = $year . '-' . $month . '-05';
    // $ymd = DateTime::createFromFormat('Y-m-d', $dd)->format('Y-m-d');
    $dd = Carbon::now()->addDays(7);
    $year = $dd->year;
    $month = $dd->month;
    $date = $dd->day;
    $duedate = $year . '-' . $month . '-' . $date;
    //  dd($date );

    $ymd = DateTime::createFromFormat('Y-m-d', $duedate)->format('Y-m-d');
    //   return Carbon::parse($ymd);

        // Carbon::now()->subDays(30)

    return $ymd;
}

function getInvoiceNumber()
{
    $now = Carbon::now();
    $year = $now->year;
    $month = $now->month;
    if ($month < 10) {
        $month = '0' . (string) $month;
    }
    $data = Invoice::withTrashed()->max('number') + 1;
    if ($data < 10) {
        $data = '0' . (string) $data;
    }

    return 'INV' . strval($year - 2000) . (string) $month . (string) $data;
}

function getQuotationNumber()
{
    $now = Carbon::now();
    $year = $now->year;
    $month = $now->month;
    if ($month < 10) {
        $month = '0' . (string) $month;
    }
    $data = Quotation::withTrashed()->max('number') + 1;
    if ($data < 10) {
        $data = '0' . (string) $data;
    }

    return 'QUO' . strval($year - 2000) . (string) $month . (string) $data;
}

function showQuotationNumber($number)
{
    $now = Carbon::now();
    $year = $now->year;
    $month = $now->month;
    if ($month < 10) {
        $month = '0' . (string) $month;
    }
    // $data = Quotation::withTrashed()->max('number') + 1;
    $data = $number;
    if ($data < 10) {
        $data = '0' . (string) $data;
    }

    return 'QUO' . strval($year - 2000) . (string) $month . (string) $data;
}




function getContractNumber()
{
    $now = Carbon::now();
    $year = $now->year;
    $month = $now->month;
    if ($month < 10) {
        $month = '0' . (string) $month;
    }
    $data = Contract::withTrashed()->max('contract_number') + 1;
    if ($data < 10) {
        $data = '0' . (string) $data;
    }

    return 'C/' . strval($year - 2000) . (string) $month .  '/' . (string) $data;
}

function getInvoiceRealNumber()
{
    return $data = Invoice::withTrashed()->max('number') + 1;
}
function getContractRealNumber()
{
    return $data = Contract::withTrashed()->max('contract_number') + 1;
}

function getQuotationRealNumber()
{

    return $data = Quotation::withTrashed()->max('number') + 1;
}

function getCompany($id)
{
    if ($id != null) {
        $data = Customer::find($id);
        return $data->company;
    }
}
function getTotal($number)
{
    if ($number != null) {
        $data = Invoice::where('number', $number)->get();
        $subtotal = 0;
        $total = 0;
        $discount = 0;
        $tax = 0;
        foreach ($data as $d) {
            $subtotal = $subtotal + $d->price * $d->qty;
            $discount = $d->discount;
            $tax = $d->tax;
        }
        $total = (($subtotal - $discount) / (100 - $tax)) * 100;
        return round($total / 1000) * 1000;
    }
}
function invNumberFormat($number, $invDate)
{
    if ($number != null) {
        $newDate = DateTime::createFromFormat('Y-m-d', $invDate);
        $year = $newDate->format('Y');
        $month = $newDate->format('m');
        $data = '';

        if ($number < 10) {
            $data = '0' . (string) $number;
        } else {
            $data = (string) $number;
        }
        return 'INV' . strval((int) $year - 2000) . $month . $data;
    }
}
function contractNumberFormat($number, $date)
{
    if ($number != null) {

        // $newDate = Carbon::now();
        $newDate = DateTime::createFromFormat('Y-m-d', $date);

        $year = $newDate->format('Y');
        $month = $newDate->format('m');
        $data = '';

        if ($number < 10) {
            $data = '0' . (string) $number;
        } else {
            $data = (string) $number;
        }
        return 'C/' . strval((int) $year - 2000) . $month . '/'. $data;
    }
}
function quoNumberFormat($number, $quoDate)
{
    if ($number != null) {
        $newDate = DateTime::createFromFormat('Y-m-d', $quoDate);
        $year = $newDate->format('Y');
        $month = $newDate->format('m');
        $data = '';

        if ($number < 10) {
            $data = '0' . (string) $number;
        } else {
            $data = (string) $number;
        }
        return 'QUO' . strval((int) $year - 2000) . $month . $data;
    }
}

function roundedTotal($subtotal, $discount, $tax)
{
    if ($discount == null) {
        $discount = 0;
    }
    return $total = round(((($subtotal - $discount) / (100 - $tax)) * 100) / 1000) * 1000;
}
function getQuotationData ($number) {
    if($number != null) {
        $data = Quotation::where('number', $number)->get();
        return $data;
    }
}





function tanggal_with_hari($tgl){
    return date('D, d M Y', strtotime($tgl));
}
function tanggal_with_Jam($tgl){
    if($tgl == null) {
        return '-';
    } else {

        return date('d M Y H:i:s', strtotime($tgl));
    }
}

function tanggal($tgl)
{
    return date('d M Y', strtotime($tgl));
}

function getMonthName($tgl)
{
    try {
        $date = Carbon::createFromFormat('Y-m-d', $tgl);
        return $date->format('F');
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}
