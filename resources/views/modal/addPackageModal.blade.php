<div x-show="addPackage" class="w-3/4" x-cloak>
    <x-modalCustom>
        <h2 class="mt-3 text-2xl font-semibold text-center">Add Package Data</h2>
        <hr class="px-3 my-2">

        <div class="p-3">
            <x-input-label for="package" :value="__('Package')" />
            <x-text-input id="package" class="block w-full mt-1" type="text" name="package" wire:model="package"
                required autofocus autocomplete="package" />
            <x-input-error :messages="$errors->get('package')" class="mt-2" />
        </div>
        <div class="p-3">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block w-full mt-1" type="text" type-currency="IDR" name="price"
                :value="old('price')" required wire:model="price" autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        <!-- Quill Description -->
        <div class="p-3" wire:ignore>
            <x-input-label for="description" :value="__('Description')" />

            <div x-data x-ref="quillEditor" class="bg-white rounded border border-gray-300 min-h-[250px]"
                x-init="if (!$refs.quillEditor.__quillLoaded) {
                    const quill = new Quill($refs.quillEditor, {
                        theme: 'snow',
                        placeholder: 'Write description here...',
                        modules: {
                            toolbar: [
                                [{ header: [1, 2, false] }],
                                ['bold', 'italic', 'underline'],
                                [{ list: 'ordered' }, { list: 'bullet' }],
                                ['link', 'image']
                            ]
                        }
                    });
                
                    quill.root.innerHTML = @js($description ?? '');
                
                    quill.on('text-change', function() {
                        $wire.set('description', quill.root.innerHTML);
                    });
                
                    // tandai sudah inisialisasi
                    $refs.quillEditor.__quillLoaded = true;
                }"></div>

            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="flex justify-between">
            <x-blue-button class="m-3" @click="addPackage=false" wire:click="savePackage">
                {{ __('Save') }}
            </x-blue-button>
            <x-primary-button class="m-3" @click="addPackage=false">
                {{ __('Cancel') }}
            </x-primary-button>
        </div>


    </x-modalCustom>
    <script>
        document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
            element.addEventListener("keyup", function(e) {
                let cursorPostion = this.selectionStart;
                let value = parseInt(this.value.replace(/[^,\d]/g, ""));
                let originalLenght = this.value.length;
                if (isNaN(value)) {
                    this.value = "";
                } else {
                    this.value = value.toLocaleString("id-ID", {
                        currency: "IDR",
                        style: "currency",
                        minimumFractionDigits: 0,
                    });
                    cursorPostion = this.value.length - originalLenght + cursorPostion;
                    this.setSelectionRange(cursorPostion, cursorPostion);
                }
            });
        });
    </script>
</div>
