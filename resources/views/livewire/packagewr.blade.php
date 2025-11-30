<div x-cloak x-data="{ addPackage: false, editPackage: false }">
    @section('title')
        Packages
    @endsection
    <h1 class="my-5 text-2xl font-semibold text-center">Packages</h1>

    <div class="relative px-10 mt-5 overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 table-auto dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-white bg-gray-500 dark:text-white">
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Package</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">
                        <button @click="addPackage=true"
                            class="px-3 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700">Add</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $d)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 even:bg-gray-200 hover:bg-blue-200">
                        {{-- <td class="px-6 py-4">{{ $loop->iteration }}</td> --}}
                        <td class="px-6 py-4">{{ $d->id }}</td>
                        <td class="px-6 py-4">{{ $d->package }}</td>
                        <td class="px-6 py-4">{{ number_format($d->price) }}</td>
                        {{-- <td class="px-6 py-4">{{ $d->description }}</td> --}}
                        <td class="px-6 py-4 ql-editor">{!! $d->description !!}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">

                                {{-- 
                                <button @click="editPackage=true" wire:click="editPackage({{ $d->id }})"
                                    class="px-3 py-2 text-white bg-teal-500 rounded-lg hover:bg-teal-700">Edit</button> --}}

                                <a href="{{ route('editpackage', $d->id) }}">
                                    <button
                                        class="px-3 py-2 text-white bg-teal-500 rounded-lg hover:bg-teal-700">Edit</button>
                                </a>
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
    @include('modal.addPackageModal')
    {{-- @include('modal.editPackageModal') --}}
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
