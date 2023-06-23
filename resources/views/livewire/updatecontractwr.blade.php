<div class="p-3">
    <div class="w-full mx-auto mt-3 text-black bg-white shadow lg:w-3/4 rounded-xl border-1">
        <h2 class="py-3 text-2xl font-semibold text-center">Update Contract</h2>
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
                {{-- customer_id --}}
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Company
                    </span>
                    <select wire:model="customer_id" {{ $updateUpper ? '' : 'disabled' }}
                        class=" w-full  bg-gray-50 border  border-gray-300 text-gray-600 rounded-none rounded-r-lg
        text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select Company</option>
                        @foreach ($customer as $c)
                            <option value="{{ $c->id }}">{{ $c->company }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Contract Number --}}

                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Contract Number
                    </span>
                    <input type="text" id="contract_number_full" type="text" name="contract_number_full" disabled
                        {{ $updateUpper ? '' : 'disabled' }} required wire:model="contract_number_full"
                        autocomplete="contract_number_full"
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex" x-data="{ fileUpload: false }" @dblclick="fileUpload = !fileUpload">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Upload PDF
                    </span>
                    @if ($prevPdf)
                        <div x-show="!fileUpload"
                            class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <p>yellow {{ $prevPdf }} </p>
                        </div>
                        <div x-show="fileUpload">
                            <input type="file" wire:model="pdf" {{ $updateUpper ? '' : 'disabled' }}
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('pdf')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <input type="file" wire:model="pdf" {{ $updateUpper ? '' : 'disabled' }}
                            class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('pdf')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    @endif
                </div>

            </div>
            <div class="flex flex-col w-full gap-3 lg:w-1/3">
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Contract Begin
                    </span>
                    <input id="contract_begin" type="date" name="contract_begin" :value="old('contract_begin')"
                        {{ $updateUpper ? '' : 'disabled' }} required wire:model="contract_begin"
                        autocomplete="contract_begin"
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Contract End
                    </span>
                    <input id="contract_end" type="date" name="contract_end" :value="old('contract_end')" required
                        {{ $updateUpper ? '' : 'disabled' }} wire:model="contract_end" autocomplete="contract_end"
                        class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex ">
                    <span
                        class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Status
                    </span>
                    <select wire:model="status" {{ $updateUpper ? '' : 'disabled' }}
                        class=" w-full  bg-gray-50 border  border-gray-300 text-gray-600 rounded-none rounded-r-lg
        text-sm focus:ring-blue-500 focus:border-blue-500 lg:block p-2.5 dark:bg-gray-700 dark:border-gray-600
        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Choose Status</option>

                        @if ($prevStatus == 'Sent')
                            <option value="Signed">Signed</option>
                        @endif
                        @if ($prevStatus == 'Signed' || $prevStatus == 'Sent')
                            <option value="Done">Done</option>
                        @endif
                        <option value="Cancel">Cancel</option>
                    </select>
                </div>
                <div class="flex justify-between">
                    @if ($updateUpper == false)
                        <button class="button button-blue" wire:click="editUpper">Edit</button>
                        <button class="button button-black" wire:click="back">Back</button>
                    @else
                        <button class="button button-teal" wire:click="updateUpper">Update</button>
                        <button class="button button-black" wire:click="back">Back</button>
                    @endif
                </div>
            </div>
        </div>


    </div>
    {{-- table --}}
    <div class="w-full py-4 overflow-x-auto lg:w-34">
        <table
            class="w-full mx-auto mt-3 text-sm text-left text-gray-500 table-fixed lg:w-3/4 lg:table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-white bg-gray-500 dark:text-white">
                    <th class="w-10 px-6 py-3">#</th>
                    <th class="px-6 py-3 w-80">Package</th>
                    <th class="px-6 py-3 w-60">Price</th>
                    <th class="px-6 py-3 w-60">Qty</th>
                    <th class="px-6 py-3 w-96">Description</th>
                    <th class="w-40 px-6 py-3">
                        <a href="/addcontract/{{ $contract_number }}"><button
                                class="button button-blue">Add</button></a>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contract as $i)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $i->package }}</td>
                        <td class="px-6 py-4">{{ number_format($i->price) }}</td>
                        <td class="px-6 py-4">{{ number_format($i->qty) }}</td>
                        <td class="px-6 py-4">{{ $i->description }}</td>

                        <td>
                            <div class="flex gap-2">

                                <a href="/updatedetailcontract/{{ $i->id }}/{{ $i->contract_number }}"><button
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
    <div class="flex justify-between">
        <div></div>
        <button class="w-20 my-3 button button-black" wire:click="back">Back</button>
    </div>


</div>
