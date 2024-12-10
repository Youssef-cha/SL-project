<nav class=" bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
            <button togglerFor="sidebar"
                class="flex items-center justify-center p-3 text-xl font-light text-gray-600 hover:bg-gray-200 w-8 h-7 r focus:ring-4 focus:ring-gray-300 mx-4">
                <i class="fa-solid fa-bars"></i>
            </button>
            <a href="/" class="flex items-center justify-between mr-4">
                <img src="{{ asset('img/logo.png') }}" class="mr-3 h-11" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Service
                    Logistique</span>
            </a>
        </div>
        <div class="flex items-center lg:order-2">
            <form class="flex items-center" action="">
                <button type="button" class=" text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 capitalize rounded-md text-sm px-5 py-2.5 text-center font-semibold  mr-4 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">logout</button>
            </form>

        </div>
    </div>
</nav>
