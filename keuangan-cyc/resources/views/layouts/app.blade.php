<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
        <div class="min-h-screen lg:flex">
            <aside class="flex w-full flex-col border-b border-slate-200 bg-white px-5 py-5 lg:min-h-screen lg:w-64 lg:border-b-0 lg:border-r">
                <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-tight text-slate-900">
                    Keuangan <span class="text-indigo-600">CYC</span>
                </a>
                <p class="mt-1 text-xs text-slate-500">Sistem keuangan perusahaan</p>

                <nav class="mt-6 flex gap-2 lg:flex-1 lg:flex-col" aria-label="Navigasi utama">
                    <a href="{{ route('dashboard') }}" aria-current="page" class="rounded-lg bg-indigo-50 px-3 py-2 text-sm font-medium text-indigo-700">
                        Dashboard
                    </a>
                </nav>

                <div class="mt-5 flex items-center justify-between border-t border-slate-200 pt-4 lg:block">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs text-slate-500">{{ auth()->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="lg:mt-3">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                            Keluar
                        </button>
                    </form>
                </div>
            </aside>

            <main class="min-w-0 flex-1 px-4 py-6 sm:px-8 sm:py-8">
                @yield('content')
            </main>
        </div>
    </body>
</html>
