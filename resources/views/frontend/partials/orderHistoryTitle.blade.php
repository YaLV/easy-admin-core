<h2>
    {{ (new \Carbon\Carbon($data['market_day_date']))->format('d.m.Y') }}
</h2>
<h3>
    <a href="{{ r('page') }}">{{ __('translations.startpage') }}</a>
    <a href="{{ r('orderhistory') }}">{{ __('translations.orderHistory') }}</a>
</h3>