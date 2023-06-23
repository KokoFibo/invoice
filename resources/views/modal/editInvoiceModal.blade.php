<div x-show="openModal">
    <x-modalCustom>
        <div>
            <p>Package: {{ $package }}</p>
            <p>Price :{{ $price }}</p>
            <p>Qty: {{ $qty }}</p>
            <div class="w-full p-3 mt-5">
                {{-- Package --}}
                <div class="flex w-full ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Package
                    </span>

                    <select wire:model="package"
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border  border-gray-300 text-gray-600
                    text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        {{-- @if ($packages != null) --}}
                        @foreach ($packages as $p)
                            <option value="{{ $p->package }}">{{ $p->package }}</option>
                        @endforeach
                        {{-- @endif --}}
                        <option value="">Without Contract</option>
                    </select>
                </div>
                {{-- Price --}}
                <div class="flex">
                    <span
                        class="inline-flex items-center w-24 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">

                        {{-- class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"> --}}
                        Price
                    </span>

                    <input id="price" type="text" name="price" :value="old('price')" required
                        wire:model="price" autocomplete="price"
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </div>
                {{-- Qty --}}
                <div class="flex">
                    <span
                        class="inline-flex items-center w-24 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">

                        {{-- class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"> --}}
                        Quantity
                    </span>

                    <input id="qty" type="text" name="qty" :value="old('qty')" required wire:model="qty"
                        autocomplete="qty"
                        class="w-full rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </div>
                <div class="flex gap-2">
                    <button class="button button-teal" wire:click="updateLower">Update</button>
                    <button class="button button-black" @click="openModal=false">Cancel</button>
                </div>
            </div>


        </div>

    </x-modalCustom>

</div>
