<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(fn (): View => view('auth.login'));

        Fortify::authenticateUsing(function (Request $request): ?User {
            $email = $request->string('email')->trim()->lower()->toString();
            $password = $request->input('password');
            $user = User::query()->where('email', $email)->first();

            if ($user === null || ! $user->is_active || ! is_string($password) || ! Hash::check($password, $user->password)) {
                return null;
            }

            $user->forceFill(['last_login_at' => now()])->save();

            return $user;
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(
                Str::lower($request->string(Fortify::username())->toString()).'|'.$request->ip(),
            );

            return Limit::perMinute(5)->by($throttleKey);
        });
    }
}
