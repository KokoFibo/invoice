<div class="p-3" x-show="openModal" mx-auto x-cloak @click="openModal = false">
    <div class="w-full mx-auto mt-3 text-black bg-white shadow lg:w-3/4 rounded-xl border-1">
        <h2 class="py-3 text-2xl font-semibold text-center">Detail Quotation</h2>
    </div>

    <div class="flex flex-col w-full p-5 mx-auto lg:gap-10 lg:flex-row lg:w-3/4">
        <div class="w-full lg:w-1/2">
            <div class="flex mt-3 ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Quotation No.
                </span>
                <div
                    class="w-56  rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0  text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p>{{ $dquotation_number }}</p>
                </div>
            </div>
            <div class="flex mt-3 ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Company
                </span>
                <div
                    class="w-56  rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0  text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p>{{ $dcompany }}</p>
                </div>
            </div>
            <div class="flex mt-3 ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Status
                </span>
                <div
                    class="w-56  rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0  text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p>{{ $dstatus }}</p>
                </div>
            </div>


        </div>
        <div class="w-full lg:w-1/2">
            <div class="flex mt-3 ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Quotation Date
                </span>
                <div
                    class="w-56  rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0  text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p>{{ tanggal($dquotation_date) }}</p>
                </div>
            </div>
            <div class="flex mt-3 ">
                <span
                    class="inline-flex items-center w-32 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Emailed Date
                </span>
                <div
                    class="w-56  rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0  text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <p>{{ tanggal_with_Jam($demailed_at) }}</p>
                </div>
            </div>




        </div>
    </div>
    <div class="w-full py-4 overflow-x-auto">
        <table
            class="w-full mx-auto mt-3 text-sm text-left text-gray-500 table-fixed lg:w-3/4 lg:table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-white bg-gray-500 dark:text-white">

                    <th class="w-10 px-6 py-3">#</th>
                    <th class="px-6 py-3 w-80">Package</th>
                    <th class="px-6 py-3 w-28">Price</th>
                    <th class="px-6 py-3 w-96">Description</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                @endphp
                @foreach ($detailQuotations as $d)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                        <td class="px-6 py-4"> {{ $loop->iteration }}</td>
                        <td class="px-6 py-4"> {{ $d->package }}</td>
                        <td class="px-6 py-4 text-right"> {{ number_format($d->price) }}</td>
                        <td class="px-6 py-4 ql-editor">{!! $d->description !!}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="w-3/4 mx-auto mt-44">
        <button @click="openModal=false" class="w-full button button-teal">Click Everywhere above this line to go
            back</button>
    </div>

</div>
