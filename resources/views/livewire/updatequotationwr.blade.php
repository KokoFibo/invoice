<div class="p-3">
    <div class="w-full mx-auto mt-3 text-black bg-white shadow lg:w-3/4 rounded-xl border-1">
        <h2 class="py-3 text-2xl font-semibold text-center">Update Quotation</h2>
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
        <div class="flex flex-col items-start justify-between w-full gap-3 lg:flex-row ">
            <div class="flex flex-col w-full gap-3 lg:w-1/3">
                <div class="flex w-full ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Number

                    </span>
                    <input type="text" id="quotation_number" type="text" name="quotation_number" disabled
                        :value="old('quotation_number')" required wire:model="quotation_number"
                        autocomplete="quotation_number"
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                {{-- customer --}}
                <div class="flex w-full">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Customer
                    </span>
                    <select wire:model="customer_id" {{ $updateUpper ? '' : 'disabled' }}
                        class="rounded-none rounded-r-lg w-full  bg-gray-50 border  border-gray-300 text-gray-600
        text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select Customer</option>
                        @foreach ($customer as $c)
                            <option value="{{ $c->id }}">{{ $c->company }}</option>
                        @endforeach
                    </select>
                </div>

            </div>


            {{-- Invoice Number --}}
            <div class="flex flex-col w-full gap-3 lg:w-1/3">


                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Quotation Date
                    </span>
                    {{-- <x-text-input id="quotation_date"  type="text" name="quotation_date"
                        :value="old('quotation_date')" required wire:model="quotation_date"  autocomplete="quotation_date" /> --}}
                    <input id="quotation_date" type="text" name="quotation_date" :value="old('quotation_date')"
                        required wire:model="quotation_date" autocomplete="quotation_date"
                        {{ $updateUpper ? '' : 'disabled' }}
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>


                {{-- Status --}}
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


    <div class="w-full p-3 py-4 mx-auto mt-3 overflow-x-auto text-black bg-white shadow lg:w-3/4 rounded-xl border-1">

        <table class="w-full mt-3 text-sm text-left text-gray-500 table-fixed lg:table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-white bg-gray-500 dark:text-white">
                    <th class="w-10 px-6 py-3 ">#</th>
                    <th class="px-6 py-3 w-80 ">Package</th>
                    <th class="px-6 py-3 w-60 ">Price</th>
                    <th class="px-6 py-3 w-96 ">Description</th>
                    <th class="w-40 px-6 py-3 ">
                        <a href="/addquotation/{{ $number }}"><button class="button button-blue">Add</button></a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                @endphp
                @foreach ($quotation as $i)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                        <td class="px-6 py-4 ">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $i->package }}</td>
                        <td class="px-6 py-4">{{ number_format($i->price) }}</td>
                        <td class="px-6 py-4">{{ $i->description }}</td>

                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="/updatedetailquotation/{{ $i->id }}/{{ $i->number }}"><button
                                        class="button button-teal">Edit</button></a>

                                <button class="button button-red"
                                    wire:click="deleteConfirmation({{ $i->id }})">Delete</button>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-between">
            <div></div>
            <button class="w-20 my-3 button button-black" wire:click="back">Back</button>
        </div>
    </div>

</div>
