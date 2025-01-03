<nav class="fixed z-40 left-0 right-0 top-0 bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
            <button togglerFor="sidebar"
                class="flex items-center rounded-md justify-center p-3 text-xl font-light text-gray-600 dark:hover:text-primary-500 transition-all duration-300 dark:hover:bg-gray-700 w-8 h-7 focus:ring-4 dark:focus:ring-gray-700 mx-4"
                aria-label="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
            <a href="/" class="flex items-center justify-between mr-4">
                <img src="{{ asset('img/logo.png') }}" class="mr-3 h-11" alt="Service Logistique Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                    Service Logistique
                </span>
            </a>
        </div>
        <button id="darkModeToggle"
            class="p-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition"
            aria-label="Toggle Dark Mode">
            <i class="fa-solid fa-moon"></i>
        </button>
    </div>
</nav>
<script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    darkModeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
    });
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }
</script>
<nav
    class=" fixed z-40 left-0 right-0 top-0 bg-primary-500 border-b border-gray-200 px-4 py-2.5  dark:border-gray-700">
    <div class="flex flex-wrap justify-between items-center px-8">
        <div class="flex justify-start items-center">
            <button togglerFor="sidebar"
                class="flex items-center rounded-md justify-center p-3 text-xl font-light text-gray-600 dark:hover:text-primary-500 transition-all duration-300 dark:hover:bg-gray-700 w-8 h-7 r focus:ring-4 dark:focus:ring-gray-700 mx-4">
                <i class="fa-solid fa-bars text-white"></i>
            </button>
            <a href="/" class="flex items-center justify-between mr-4">
                <img src="{{ asset('img/logo.png') }}" class="mr-3 h-11" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Service
                    Logistique</span>
            </a>
        </div>
        <div class="flex items-center justify-start">
            <button id="darkModeToggle">
                <i class="fa-solid text-xl  text-white   p-2 transition duration-300 rounded-full fa-circle-half-stroke"></i>
            </button>
        </div>
    </div>
</nav>
