<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'company' => Company::query()->first(),
        ]);
    }
}
