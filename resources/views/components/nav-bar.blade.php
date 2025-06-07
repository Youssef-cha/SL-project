<nav class="fixed z-40 left-0 right-0 top-0 bg-emerald-700 border-b border-gray-200 dark:border-gray-700">
    <div class="px-3 py-2 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button togglerFor="sidebar"
                    class="inline-flex items-center rounded-lg p-2 text-sm text-white hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 lg:hidden"
                    aria-label="Toggle Sidebar">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <a href="/" class="flex ml-2 md:ml-4">
                    <img src="{{ asset('img/logo.png') }}" class="h-8 md:h-10 mr-3" alt="Service Logistique Logo" />
                    <span class="self-center text-lg md:text-xl lg:text-2xl font-semibold whitespace-nowrap text-white hidden sm:inline-block">
                        Service Logistique
                    </span>
                </a>
            </div>
            <div class="flex items-center">
                <button id="darkModeToggle"
                    class="p-2 text-white rounded-lg hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    aria-label="Toggle Dark Mode">
                    <i class="fa-solid fa-sun text-lg dark:hidden"></i>
                    <i class="fa-solid fa-moon text-lg hidden dark:block"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
<script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    const setTheme = (isDark) => {
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    };

    darkModeToggle.addEventListener('click', () => {
        const isDark = !document.documentElement.classList.contains('dark');
        setTheme(isDark);
    });

    // Check system preference and stored preference
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        setTheme(true);
    }
</script>