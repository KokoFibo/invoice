<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>Quotation</title>
</head>
<style>
    body {
        font-family: poppins, sans-serif;
    }
</style>
<body class="w-5/6 mx-auto mt-10 text-gray-700 ">
    <div >
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-semibold text-8xl">QUOTATION</h1>
            <p class="mt-3 text-3xl tracking-wide">DETAILED OF PROVIDED SERVICES</p>
        </div>
        <h1><img src="{{ asset('images/kokofibo logo.png') }}" style="width:250px" alt=""></h1>

    </div>
    <div class="flex gap-16 mt-12">
        <div class="w-1/2">
            <p class="text-3xl font-semibold">Created for</p>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="flex gap-20">
                <div>
                    <p class="text-3xl font-semibold">Name</p>
                    <p class="mt-5 text-3xl font-semibold">Company</p>
                </div>
                <div>
                    <p class="text-3xl">{{ $customer->salutation }} {{ $customer->name }}</p>

                    <p class="mt-5 text-3xl">{{ $customer->title }} {{ $customer->company }}</p>
                </div>
            </div>

        </div>
        <div class="w-1/2">
            <div class="flex justify-between">
                <div>
                    <p class="text-3xl font-semibold">Created on</p>
                </div>
                <div class="flex gap-2">
                    {{-- <div x-data="{ buttonDisabled: false }">
                        <a href="/quotationEmail/{{ $quotation->number }}"><button x-on:click="buttonDisabled = true"
                            x-bind:disabled="buttonDisabled" class="px-2 py-1 text-sm text-white bg-teal-500 rounded-lg hover:bg-teal-700">Email</button></a>
                    </div> --}}
                @php
                if(isEmailedQuotation($quotation->number) == false) {
                @endphp
                <div x-data="{ buttonDisabled: false }">
                        <a href="/quotationEmail/{{ $quotation->number }}"><button x-on:click="buttonDisabled = true"
                            x-bind:disabled="buttonDisabled" class="px-2 py-1 text-sm text-white bg-teal-500 rounded-lg hover:bg-teal-700">Email</button></a>
                    </div>
                @php
                    }
                @endphp





                    <div x-data="{ buttonDisabled: false }">

                        <a href="/quotationpdf/{{ $quotation->number }}"><button x-on:click="buttonDisabled = true"
                        x-bind:disabled="buttonDisabled" class="px-2 py-1 text-sm text-white bg-red-500 rounded-lg hover:bg-red-700">PDF</button></a>
                    </div>

                    <a href="/quotation"><button class="px-2 py-1 text-sm text-white bg-black rounded-lg hover:bg-gray-600 hover:text-white ">Back</button></a>
                </div>
            </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="flex gap-20">
                <div>
                    <p class="text-3xl font-semibold">Date</p>
                    <p class="mt-5 text-3xl font-semibold">Number</p>

                </div>
                <div>
                    <p class="text-3xl">{{ tanggal($quotation->quotation_date) }}</p>
                    <p class="mt-5 text-3xl">{{ showQuotationNumber($quotation->number) }}</p>
                </div>
            </div>
        </div>
    </div>
<div class="py-5 mt-20 rounded-lg bg-sky-100">
    <h1 class="text-3xl font-semibold tracking-widest text-center">PROVIDED SERVICES</h1>
</div>
    <div class="relative mt-20 overflow-x-auto">
        <table class="w-full mb-40 text-left text-gray-500 table-auto dark:text-gray-400">

            <thead class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-xl text-white bg-gray-500 dark:text-white">

                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Package</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Quantity</th>
                    <th scope="col" class="px-6 py-3">Price</th>


                </tr>
            </thead>
            <tbody>
                @if (!empty($quotations))
                    @foreach ($quotations as $key => $d)
                        <tr class="text-xl border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $d->package }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $desc = getDetail($d->description);
                                @endphp
                                    <ul>
                                        @php
                                        foreach ($desc as $de) {
                                            @endphp
                                            {{-- <li class="list-disc"> --}}
                                                <textarea >
                                                @php
                                                echo $de;
                                                @endphp
                                            </textarea>
                                            {{-- </li> --}}
                                            @php
                                        }
                                        @endphp

                                    </ul>
                            </td>
                            <td class="px-6 py-4">1 Package</td>
                            <td class="px-6 py-4">IDR {{ number_format($d->price) }}</td>

                        </tr>
                    @endforeach
                @else
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                        <td class="px-6 py-4">No Data Found</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
    </div>


</body>

</html>
