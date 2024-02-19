<div x-show="addPackage" class="w-3/4" x-cloak>
    <x-modalCustom>
        <h2 class="mt-3 text-2xl font-semibold text-center">Add Package Data</h2>
        <hr class="px-3 my-2">

        <div class="p-3">
            <x-input-label for="package" :value="__('Package details separated by comma')" />
            <x-text-input id="package" class="block w-full mt-1" type="text" name="package" :value="old('package')" required
                wire:model="package" autofocus autocomplete="package" />
            <x-input-error :messages="$errors->get('package')" class="mt-2" />
        </div>
        <div class="p-3">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block w-full mt-1" type="text" type-currency="IDR" name="price"
                :value="old('price')" required wire:model="price" autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        <div class="p-3">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="message" rows="4" name="description" required wire:model="description"
                class="block mt-1 p-2.5 w-full text-sm text-gray-900  rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

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
