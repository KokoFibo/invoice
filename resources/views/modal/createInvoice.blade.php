<div x-show="createInvoice" x-cloak class="w-3/4 mx-auto text-black bg-white" style="height: 100vh;">
    <h2 class="mt-3 text-2xl font-semibold text-center">Create Invoice</h2>

    <hr class="px-3 my-2">
    <div class="flex items-start justify-between w-full px-10 ">
        {{-- customer --}}
        <div class="w-1/3 ">
            <div class="p-3 ">
                <x-input-label for="customer" :value="__('Customer')" />
                {{-- <x-text-input id="customer" class="block w-full mt-1" type="text" name="customer" :value="old('customer')" required
                wire:model="customer_id" autofocus autocomplete="customer" /> --}}

                <select wire:model="customer_id"
                    class="w-full  bg-gray-50 border rounded-lg border-gray-300 text-gray-600
            text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select Customer</option>
                    @foreach ($customer as $c)
                        <option value="{{ $c->id }}">{{ $c->company }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
            </div>

            <div class="p-3 ">
                <x-input-label for="contract" :value="__('Contract ')" />

                <select wire:model="contract"
                    class="w-full  bg-gray-50 border rounded-lg border-gray-300 text-gray-600
            text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    @if ($dataContract != null)
                        @foreach ($dataContract as $c)
                            <option value="{{ $c->contract_number }}">{{ $c->contract_number }}</option>
                        @endforeach
                    @endif
                    <option value="">Without Contract</option>


                </select>
                <x-input-error :messages="$errors->get('contract')" class="mt-2" />
            </div>
            <div class="p-3">
                <x-input-label for="tax" :value="__('Tax')" />
                <select wire:model="tax"
                    class="w-full  bg-gray-50 border rounded-lg border-gray-300 text-gray-600
                    text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0" selected>Without Tax</option>
                    <option value="2.5">2.5%</option>
                </select>
                <x-input-error :messages="$errors->get('tax')" class="mt-2" />
            </div>
            <div class="p-3">
                <x-input-label for="discount" :value="__('Discount')" />
                <x-text-input id="discount" class="block w-full mt-1" type="text" name="discount" :value="old('discount')"
                    required wire:model="discount" autofocus autocomplete="discount" />
                <x-input-error :messages="$errors->get('discount')" class="mt-2" />
            </div>
        </div>
        {{-- Invoice Number --}}
        <div class="w-1/3 ">
            <div class="p-3">
                <x-input-label for="invoice_number" :value="__('Invoice Number')" />
                <x-text-input id="invoice_number" class="block w-full mt-1" type="text" name="invoice_number"
                    :value="old('invoice_number')" required wire:model="number" autofocus autocomplete="invoice_number" />
            </div>
            <div class="p-3">
                <x-input-label for="invoice_date" :value="__('Invoice Date')" />
                <x-text-input id="invoice_date" class="block w-full mt-1" type="text" name="invoice_date"
                    :value="old('invoice_date')" required wire:model="invoice_date" autofocus autocomplete="invoice_date" />
            </div>
            <div class="p-3">
                <x-input-label for="due_date" :value="__('Due Date')" />
                <x-text-input id="due_date" class="block w-full mt-1" type="text" name="due_date" :value="old('due_date')"
                    required wire:model="due_date" autofocus autocomplete="due_date" />
            </div>

        </div>
    </div>
    <hr class="px-10 my-10">
    <div class="flex justify-between w-full px-10">
        <div></div>
        <div class="p-3 ">
            @if ($customer_id == '')
                <button wire:click="add_row" class="button button-gray" disabled>+</button>
            @else
                <button wire:click="add_row" class="button button-blue">+</button>
            @endif
        </div>
    </div>

    {{-- <input type="hidden" wire:model="invoices.{{ $index }}.customer_id" value="{{ $customer_id }}">
            <input type="hidden" wire:model="invoices.{{ $index }}.contract" value="{{ $contract }}">
            <input type="hidden" wire:model="invoices.{{ $index }}.tax" value="{{ $tax }}">
            <input type="hidden" wire:model="invoices.{{ $index }}.discount" value="{{ $discount }}">
            <input type="hidden" wire:model="invoices.{{ $index }}.number" value="{{ $number }}">
            <input type="hidden" wire:model="invoices.{{ $index }}.invoice_date" value="{{ $invoice_date }}">
            <input type="hidden" wire:model="invoices.{{ $index }}.due_date" value="{{ $due_date }}"> --}}
    @if (!empty($invoices))
        @foreach ($invoices as $index => $invoice)
            <div class="flex items-center w-full px-10 mx-auto justify-evenly" x-cloak>
                <div class="w-1/2 p-3" x-data="{ packageManual: false }" @dblclick="packageManual = !packageManual ">
                    <div class="w-full " x-show="!packageManual">
                        <x-input-label for="package" :value="__('Package')" />
                        <select wire:model="invoices.{{ $index }}.package"
                            class="w-full  bg-gray-50 border rounded-lg border-gray-300 text-gray-600
            text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Package</option>
                            @foreach ($packageData as $p)
                                <option value="{{ $p->package }}">{{ $p->package }}</option>
                            @endforeach
                        </select>
                        {{-- <x-text-input id="package" class="block w-full mt-1" type="text" name="package" :value="old('package')"
                required wire:model="package" autofocus autocomplete="package" /> --}}
                        <x-input-error :messages="$errors->get('package')" class="mt-2" />
                    </div>
                    {{-- input package manual --}}
                    <div class="w-full " x-show="packageManual">
                        <x-input-label for="package" :value="__('Package')" />

                        <x-text-input id="package" class="block w-full mt-1" type="text" name="package"
                            :value="old('package')" required wire:model.debounce.500ms="invoices.{{ $index }}.package"
                            autofocus autocomplete="package" />

                        <x-input-error :messages="$errors->get('package')" class="mt-2" />
                    </div>
                </div>
                {{-- input price --}}
                <div class="w-1/4 p-3">
                    <x-input-label for="price" :value="__('Price')" />

                    <x-text-input id="price" class="block w-full mt-1" type="text" name="price"
                        :value="old('price')" required wire:model.debounce.500ms="invoices.{{ $index }}.price"
                        autofocus autocomplete="price" />

                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                {{-- input Qty --}}
                <div class="w-1/4 p-3">
                    <x-input-label for="qty" :value="__('Qty')" />
                    <x-text-input id="qty" class="block w-full mt-1" type="text" name="qty"
                        :value="old('qty')" required wire:model="invoices.{{ $index }}.qty" autofocus
                        autocomplete="qty" />
                    <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                </div>
                <div class="p-3 ">
                    <button wire:click="delete_row({{ $index }})" class="button button-red">-</button>
                </div>
            </div>
        @endforeach
    @endif

    {{-- <div class="relative w-full px-10 mx-auto mt-5 overflow-x-auto">
        <table class="w-full mx-auto text-sm text-left text-gray-500 table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-white bg-gray-500 dark:text-white">
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Customer</th>
                    <th scope="col" class="px-6 py-3">Package</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $index => $invoice)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4"><input wire:model="invoices.{{ $index }}.customer"></td>
                        <td class="px-6 py-4"><input wire:model="invoices.{{ $index }}.package"></td>
                        <td class="px-6 py-4"><input wire:model="invoices.{{ $index }}.price"></td>
                        <td class="px-6 py-4"><input wire:model="invoices.{{ $index }}.qty"></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="flex justify-between px-10 ">
        <div>

        </div>
        <div class="flex gap-2 ">
            <div>
                <h3>Sub Total</h3>
                <h3>Discount</h3>
                <h3>Tax Rate</h3>
                <h3>Total</h3>
            </div>
            <div>
                <h3>Rp.</h3>
                <h3>Rp.</h3>
                <h3>%</h3>
                <h3>Rp.</h3>
            </div>
            <div>
                <h3 class="text-right">10,000,000</h3>
                <h3 class="text-right">{{ $discount }}</h3>
                <h3 class="text-right">{{ $tax }}%</h3>
                <h3 class="text-right">9,743,000</h3>
            </div>
        </div>
    </div> --}}




    <div class="flex justify-between w-3/4 mx-auto">
        <x-blue-button class="m-3" wire:click="saveInvoice">
            {{ __('Save') }}
        </x-blue-button>
        <x-primary-button class="m-3" @click="[createInvoice= false, main= true]">
            {{ __('Cancel') }}
        </x-primary-button>
    </div>
    {{-- </form> --}}
</div>
