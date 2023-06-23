<div x-data="{ openModal: false }">
    @section('title', 'Quotation')
    <div x-show="openModal">
        @include('modal.detailQuotationModal')
    </div>
    <div x-show="!openModal">

        {{-- <div class="px-10 mx-auto mt-3 text-black bg-white shadow rounded-xl border-1">
            <h2 class="py-3 text-2xl font-semibold text-center">Quotation</h2>
        </div> --}}
        <h1 class="my-5 text-2xl font-semibold text-center">Quotation</h1>
        {{-- per Page --}}
        <div class="flex justify-between px-10">
            <x-text-input id="search" class="block w-full mt-1 lg:w-1/5" type="search" name="search" :value="old('search')"
                required wire:model.debounce.500ms="search" autofocus autocomplete="search"
                placeholder="Search Company ..." />
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
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">
                            <a href="/createquotation"><button
                                    class="px-3 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700">Create
                                    Quotation</button></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data))

                        @foreach ($data as $key => $d)
                            <tr
                                class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">{{ quoNumberFormat($d->number, $d->quotation_date) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">{{ getCompany($d->customer_id) }}</td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">
                                    @php
                                        $packages = getQuotationData($d->number);

                                    @endphp


                                    <ul>
                                        @if (count($packages) <= 1)
                                            @foreach ($packages as $p)
                                                {{ $p->package }}
                                            @endforeach
                                        @else
                                            @foreach ($packages as $p)
                                                <li class="list-disc">
                                                    {{ $p->package }}
                                                </li>
                                            @endforeach
                                        @endif

                                    </ul>
                                </td>
                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">
                                    @php
                                        $prices = getQuotationData($d->number);
                                    @endphp
                                    <ul>
                                        @if (count($packages) <= 1)
                                            @foreach ($prices as $p)
                                                {{ number_format($p->price) }}
                                            @endforeach
                                        @else
                                            @foreach ($prices as $p)
                                                <li class="list-disc">
                                                    {{ number_format($p->price) }}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </td>

                                <td @dblclick="openModal=true" wire:click="viewdata({{ $d->number }})"
                                    class="px-6 py-4">{{ tanggal($d->quotation_date) }}</td>

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

                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="/updatequotation/{{ $d->number }}"><button
                                                class="px-3 py-2 text-white bg-teal-500 rounded-lg hover:bg-teal-700">Update</button></a>
                                        <button wire:click="deleteConfirmation({{ $d->number }})"
                                            class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">Delete</button>
                                        <a href="/quotationtemplate/{{ $d->number }}"><button
                                                class="px-3 py-2 text-white bg-blue-500 rounded-lg hover:bg-red-700">Email</button></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                            <td class="px-6 py-4">No data Found !</td>
                        </tr>
                    @endif

                </tbody>
            </table>

            <div class="px-6 mt-3">
                {{ $data->links() }}
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
