<x-guest-layout>
    <div class="flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 rounded-2xl py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 rounded-2xl shadow-2xl">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                    Sign in to your account
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            class="bg-gray-900 text-white placeholder-gray-400 w-full px-4 py-2 rounded-lg border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="Email address"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            class="bg-gray-900 text-white placeholder-gray-400 w-full px-4 py-2 rounded-lg border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="Password"
                        >
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm text-gray-400">
                    <a href="{{ route('register') }}" class="hover:text-indigo-400">
                        Don’t have an account? Register
                    </a>
                </div>

                <div>
                    <button
                        type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                    >
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
