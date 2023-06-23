<div x-cloak x-data="{ addCustomer: false, editCustomer: false }">

    <h1 class="my-5 text-2xl font-semibold text-center">Customer Data</h1>
    {{-- per Page --}}
    <div class="flex justify-between px-10">
        <x-text-input id="search" class="block w-full mt-1 lg:w-1/5" type="search" name="search" :value="old('search')"
            required wire:model.debounce.500ms="search" autofocus autocomplete="search"
            placeholder="Search Name or Company ..." />
        <select id="perPage" wire:model="perpage"
            class="hidden  w-full lg:w-1/6 bg-gray-50 border rounded-lg border-gray-300 text-gray-600 text-sm  focus:ring-blue-500 focus:border-blue-500 lg:block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="5">5 rows</option>
            <option value="10">10 rows</option>
            <option value="15">15 rows</option>
            <option value="20">20 rows</option>
            <option value="25">25 rows</option>
        </select>
    </div>

    <div class="relative px-10 mt-5 overflow-x-auto" x-cloak>
        <table class="w-full text-sm text-left text-gray-500 table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-white bg-gray-500 dark:text-white">
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Salutation</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Brand</th>
                    <th scope="col" class="px-6 py-3">Address</th>
                    <th scope="col" class="px-6 py-3">Mobile</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Notes</th>
                    <th scope="col" class="px-6 py-3">
                        <button @click="addCustomer=true"
                            class="px-3 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700">Create
                            Customer</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $d)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $d->name }}</td>
                        <td class="px-6 py-4">{{ $d->salutation }}</td>
                        <td class="px-6 py-4">{{ $d->title }}</td>
                        <td class="px-6 py-4">{{ $d->company }}</td>
                        <td class="px-6 py-4">{{ $d->address }}</td>
                        <td class="px-6 py-4">{{ $d->mobile }}</td>
                        <td class="px-6 py-4">{{ $d->email }}</td>
                        <td class="px-6 py-4">{{ $d->notes }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">


                                <button @click="editCustomer=true" wire:click="editCustomer({{ $d->id }})"
                                    class="px-3 py-2 text-white bg-teal-500 rounded-lg hover:bg-teal-700">Edit</button>
                                <button wire:click="deleteConfirmation({{ $d->id }})"
                                    class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 mt-3">
            {{ $data->links() }}
        </div>
    </div>
    @include('modal.addCustomerModal')
    @include('modal.editCustomerModal')
</div>
