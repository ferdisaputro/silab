@props([
    // 'class' => '',
    'height' => 'h-12',
    'name',
    'model',
    'label' => '',
    'disabled' => false,
    'required' => false,
    'withRefresh' => true
])

<!-- component -->
<div {{ $attributes }}>
    <div
        x-data="selectComponent($el, '{{ $label }}')"
        wire:ignore.self
        class="relative"
    >
        <div class="relative group select-form-container">
            {{-- <input wire:ignore type="hidden" class="select-form-value" name="{{ $name }}" id="{{ $name }}" {{ $disabled? "disabled" : '' }}> --}}

            <button type="button" @if($disabled) disabled @endif class="{{ $height }} select-form flex items-center border disabled:bg-primaryGrey group capitalize border-gray-200 min-w-44 text-sm rounded-lg focus:ring-primaryTeal focus:ring-1 focus:border-primaryTeal w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryTeal dark:focus:border-primaryTeal @error($name) border-red-500 placeholder-red-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror"
                @if (!$disabled)
                    @click="openMenu()"
                @endif
            >
                {{-- Small Floating text --}}
                <span class="absolute mr-2 text-sm duration-300 text-start transform -translate-y-[1.2rem] scale-75 left-2 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 group-focus:px-2 group-focus:text-primaryTeal group-disabled:bg-transparent capitalize group-focus:dark:text-primaryLightTeal group-focus:top-1.5 group-focus:scale-90 group-focus:-translate-y-4 focus:px-2 focus:text-primaryTeal focus:dark:text-primaryLightTeal focus:top-1.5 focus:scale-90 focus:-translate-y-4 @error($name) text-red-700 dark:text-red-500 @enderror">
                    {{ $label }}
                </span>
                {{-- Default text value --}}
                <span wire:ignore x-text="selectedItem.text" class="absolute mt-1 border-0 pointer-events-none left-4 select-form-text w-fit h-fit"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute w-5 h-5 pointer-events-none right-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            {{-- max-w-full min-w-full --}}
            <div x-show="isOpen" class="fixed z-30 w-full p-1 mt-2 space-y-1 bg-white rounded-md shadow-lg select-form-menu ring-1 ring-black ring-opacity-5">
                <!-- Search input -->
                <input x-model="search" class="block w-full px-4 py-2 text-gray-800 border border-gray-300 rounded-md search-input focus:outline-none" type="text" placeholder="Search items" autocomplete="off">
                <!-- Dropdown content goes here -->
                <div class="overflow-x-auto max-h-60">
                    <div class="hidden">
                        {{ $slot }}
                    </div>
                    <template x-for="(item, index) in options" :key="index">
                        <span :class="item.value == selectedItem.value? 'bg-primaryTeal' : ''" x-show="search === '' || item.value.toLowerCase().includes(search.toLowerCase()) || item.text.toLowerCase().includes(search.toLowerCase())" :data-value="item.value" class="block px-4 py-2 text-sm text-gray-700 rounded-md cursor-pointer text-start select-form-item hover:bg-gray-100 active:bg-blue-100"
                            @if (!$disabled)
                                @click="selectedItem = item; isOpen = false; $wire.set('{{ $model }}', item.value, {{ $withRefresh }})"
                            @endif
                        >
                            <span x-text="item.text"></span>
                        </span>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <div>
        @if (!$disabled)
            @error($model)
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
            @enderror
        @endif
    </div>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('selectComponent', (el, label) => {
                return {
                    isOpen: false,
                    search: '',
                    selectedItem: null,
                    label: label,

                    options: null, // default option element

                    selectContainer: el,
                    init() {
                        this.convertOption()
                        const selectFormItems = this.selectContainer.querySelectorAll('.select-form-item');
                        const selectFormMenu = this.selectContainer.querySelector('.select-form-menu');

                        selectFormMenu.style.maxWidth = this.selectContainer.firstElementChild.offsetWidth + "px"

                        this.options.forEach((option) => {
                            if (option.selected) {
                                // const selectFormText = item.parentElement.parentElement.parentElement.querySelector('.select-form-text');
                                // selectFormText.textContent = item.textContent;
                                this.selectedItem = option
                            }
                        });
                        // console.log(this.options);
                        document.addEventListener('scroll', () => {
                            if (this.isOpen) {
                                this.isOpen = false
                            }
                        })
                    },
                    convertOption() {
                        const selectFormMenu = this.selectContainer.querySelector('.select-form-menu');

                        this.options = [{value: "", text: this.label, selected: false}]
                            .concat(Array.from(selectFormMenu.querySelectorAll('option')).map(option => {
                                return {value: option.value, text: option.textContent, selected: option.selected}
                            }));

                        // selectFormMenu.querySelectorAll('option').forEach(element => {
                        //     element.remove()
                        // });

                        this.selectedItem = this.options[0] // initiate the default selectedItem to the first one
                    },
                    openMenu() {
                        const selectFormMenu = this.selectContainer.querySelector('.select-form-menu');
                        const containerPosition = this.selectContainer.getBoundingClientRect();
                        this.isOpen = !this.isOpen

                        selectFormMenu.style.top = `${containerPosition.y + containerPosition.height}px`
                        selectFormMenu.style.left = `${containerPosition.x}px`
                        selectFormMenu.style.maxWidth = `${containerPosition.width}px`
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
