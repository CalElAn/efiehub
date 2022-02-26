<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-main-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-gray-900 focus:ring-2 focus:ring-offset-2 ring-indigo-500 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
