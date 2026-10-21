<?php

namespace App\Providers;

use App\Services\CurrencyService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CurrencyService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('price', function ($expression) {
            return "<?php echo app(\\App\\Services\\CurrencyService::class)->format($expression); ?>";
        });

        View::composer('*', function ($view) {
            $currencyService = app(CurrencyService::class);
            $currentCurrency = $currencyService->getUserCurrency();
            $symbols = config('currency.symbols', []);
            $view->with('currentCurrency', $currentCurrency);
            $view->with('currencySymbol', $symbols[$currentCurrency] ?? $currentCurrency . ' ');
            $view->with('supportedCurrencies', config('currency.supported', ['UGX', 'USD', 'EUR', 'GBP']));
        });
    }
}
