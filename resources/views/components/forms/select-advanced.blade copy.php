@props([
    // 'class' => '',
    'height' => 'h-12',
    'name',
    'model',
    'label' => '',
    'disabled' => false,
    'required' => false,
])

<!-- component -->
<div {{ $attributes }}
{{-- this is a function to set the default selected value if there is any "selected" attribute --}}
x-init="
    const selectFormItems = document.querySelectorAll('.select-form-item');
    selectFormItems.forEach((item) => {
        if (item.hasAttribute('selected')) {
            const selectFormText = item.parentElement.parentElement.parentElement.querySelector('.select-form-text');
            selectFormText.textContent = item.textContent;
            item.style.background = '#00ADB5';
        }
    });
">
    <div class="relative group select-form-container">
        {{-- <input wire:ignore type="hidden" class="select-form-value" name="{{ $name }}" id="{{ $name }}" {{ $disabled? "disabled" : '' }}> --}}

        <button type="button" class="{{ $height }} select-form flex justify-center items-center border disabled:bg-primaryGrey group capitalize border-gray-200 min-w-44 text-sm rounded-lg focus:ring-primaryTeal focus:ring-1 focus:border-primaryTeal w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryTeal dark:focus:border-primaryTeal @error($name) border-red-500 placeholder-red-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">
            {{-- Small Floating text --}}
            <span class="absolute mr-2 text-sm duration-300 transform -translate-y-[1.2rem] scale-75 left-2 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 group-focus:px-2 group-focus:text-primaryTeal group-disabled:bg-transparent capitalize group-focus:dark:text-primaryLightTeal group-focus:top-1.5 group-focus:scale-90 group-focus:-translate-y-4 focus:px-2 focus:text-primaryTeal focus:dark:text-primaryLightTeal focus:top-1.5 focus:scale-90 focus:-translate-y-4 @error($name) text-red-700 dark:text-red-500 @enderror">
                {{ $label }}
            </span>
            {{-- Default text value --}}
            <span wire:ignore class="absolute mt-2 border-0 pointer-events-none left-4 select-form-text w-fit h-fit">
                {{ $label }}
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute w-5 h-5 pointer-events-none right-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        <div wire:ignore class="fixed z-30 hidden p-1 mt-2 space-y-1 bg-white rounded-md shadow-lg select-form-menu ring-1 ring-black ring-opacity-5">
            <!-- Search input -->
            <input wire:ignore class="block w-full px-4 py-2 text-gray-800 border border-gray-300 rounded-md search-input focus:outline-none" type="text" placeholder="Search items" autocomplete="off">
            <!-- Dropdown content goes here -->
            <div class="overflow-x-auto max-h-60">
                <span data-value="" class="block px-4 py-2 text-gray-700 rounded-md cursor-pointer select-form-item hover:bg-gray-100 active:bg-blue-100">{{ $label }}</span>
                {{ $slot }}
            </div>
        </div>
    </div>
    <div>
        @error($name)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
        @enderror
    </div>
</div>

@pushOnce('scripts')
    <script>
        document.addEventListener('click', (e) => {

            if (e.target.classList.contains("select-form")) {
                const menu = e.target.nextElementSibling;
                const openMenus = document.querySelectorAll(".select-form-menu:not(.hidden)");
                openMenus.forEach(openMenu => {
                    if (openMenu !== menu) {
                        openMenu.classList.add('hidden');
                    }
                });
                menu.classList.toggle('hidden');
            } else if (!e.target.closest(".select-form-menu, .select-form")) {
                const openMenus = document.querySelectorAll(".select-form-menu:not(.hidden)");
                openMenus.forEach(menu => menu.classList.add('hidden'));
            }

            if (e.target.classList.contains('search-input')) {
                const searchInput = e.target;
                searchInput.addEventListener('input', () => {
                    const searchTerm = searchInput.value.toLowerCase();
                    const items = searchInput.parentElement.querySelectorAll('span');

                    items.forEach((item) => {
                        const text = item.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>

    @script
        <script>
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains("select-form-item")) {
                    const item = e.target
                    const selectFormValue = e.target.parentElement.parentElement.parentElement.querySelector('.select-form-value')
                    const selectFormText = e.target.parentElement.parentElement.parentElement.querySelector('.select-form-text')
                    item.parentElement.querySelectorAll('.select-form-item').forEach((item) => {
                        item.style.background = ""
                    })
                    item.style.background = "#00ADB5"
                    // selectFormValue.value = item.dataset.value
                    selectFormText.textContent = item.textContent

                    // this is the real one(the latest version) that comunicate with the livewire
                    $wire.set('{{ $model }}', item.dataset.value)
                }
            })
        </script>
    @endscript
@endPushOnce
