<div x-data="{ openModal: false }">
    @section('title', 'Contract')
    <div x-show="openModal">
        @include('modal.detailContractModal')
    </div>
    <div x-show="!openModal">


        <h1 class="my-5 text-2xl font-semibold text-center">Contracts</h1>
        {{-- per Page --}}
        <div class="flex justify-between px-10">
            <x-text-input id="search" class="block w-full mt-1 lg:w-1/5" type="search" name="search" :value="old('search')"
                required wire:model.debounce.500ms="search" autofocus autocomplete="search"
                placeholder="Search Contracts ..." />
            <select id="perPage" wire:model="perpage"
                class="hidden  w-full lg:w-1/6 bg-gray-50 border rounded-lg border-gray-300 text-gray-600 text-sm  focus:ring-blue-500 focus:border-blue-500 lg:block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="5">5 rows</option>
                <option value="10">10 rows</option>
                <option value="15">15 rows</option>
                <option value="20">20 rows</option>
                <option value="25">25 rows</option>
            </select>
        </div>
        <div class="relative px-10 mt-5 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 table-auto dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-white bg-gray-500 dark:text-white">
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Number</th>
                        <th scope="col" class="px-6 py-3">Customer</th>
                        <th scope="col" class="px-6 py-3">Package</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Start Date</th>
                        <th scope="col" class="px-6 py-3">End Date</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Created At</th>
                        <td scope="col" class="px-6 py-3">
                            <a href="/createcontract"><button class="button button-blue">Create Contract</button></a>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data))
                        @foreach ($data as $d)
                            <tr
                                class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">
                                    {{ $loop->iteration }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">
                                    {{ contractNumberFormat($d->contract_number, $d->contract_date) }}
                                </td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">
                                    {{ getCompany($d->customer_id) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">
                                    {{ $d->package }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">
                                    {{ number_format($d->price) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">{{ tanggal($d->contract_begin) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">{{ tanggal($d->contract_end) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">{{ $d->status }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->contract_number }})"
                                    class="px-6 py-4">{{ tanggal($d->created_at) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="/updatecontract/{{ $d->contract_number }}"><button
                                                class="button button-teal">Update</button></a>

                                        <button wire:click="deleteConfirmation({{ $d->contract_number }})"
                                            class="button button-red">Delete</button>
                                        @if ($d->pdf != null)
                                            <button wire:click="downloadpdf({{ $d->contract_number }})"
                                                class="button button-blue">Download</button>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                            <td class="px-6 py-4">No Data Found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
