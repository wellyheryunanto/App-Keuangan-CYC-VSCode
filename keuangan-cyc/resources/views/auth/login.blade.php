<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Masuk - {{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-screen items-center justify-center bg-slate-100 px-4 py-10 text-slate-900 antialiased">
        <main class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-7 shadow-sm sm:p-9">
            <div class="mb-8">
                <p class="text-sm font-semibold text-indigo-600">KEUANGAN CYC</p>
                <h1 class="mt-3 text-2xl font-semibold tracking-tight">Masuk ke akun Anda</h1>
                <p class="mt-2 text-sm text-slate-500">Gunakan akun perusahaan yang telah diberikan administrator.</p>
            </div>

            @if ($errors->any())
                <div role="alert" class="mb-5 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                </div>
                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium">Kata sandi</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input name="remember" type="checkbox" value="1" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    Ingat saya
                </label>
                <button type="submit" class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Masuk
                </button>
            </form>
        </main>
    </body>
</html>
