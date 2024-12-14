<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
        <form action="#">
            <x-form-fields-container>

                <x-form-input label="hello"></x-form-input>
                <x-form-input :half="true" label="hello"></x-form-input>
                <x-form-input :half="true" label="hello"></x-form-input>

                <x-form-select :half="true">
                    <option value="hello">hello</option>
                </x-form-select>
                <x-form-input :half="true" label="numbers" type="number"></x-form-input>

                <x-form-text-area></x-form-text-area>
            </x-form-fields-container>

            <x-form-button>save</x-form-button>
        </form>
    </div>
</section>
