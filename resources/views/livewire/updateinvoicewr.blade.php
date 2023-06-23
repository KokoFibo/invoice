<div class="p-3">
    <div class="w-full mx-auto mt-3 text-black bg-white shadow lg:w-3/4 rounded-xl border-1">
        <h2 class="py-3 text-2xl font-semibold text-center">Update Invoice</h2>
    </div>
    @if (Session::has('message'))
        <script>
            // toastr.success("{{ 'message' }}");
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data Updated',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <div class="w-full p-3 mx-auto mt-3 text-black bg-white shadow lg:w-3/4 rounded-xl border-1">
        <div class="flex flex-col items-start justify-between w-full gap-3 lg:flex-row">
            <div class="flex flex-col w-full gap-3 lg:w-1/3">

                {{-- customer --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Customer
                    </span>
                    <input id="discount" type="text" name="discount" disabled wire:model="company"
                        {{ $updateUpper ? '' : 'disabled' }}
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">


                </div>

                {{-- Contract --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Contract
                    </span>
                    <select wire:model="contract" {{ $updateUpper ? '' : 'disabled' }}
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border  border-gray-300 text-gray-600
                text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        @if ($dataContract != null)
                            @foreach ($dataContract as $c)
                                <option value="{{ $c->contract_number }}">
                                    {{ contractNumberFormat($c->contract_number, $contract_date) }}</option>
                            @endforeach
                        @endif
                        <option value="">Without Contract</option>
                    </select>
                </div>
                <div class="flex">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Discount
                    </span>

                    <input id="discount" type="text" name="discount" :value="old('discount')" required
                        wire:model="discount" autocomplete="discount" {{ $updateUpper ? '' : 'disabled' }}
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </div>



                <div class="flex">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">

                        Tax
                    </span>

                    {{-- <input id="tax" type="text" name="tax" :value="old('tax')" required wire:model="tax"
                        autocomplete="tax" {{ $updateUpper ? '' : 'disabled' }}
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}

                    <select wire:model="tax" {{ $updateUpper ? '' : 'disabled' }}
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border  border-gray-300 text-gray-600
                text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="0">0%</option>
                        <option value="2.5">2.5%</option>
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
                        :value="old('invoice_number')" required wire:model="invoice_number"
                        autocomplete="invoice_number"
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
                        wire:model="invoice_date" autocomplete="invoice_date" {{ $updateUpper ? '' : 'disabled' }}
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
                        wire:model="due_date" autocomplete="due_date" {{ $updateUpper ? '' : 'disabled' }}
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                {{-- Contract --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Status
                    </span>
                    <select wire:model="status" {{ $updateUpper ? '' : 'disabled' }}
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border  border-gray-300 text-gray-600
                text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="Draft">Draft</option>
                        <option value="Emailed">Emailed</option>
                        <option value="Paid">Paid</option>
                        <option value="Uncollectible">Uncollectible</option>
                    </select>
                </div>

                <div class="flex justify-between">
                    @if ($updateUpper == false)
                        <button class="button button-blue" wire:click="editUpper">Edit</button>
                        <button class="button button-black" wire:click="back">Back</button>
                    @else
                        <button class="button button-teal" wire:click="updateUpper">Update</button>
                        <button class="button button-black" wire:click="cancel">Back</button>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- table --}}

    <div class="w-full py-4 overflow-x-auto">

        <table class="w-full mx-auto mt-3 text-sm text-left text-gray-500 table-fixed lg:table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-white bg-gray-500 dark:text-white">
                    <th class="w-10 px-6 py-3">#</th>
                    <th class="px-6 py-3 w-80">Package</th>
                    <th class="px-6 py-3 w-28">Price</th>
                    <th class="px-6 py-3 w-28">Qty</th>
                    <th class="px-6 py-3 w-28">Amount</th>
                    <th class="w-40 px-6 py-3">
                        <a href="/addinvoice/{{ $number }}"><button class="button button-blue">Add</button></a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                @endphp
                @foreach ($invoice as $i)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $i->package }}</td>
                        <td class="px-6 py-4">{{ number_format($i->price) }}</td>
                        <td class="px-6 py-4">{{ number_format($i->qty) }}</td>
                        <td class="px-6 py-4">{{ number_format($i->price * $i->qty) }}</td>
                        @php
                            $subtotal = $subtotal + $i->price * $i->qty;
                        @endphp
                        <td>
                            <div class="flex gap-3">
                                <a href="/updatedetailinvoice/{{ $i->id }}/{{ $i->number }}"><button
                                        class="button button-teal">Edit</button></a>

                                <button class="button button-red"
                                    wire:click="deleteConfirmation({{ $i->id }})">Delete</button>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-between w-full px-3 mt-3 mb-5">
        <div></div>
        <div class="flex flex-col w-full gap-2 lg:w-1/4">
            <div class="flex ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Sub Total
                </span>
                <div
                    class="text-right rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p>{{ number_format($subtotal) }}</p>

                </div>
            </div>

            <div class="flex ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Discount
                </span>
                <div
                    class="text-right rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p> {{ number_format($discount) }} </p>
                </div>
            </div>

            <div class="flex ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Tax
                </span>
                <div
                    class="text-right rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p>{{ number_format($tax, 1) }}</p>
                    {{-- <p>{{ $formattedTax }}</p> --}}
                </div>
            </div>

            <div class="flex ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Total
                </span>
                <div
                    class="w-56 text-right rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0  text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p>{{ number_format(roundedTotal($subtotal, $discount, $tax)) }}</p>
                </div>
            </div>

            <button class="w-20 my-3 button button-black" wire:click="back">Back</button>
        </div>
    </div>

</div>
