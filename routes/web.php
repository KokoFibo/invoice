<?php

use App\Mail\Test;
use App\Mail\InvoiceMail;
use App\Http\Livewire\Invoicewr;
use App\Http\Livewire\Packagewr;
use App\Http\Livewire\Contractwr;
use App\Http\Livewire\Customerwr;
use App\Http\Livewire\Quotationwr;
use App\Http\Livewire\Addinvoicewr;
use App\Http\Livewire\Addcontractwr;
use Illuminate\Support\Facades\Mail;
use App\Http\Livewire\Addquotationwr;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Createinvoicewr;
use App\Http\Livewire\Editquotationwr;
use App\Http\Livewire\Updateinvoicewr;
use App\Http\Livewire\Createcontractwr;
use App\Http\Livewire\Updatecontractwr;
use App\Http\Livewire\Createquotationwr;
use App\Http\Livewire\Updatequotationwr;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Updatedetailinvoicewr;
use App\Http\Livewire\Updatedetailcontractwr;
use App\Http\Livewire\Updatedetailquotationwr;
use App\Http\Controllers\InvoiceEmailController;
use App\Http\Controllers\QuotationEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::middleware(['superadmin'])->group(function () {
        //  isi dengan route yg khusus superadmin

    });

    Route::middleware(['admin'])->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/customer', Customerwr::class)->name('customer');
        Route::get('/package', Packagewr::class)->name('package');
        Route::get('/invoice', Invoicewr::class)->name('invoice');
        Route::get('/createinvoice', Createinvoicewr::class)->name('createinvoice');
        Route::get('/updateinvoice/{current_number}', Updateinvoicewr::class)->name('updateinvoice');
        Route::get('/updatedetailinvoice/{current_id}/{number}', Updatedetailinvoicewr::class)->name('updatedetailinvoice');
        Route::get('/addinvoice/{number}', Addinvoicewr::class)->name('addinvoice');
        Route::get('/quotation', Quotationwr::class)->name('quotation');
        Route::get('/createquotation', Createquotationwr::class)->name('createquotation');
        Route::get('/updatequotation/{current_number}', Updatequotationwr::class)->name('updatequotation');
        Route::get('/updatedetailquotation/{current_id}/{number}', Updatedetailquotationwr::class)->name('updatedetailquotation');
        Route::get('/addquotation/{number}', Addquotationwr::class)->name('addquotation');

        Route::get('/pdftemplate/{number}', [InvoiceEmailController::class, 'index']);
        Route::get('/pdf/{number}', [InvoiceEmailController::class, 'pdf']);
        Route::get('/pdfNoSignature/{number}', [InvoiceEmailController::class, 'pdfNoSignature']);
        Route::get('/emailinvoice/{number}', [InvoiceEmailController::class, 'emailinvoice']);
        Route::get('/invoiceEmail/{number}', [InvoiceEmailController::class, 'invoiceEmail']);

        Route::get('/quotationtemplate/{number}', [QuotationEmailController::class, 'index']);
        Route::get('/quotationpdf/{number}', [QuotationEmailController::class, 'pdf']);
        Route::get('/quotationEmail/{number}', [QuotationEmailController::class, 'quotationEmail']);

        Route::get('/contract', Contractwr::class)->name('contract');
        Route::get('/createcontract', Createcontractwr::class)->name('createcontract');
        Route::get('/updatecontract/{current_number}', Updatecontractwr::class)->name('updatecontract');
        Route::get('/updatedetailcontract/{current_id}/{number}', Updatedetailcontractwr::class)->name('updatedetailcontract');
        Route::get('/addcontract/{contract_number}', Addcontractwr::class)->name('addcontract');


        Route::get('/emailhtml', [InvoiceEmailController::class, 'emailhtml']);

        Route::get('/invoicemail/{number}', function () {
            Mail::send(new InvoiceMail());
        });
    });

    Route::get('/test', function () {
        return view('test');
    });
});

require __DIR__ . '/auth.php';
