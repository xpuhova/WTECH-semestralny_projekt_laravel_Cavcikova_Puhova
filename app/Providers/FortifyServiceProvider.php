<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Http\Responses\LoginResponse;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
        $this->configureLogin();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(fn () => view('pages::auth.login'));
        Fortify::verifyEmailView(fn () => view('pages::auth.verify-email'));
        Fortify::twoFactorChallengeView(fn () => view('pages::auth.two-factor-challenge'));
        Fortify::confirmPasswordView(fn () => view('pages::auth.confirm-password'));
        Fortify::registerView(fn () => view('pages::auth.register'));
        Fortify::resetPasswordView(fn () => view('pages::auth.reset-password'));
        Fortify::requestPasswordResetLinkView(fn () => view('pages::auth.forgot-password'));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }

    private function configureLogin(): void
    {
        Fortify::authenticateUsing(function (Request $request) {
            $sessionId = $request->session()->getId();
            $user = User::where('email', request('email'))->first();
            if ($user && Hash::check($request->password, $user->password)) {
                if ($user->role != 'admin') {
                    $this->mergeCartsOnLogin($user->id, $sessionId);
                }

                return $user;
            }

            return null;
        });
    }

    private function mergeCartsOnLogin(int $id, string $sessionId): void
    {
        $guestCart = Cart::where('session_token', $sessionId)->first();
        if (! $guestCart) {
            return;
        }
        $userCart = Cart::where('user_id', $id)->first();
        if (! $userCart) {
            $guestCart->update([
                'user_id' => $id,
                'session_token' => null,
            ]);
        } else {
            foreach ($guestCart->items as $item) {
                $userItem = $userCart->items()->where(['product_id' => $item->product_id, 'size' => $item->size])->first();
                if ($userItem) {
                    $userItem->quantity += $item->quantity;
                    $userItem->save();
                } else {
                    CartItem::create([
                        'product_id' => $item->product_id,
                        'cart_id' => $userCart->id,
                        'size' => $item->size,
                        'quantity' => $item->quantity,
                    ]);
                }
            }
            $guestCart->delete();
        }
    }
}
