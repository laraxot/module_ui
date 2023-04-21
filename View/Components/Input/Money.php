<?php
/**
 * @see https://laracasts.com/discuss/channels/laravel/currency-format
 */

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class Money extends Component
{
    public int $amount;
    public string $currency;
    public string $locale;

    public function __construct(int $amount, string $currency, string $locale = null)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->locale = $locale ?? app()->getLocale();
    }

    public function render()
    {
        $money = new Money($this->amount, new Currency(Str::upper($this->currency)));

        $numberFormatter = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, new ISOCurrencies());

        return $moneyFormatter->format($money);
    }
}
