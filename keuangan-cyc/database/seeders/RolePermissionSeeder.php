<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissionNames = [
            'dashboard.view',
            'master_data.view',
            'master_data.manage',
            'clients.view',
            'clients.manage',
            'vendors.view',
            'vendors.manage',
            'cash_accounts.view',
            'cash_accounts.manage',
            'projects.view_all',
            'projects.view_assigned',
            'projects.manage',
            'budgets.view',
            'budgets.manage',
            'transactions.view',
            'transactions.create',
            'transactions.approve',
            'transactions.post',
            'invoices.view',
            'invoices.manage',
            'reports.view',
            'users.manage',
            'settings.manage',
        ];

        $permissions = collect($permissionNames)
            ->map(fn (string $name): Permission => Permission::findOrCreate($name, 'web'));

        $permissionsByName = $permissions->keyBy('name');

        $rolePermissions = [
            'direktur' => $permissions,
            'admin_keuangan' => $permissionsByName->only([
                'dashboard.view',
                'master_data.view',
                'master_data.manage',
                'clients.view',
                'clients.manage',
                'vendors.view',
                'vendors.manage',
                'cash_accounts.view',
                'cash_accounts.manage',
                'projects.view_all',
                'budgets.view',
                'budgets.manage',
                'transactions.view',
                'transactions.create',
                'transactions.approve',
                'transactions.post',
                'invoices.view',
                'invoices.manage',
                'reports.view',
            ]),
            'staf_keuangan' => $permissionsByName->only([
                'dashboard.view',
                'master_data.view',
                'clients.view',
                'vendors.view',
                'cash_accounts.view',
                'projects.view_all',
                'budgets.view',
                'transactions.view',
                'transactions.create',
                'invoices.view',
            ]),
            'manajer_proyek' => $permissionsByName->only([
                'dashboard.view',
                'projects.view_assigned',
                'projects.manage',
                'budgets.view',
                'transactions.view',
                'transactions.create',
            ]),
            'staf_proyek' => $permissionsByName->only([
                'projects.view_assigned',
                'transactions.create',
            ]),
            'viewer_auditor' => $permissionsByName->only([
                'dashboard.view',
                'master_data.view',
                'clients.view',
                'vendors.view',
                'cash_accounts.view',
                'projects.view_all',
                'budgets.view',
                'transactions.view',
                'invoices.view',
                'reports.view',
            ]),
        ];

        foreach ($rolePermissions as $roleName => $rolePermissionSet) {
            $role = Role::findOrCreate($roleName, 'web');
            $role->syncPermissions($rolePermissionSet);
        }
    }
}
