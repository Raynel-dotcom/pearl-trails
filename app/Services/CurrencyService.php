<?php

namespace App\Services;

class CurrencyService
{
    /**
     * Get the active currency code from session, default to UGX.
     */
    public function getUserCurrency(): string
    {
        $supported = config('currency.supported', ['UGX', 'USD', 'EUR', 'GBP']);
        $curr = session('currency', config('currency.default', 'UGX'));

        return in_array($curr, $supported, true) ? $curr : 'UGX';
    }

    /**
     * Convert an amount in UGX to the specified target currency (or active currency).
     */
    public function convertFromUgx(int|float $amountUgx, ?string $targetCurrency = null): float
    {
        $curr = $targetCurrency ?? $this->getUserCurrency();
        $rates = config('currency.rates', [
            'UGX' => 1,
            'USD' => 3650,
            'EUR' => 4200,
            'GBP' => 4900,
        ]);

        $rate = $rates[$curr] ?? 1;
        if ($rate <= 0) $rate = 1;

        $converted = $amountUgx / $rate;

        return $this->roundCurrency($converted, $curr);
    }

    /**
     * Round currency according to prompt specification:
     * - round UGX to nearest 5,000
     * - others to nearest 5, or 1 under 10
     */
    public function roundCurrency(float $val, string $currency): float
    {
        if ($val <= 0) return 0;

        if ($currency === 'UGX') {
            $rounded = round($val / 5000.0) * 5000;
            return max(5000, $rounded);
        }

        // Foreign currencies: USD, EUR, GBP
        if ($val < 10) {
            return round($val);
        }

        return round($val / 5.0) * 5;
    }

    /**
     * Format a UGX amount into the display string with currency symbol and estimation rounding.
     */
    public function format(int|float $amountUgx, ?string $targetCurrency = null): string
    {
        $curr = $targetCurrency ?? $this->getUserCurrency();
        $val = $this->convertFromUgx($amountUgx, $curr);

        $symbols = config('currency.symbols', [
            'UGX' => 'UGX ',
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
        ]);

        $symbol = $symbols[$curr] ?? $curr . ' ';

        if ($curr === 'UGX') {
            return $symbol . number_format($val);
        }

        // e.g. $125 or €45
        return $symbol . number_format($val);
    }

    /**
     * Get the budget bands for a given or active currency.
     */
    public function getBudgetBands(?string $currency = null): array
    {
        $curr = $currency ?? $this->getUserCurrency();
        $bands = config("currency.bands.{$curr}");

        return $bands ?? config('currency.bands.UGX');
    }

    /**
     * Convert a chosen band identifier (e.g. '100k', '500', 'above') and currency to UGX limit for scoring.
     */
    public function resolveBandToUgx(string $bandId, ?string $currency = null): int
    {
        $curr = $currency ?? $this->getUserCurrency();
        $rates = config('currency.rates', [
            'UGX' => 1,
            'USD' => 3650,
            'EUR' => 4200,
            'GBP' => 4900,
        ]);
        $rate = $rates[$curr] ?? 1;

        $bands = $this->getBudgetBands($curr);
        $found = null;
        foreach ($bands as $band) {
            if ($band['id'] === $bandId) {
                $found = $band;
                break;
            }
        }

        if (!$found) {
            // Default 500k UGX equivalent
            return 500000;
        }

        if ($curr === 'UGX') {
            return (int) $found['max'];
        }

        // For foreign currencies, band * rate
        // "Above" uses top value of 3,000 units
        $unitVal = $found['id'] === 'above' ? 3000 : $found['max'];

        return (int) round($unitVal * $rate);
    }
}
