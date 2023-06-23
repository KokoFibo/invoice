<div x-show="createInvoice" class="w-3/4" x-cloak>
    <x-modalCustom>
        <h2 class="mt-3 text-2xl font-semibold text-center">Create Invoice</h2>
        <hr class="px-3 my-2">


        <div class="p-3">
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
            <x-input-error :messages="$errors->get('customer')" class="mt-2" />
        </div>
        <div class="p-3">
            <x-input-label for="package" :value="__('Package')" />
            <select wire:model="package_id"
                class="w-full  bg-gray-50 border rounded-lg border-gray-300 text-gray-600
            text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Select Package</option>
                @foreach ($packageData as $p)
                    <option value="{{ $p->id }}">{{ $p->package }}</option>
                @endforeach
            </select>
            {{-- <x-text-input id="package" class="block w-full mt-1" type="text" name="package" :value="old('package')"
                required wire:model="package" autofocus autocomplete="package" /> --}}
            <x-input-error :messages="$errors->get('package')" class="mt-2" />
        </div>
        <div class="p-3">
            <x-input-label for="price" :value="__('Price')" />

            <x-text-input id="price" class="block w-full mt-1" type="text" name="price" :value="old('price')"
                required wire:model="price" autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        <div class="p-3">
            <x-input-label for="qty" :value="__('Qty')" />
            <x-text-input id="qty" class="block w-full mt-1" type="text" name="qty" :value="old('qty')"
                required wire:model="qty" autofocus autocomplete="qty" />
            <x-input-error :messages="$errors->get('qty')" class="mt-2" />
        </div>
        <div class="p-3">
            <x-input-label for="tax" :value="__('Tax')" />
            <select wire:model="tax"
                class="w-full  bg-gray-50 border rounded-lg border-gray-300 text-gray-600
            text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="0" selected>No Tax</option>
                <option value="2.5">2.5%</option>
            </select>
            <x-input-error :messages="$errors->get('tax')" class="mt-2" />
        </div>


        <div class="flex justify-between">
            <x-blue-button class="m-3" @click="createInvoice=false" wire:click="saveInvoice">
                {{ __('Save') }}
            </x-blue-button>
            <x-primary-button class="m-3" @click="createInvoice=false">
                {{ __('Cancel') }}
            </x-primary-button>
        </div>


    </x-modalCustom>
</div>
