<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin PII</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="flex justify-center">
                    @if(!empty($site_settings['site_logo']))
                        <img src="{{ $site_settings['site_logo'] }}" alt="Logo" class="h-20 w-auto object-contain">
                    @else
                        <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-3xl">PII</span>
                        </div>
                    @endif
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Login Admin
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Persatuan Insinyur Indonesia
                </p>
            </div>

            @if($errors->any())
            @php
                $isLockout = str_contains($errors->first('email') ?? '', 'Coba lagi dalam');
            @endphp
            <div class="{{ $isLockout ? 'bg-orange-50 border border-orange-400 text-orange-700' : 'bg-red-100 border border-red-400 text-red-700' }} px-4 py-3 rounded">
                @if($isLockout)
                    <p class="font-semibold text-sm">&#128274; Akses sementara diblokir</p>
                @endif
                <ul class="list-disc list-inside text-sm mt-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="appearance-none rounded-none rounded-t-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm" 
                            placeholder="Email address" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="appearance-none rounded-none rounded-b-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm" 
                            placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
