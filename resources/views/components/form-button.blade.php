<button type="submit"
{{ $attributes->merge(['class' => 'w-1/2 block mx-auto bg-secondary text-white py-2 px-4 rounded-md hover:bg-secondary-dark transition duration-300']) }}>
    {{ $slot }}
</button>
