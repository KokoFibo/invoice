<div x-data="{ openModal: false }">
    @section('title', 'Invoice')

    <div x-show="openModal">
        @include('modal.detailInvoiceModal')
    </div>
    <div x-show="!openModal">
        <h1 class="my-5 text-2xl font-semibold text-center">Invoice</h1>
        {{-- per Page --}}
        <div class="flex justify-between px-10">
            <x-text-input id="search" class="block w-full mt-1 lg:w-1/5" type="search" name="search" :value="old('search')"
                required wire:model.debounce.500ms="search" autofocus autocomplete="search"
                placeholder="Search Company ..." />

            <a href="/auto-generate-invoice">
                <x-blue-button>Create & Email Yifang Invoices
                </x-blue-button>
            </a>
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
                        <th scope="col" class="px-6 py-3">Total</th>
                        <th scope="col" class="px-6 py-3">Invoice Date</th>
                        <th scope="col" class="px-6 py-3">Due Date</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">
                            <a href="/createinvoice">
                                <x-blue-button>Create Invoice
                                </x-blue-button>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data))
                        @foreach ($data as $key => $d)
                            <tr
                                class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">
                                    {{ $loop->iteration }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">
                                    {{ invNumberFormat($d->number, $d->invoice_date) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">{{ getCompany($d->customer_id) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4 text-right">
                                    {{ number_format(getTotal($d->number)) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">{{ tanggal($d->invoice_date) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">{{ tanggal($d->due_date) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">
                                    @if ($d->status == 'Draft')
                                        <button
                                            class="bg-orange-500 text-white text-sm font-medium mr-2 px-1 py-0.5 rounded">{{ $d->status }}</button>
                                    @elseif($d->status == 'Emailed')
                                        <button
                                            class="bg-blue-500 text-white text-sm font-medium mr-2 px-1 py-0.5 rounded">{{ $d->status }}</button>
                                    @elseif($d->status == 'Contract')
                                        <button
                                            class="bg-green-500 text-white text-sm font-medium mr-2 px-1 py-0.5 rounded">{{ $d->status }}</button>
                                    @else
                                        <button
                                            class="bg-black text-white text-sm font-medium mr-2 px-1 py-0.5 rounded">{{ $d->status }}</button>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex gap-1 px-3">
                                        <a href="/updateinvoice/{{ $d->number }}"><button
                                                class="px-3 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700">Update</button></a>
                                        <button wire:click="deleteConfirmation({{ $d->number }})"
                                            class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">Delete</button>
                                        <a href="/pdftemplate/{{ $d->number }}"> <button
                                                class="px-3 py-2 text-white bg-teal-500 rounded-lg hover:bg-teal-700">Email</button></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                            <td class="px-6 py-4">
                                <h4 class="text-xl">Sorry, no data found</h4>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{ $data->links() }}
            </div>
        </div>
    </div>


    @push('script')
        <script>
            $(document).ready(function() {
                // toastr.options.timeOut = 5000;
                @if (Session::has('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Fail Sending Email!',
                        footer: 'Unknown Email Address'
                    })
                    // toastr.error('{{ Session::get('error') }}');
                @elseif (Session::has('success'))
                    toastr.options.timeOut = 5000;
                    toastr.success('{{ Session::get('success') }}');
                @endif
            });
        </script>
    @endpush
</div>
</div>
