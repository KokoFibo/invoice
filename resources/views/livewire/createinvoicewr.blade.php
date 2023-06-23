<div class="p-3">
    <div class="w-full mx-auto mt-3 text-black bg-white shadow lg:w-3/4 rounded-xl border-1">
        <h2 class="py-3 text-2xl font-semibold text-center">Create Invoice</h2>
    </div>

    {{-- <div class="w-full mx-auto text-black bg-white lg:w-3/4" style="height: 100vh;"> --}}
    <div class="w-full p-3 mx-auto mt-3 text-black bg-white shadow lg:w-3/4 rounded-xl border-1">

        <div class="flex flex-col items-start justify-between w-full gap-3 lg:flex-row ">
            <div class="flex flex-col w-full gap-3 lg:w-1/3">

                {{-- customer --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Customer
                    </span>
                    <select wire:model="customer_id"
                        class=" w-full bg-gray-50 border  border-gray-300 text-gray-600 rounded-none rounded-r-lg
        text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select Customer</option>
                        @foreach ($customer as $c)
                            <option value="{{ $c->id }}">{{ $c->company }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Contract --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Contract
                    </span>
                    <select wire:model="contract"
                        class="w-full  bg-gray-50 border  border-gray-300 text-gray-600 rounded-none rounded-r-lg
                text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        @if ($contract != '')
                            <option value="">Without Contract</option>
                            <option value="{{ $contract }}">{{ contractNumberFormat($contract, $contract_date) }}
                            </option>
                        @else
                            <option value="">No Contract</option>
                        @endif
                    </select>
                </div>
            </div>


            {{-- Invoice Number --}}
            <div class="flex flex-col w-full gap-3 lg:w-1/3">

                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Invoice Number
                    </span>
                    <input type="text" id="invoice_number" type="text" name="invoice_number" disabled
                        :value="old('invoice_number')" required wire:model="number" autocomplete="invoice_number"
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Invoice Date
                    </span>
                    {{-- <x-text-input id="invoice_date"  type="text" name="invoice_date"
                        :value="old('invoice_date')" required wire:model="invoice_date"  autocomplete="invoice_date" /> --}}
                    <input id="invoice_date" type="text" name="invoice_date" :value="old('invoice_date')" required
                        wire:model="invoice_date" autocomplete="invoice_date"
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Due Date
                    </span>
                    {{-- <x-text-input id="due_date" type="text" name="due_date" :value="old('due_date')" required
                        wire:model="due_date"  autocomplete="due_date" /> --}}
                    <input id="due_date" type="text" name="due_date" :value="old('due_date')" required
                        wire:model="due_date" autocomplete="due_date"
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

            </div>
        </div>
        {{-- <hr class="px-10 my-10"> --}}

        <div class="w-full py-4 overflow-x-auto">

            <table
                class="w-full mx-auto mt-3 text-sm text-left text-gray-500 table-fixed lg:table-auto dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-white bg-gray-500 dark:text-white">
                        <th class="w-10 px-6 py-3">#</th>
                        <th class="px-6 py-3 w-80">Package</th>
                        <th class="px-6 py-3 w-60">Price</th>
                        <th class="px-6 py-3 w-60">Qty</th>
                        <th class="px-6 py-3 w-60">Amount</th>
                        <th class="w-20 px-6 py-3">
                            @if ($customer_id == '')
                                <button wire:click="add_row" class="button button-gray" disabled>Add</button>
                            @else
                                <button wire:click="add_row" class="button button-blue">Add</button>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($invoices))
                        @foreach ($invoices as $index => $invoice)
                            <tr x-data="{ packageManual: false }" @dblclick="packageManual = !packageManual"
                                class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                @if ($index == 0 && $contract != '')
                                    <td class="px-6 py-4">
                                        <div class="w-full ">
                                            <x-text-input class="w-full mt-1 marker:block" type="text" name="package"
                                                wire:model.lazy="invoices.{{ $index }}.package" />
                                        </div>
                                    </td>
                                @else
                                    <td class="px-6 py-4">

                                        <div class="w-full " x-show="!packageManual">
                                            <select wire:model="invoices.{{ $index }}.package"
                                                wire:change="updatePrice({{ $index }})"
                                                class="w-72  bg-gray-50 border rounded-lg border-gray-300 text-gray-600
                    text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="">Select Package</option>
                                                @foreach ($packageData as $p)
                                                    <option value="{{ $p->package }}">{{ $p->package }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- input package manual --}}
                                        <div class="w-full " x-show="packageManual">
                                            <x-text-input class="w-full mt-1 marker:block" type="text" name="package"
                                                :value="old('package')" required
                                                wire:model.lazy="invoices.{{ $index }}.package"
                                                autocomplete="package" />
                                        </div>
                                        {{-- </div> --}}
                                    </td>
                                @endif
                                <td class="px-6 py-4">
                                    {{-- input price --}}
                                    <div>
                                        <x-text-input class="block w-full mt-1 text-right" type="text" name="price"
                                            onchange="Calc(this);" :value="old('price')"
                                            wire:model.lazy="invoices.{{ $index }}.price"
                                            autocomplete="price" />
                                        {{-- <input type="text" wire:model.lazy="invoices.{{ $index }}.price"> --}}

                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{-- input Qty --}}
                                    <div>
                                        <x-text-input class="block w-full mt-1 text-right" type="number" name="qty"
                                            onchange="Calc(this);" :value="old('qty')" required
                                            wire:model.lazy="invoices.{{ $index }}.qty" autocomplete="qty" />
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{-- Amount --}}
                                    <div>
                                        <x-text-input class="block w-full mt-1 text-right" type="text"
                                            name="amount" disabled onchange="Calc(this);" />
                                    </div>
                                </td>
                                @if ($index != 0)
                                    <td class="px-6 py-4">
                                        <div>
                                            <button wire:click="delete_row({{ $index }})"
                                                onclick="btnDel(this);" class="button button-red">-</button>
                                        </div>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="flex justify-between w-full mt-3">
            <div>
            </div>
            <div class="flex flex-col w-full gap-2 lg:w-1/4 ">
                {{-- Sub Total --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Sub Total
                    </span>
                    <input type="text" id="subtotal" disabled
                        class="text-right rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                {{-- Discount --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Discount
                    </span>
                    <input type="text" id="discount" :value="old('discount')" onchange="getTotal()" required
                        wire:model="discount" autocomplete="discount"
                        class="text-right rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                {{-- Tax --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Tax
                    </span>
                    <select wire:model="tax" id="tax" onchange="getTotal()"
                        class="w-full  bg-gray-50 border  border-gray-300 text-gray-600 rounded-none rounded-r-lg
                        text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="0" selected>Without Tax</option>
                        <option value="2.5">2.5%</option>
                    </select>
                </div>

                {{-- Discount --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Total
                    </span>
                    <input type="text" id="total" disabled onchange="getTotal()"
                        class="text-right rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex justify-between my-3 ">
                    <x-blue-button wire:click="saveInvoice">
                        {{ __('Save') }}
                    </x-blue-button>
                    <a href="/invoice">
                        <x-primary-button>
                            {{ __('Back') }}
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>

        <div class="invisible mb-5">
            <hr class="invisible mt-5">
        </div>





        {{-- </form> --}}
        @push('script')
            <script>
                function btnDel(v) {
                    $(v).parent().parent().parent().remove();
                    getTotal();
                }

                function Calc(v) {
                    var index = $(v).parent().parent().parent().index();
                    var qty = document.getElementsByName("qty")[index].value;
                    var price = document.getElementsByName("price")[index].value;
                    var amount = qty * price;
                    document.getElementsByName('amount')[index].value = amount;
                    // var subtotal = qty * price;
                    // document.getElementsByName('subtotal')[index].value = subtotal;
                    getTotal();
                }

                function getTotal() {
                    var sum = 0;
                    var amounts = document.getElementsByName("amount");
                    // var tax = document.getElementsByName("tax").value;
                    // var discount = document.getElementsByName("discount").value;
                    for (let index = 0; index < amounts.length; index++) {
                        var amount = amounts[index].value;
                        sum = +(sum) + +(amount);
                    }
                    document.getElementById("subtotal").value = sum.toLocaleString('en');
                    var tax = document.getElementById("tax").value;
                    var discount = document.getElementById("discount").value;
                    var total = (sum - discount) / (100 - tax) * 100;
                    var roundedTotal = Math.round(total / 1000) * 1000;
                    document.getElementById("total").value = roundedTotal.toLocaleString('en');
                }
            </script>
        @endpush
    </div>
</div>
