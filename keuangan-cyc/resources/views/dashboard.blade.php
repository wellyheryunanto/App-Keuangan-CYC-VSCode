@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mx-auto max-w-7xl">
        <header class="mb-8">
            <p class="text-sm font-medium text-indigo-600">DASHBOARD</p>
            <h1 class="mt-2 text-2xl font-semibold tracking-tight sm:text-3xl">
                Selamat datang, {{ auth()->user()->name }}
            </h1>
            <p class="mt-2 text-sm text-slate-500">
                {{ $company?->name ?? 'Perusahaan belum disiapkan' }}
            </p>
        </header>

        @if ($company === null)
            <section class="rounded-xl border border-amber-200 bg-amber-50 p-5 text-amber-950">
                <h2 class="font-semibold">Konfigurasi awal belum selesai</h2>
                <p class="mt-1 text-sm">
                    Setelah database siap, jalankan <code class="rounded bg-amber-100 px-1.5 py-0.5">php artisan app:setup</code>
                    untuk membuat profil perusahaan, tiga bidang usaha, dan akun direktur pertama.
                </p>
            </section>
        @else
            <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Status modul">
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Perusahaan</p>
                    <p class="mt-2 font-semibold">{{ $company->name }}</p>
                    <p class="mt-1 text-xs text-slate-500">Mata uang {{ $company->currency_code }}</p>
                </article>
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Bidang usaha</p>
                    <p class="mt-2 font-semibold">3 bidang terintegrasi</p>
                    <p class="mt-1 text-xs text-slate-500">Konstruksi, perizinan, dan interior</p>
                </article>
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Manajemen proyek</p>
                    <p class="mt-2 font-semibold">Fondasi tersedia</p>
                    <p class="mt-1 text-xs text-slate-500">Data proyek dapat dikelola pada tahap berikutnya</p>
                </article>
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm text-slate-500">Akuntansi</p>
                    <p class="mt-2 font-semibold">Belum ada transaksi posted</p>
                    <p class="mt-1 text-xs text-slate-500">Ringkasan keuangan tampil setelah modul transaksi dibangun</p>
                </article>
            </section>

            <section class="mt-6 rounded-xl border border-slate-200 bg-white p-5">
                <h2 class="font-semibold">Langkah berikutnya</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Fondasi autentikasi dan data perusahaan sudah tersedia. Modul master data, transaksi, persetujuan,
                    serta jurnal akan ditambahkan bertahap agar setiap perubahan dapat diuji sebelum digunakan.
                </p>
            </section>
        @endif
    </div>
@endsection
