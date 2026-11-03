<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

#[Signature('app:setup')]
#[Description('Create the company, business divisions, document number prefixes, and first director account.')]
class SetupCompanyCommand extends Command
{
    public function handle(): int
    {
        if (Company::query()->exists()) {
            $this->error('Perusahaan sudah disiapkan.');

            return self::FAILURE;
        }

        $companyName = trim((string) $this->ask('Nama perusahaan'));
        $adminName = trim((string) $this->ask('Nama direktur pertama'));
        $adminEmail = mb_strtolower(trim((string) $this->ask('Email direktur pertama')));
        $password = $this->secret('Password awal (minimal 12 karakter)');
        $passwordConfirmation = $this->secret('Ulangi password awal');

        if ($companyName === '' || $adminName === '' || filter_var($adminEmail, FILTER_VALIDATE_EMAIL) === false) {
            $this->error('Nama perusahaan, nama direktur, dan email valid wajib diisi.');

            return self::FAILURE;
        }

        if ($password === null || mb_strlen($password) < 12 || ! hash_equals($password, (string) $passwordConfirmation)) {
            $this->error('Password harus minimal 12 karakter dan kedua input harus sama.');

            return self::FAILURE;
        }

        app(RolePermissionSeeder::class)->run();
        $directorRole = Role::findByName('direktur', 'web');

        DB::transaction(function () use ($companyName, $adminName, $adminEmail, $password, $directorRole): void {
            $company = Company::query()->create([
                'name' => $companyName,
                'currency_code' => 'IDR',
                'timezone' => 'Asia/Jakarta',
                'is_active' => true,
            ]);

            foreach ([
                ['code' => 'KON', 'name' => 'Konstruksi'],
                ['code' => 'IZN', 'name' => 'Perizinan'],
                ['code' => 'INT', 'name' => 'Interior'],
            ] as $division) {
                $company->businessDivisions()->create($division + ['is_active' => true]);
            }

            foreach ([
                ['document_type' => 'project', 'prefix' => 'PRJ-'],
                ['document_type' => 'invoice', 'prefix' => 'INV-'],
                ['document_type' => 'transaction', 'prefix' => 'TRX-'],
                ['document_type' => 'purchase_order', 'prefix' => 'PO-'],
                ['document_type' => 'journal_entry', 'prefix' => 'JRN-'],
            ] as $sequence) {
                $company->documentSequences()->create($sequence + [
                    'next_number' => 1,
                    'padding' => 4,
                ]);
            }

            $director = User::query()->create([
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => $password,
                'is_active' => true,
            ]);

            $director->assignRole($directorRole);
        });

        $this->info('Fondasi perusahaan berhasil dibuat. Silakan masuk menggunakan akun direktur yang baru dibuat.');

        return self::SUCCESS;
    }
}
