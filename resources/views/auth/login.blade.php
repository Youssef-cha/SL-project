<x-head />

<body class="flex justify-center items-center min-h-screen">

    <!-- Card Container -->

    <div class="max-w-md w-full bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Card Header -->
        <div class="bg-secondary py-4 px-6">
            <h2 class="text-white text-2xl font-semibold text-center">Login</h2>
        </div>
        <!-- Card Body -->
        <div class="p-6 mt-7">
            <form action="{{ route('sessions.store') }}" method="POST">
                @csrf
                <!-- Email Input -->
                <x-form-field>
                    <x-form-label for="email">Email</x-form-label>
                    <x-form-input type="email" id="email" name="email" placeholder="Enter your email" required />
                </x-form-field>
                <!-- Password Input -->
                <x-form-field>
                    <x-form-label for="password">Password</x-form-label>
                    <x-form-input type="password" id="password" name="password" placeholder="Enter your password" required />
                </x-form-field>
               
             
                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-secondary-dark border-gray-300 rounded focus:ring-secondary-dark">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
                <!-- Submit Button -->
                <x-form-button>Login</x-form-button>
            </form>
            <!-- Forgot Password -->
            <div class="mt-4 text-center">
                <a href="#" class="text-sm text-primary-light hover:text-primary-dark hover:underline ">Forgot your password?</a>
            </div>
        </div>
    </div>
</body>

</html>
