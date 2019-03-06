
<div class="sv-marketday-dropdown">
    <a href="javascript:void(0)" class="title"><span>{{ $cache->getSelectedMarketDayFormatted() }}</span></a>
    <div class="content">
        <a href="javascript:void(0)" class="title"><span>{{ $cache->getSelectedMarketDayFormatted() }}</span></a>
        <div class="calendar">
            <div class="container">
                <div class="row">
                    <div class="intro">
                        <h3>{!! __('translations.beforeProceedSelectMarketday') !!}</h3>
                        <p>
                            {!! __('translations.marketDayInfoWithUrl') !!}
                        </p>
                    </div>
                    <div class="days">
                        @foreach($cache->getClosestMarketDayList() as $availableTo => $marketDay)
                        <div class="sv-day {{ $cache->isSelectedMarketDay($marketDay)?"is-active":"" }}">
                            <div>
                                <div class="nr">
                                    <span>{{ $marketDay->date->format('d') }}</span>
                                    <span>{!! __(":month", ["month" => $marketDay->date->format('F')]) !!}</span>
                                </div>
                                <div class="name">
                                    {{ $marketDay->name }}
                                </div>
                            </div>
                            <a href="{{ r('setMarketDay', [$availableTo]) }}" class="button">{!! __('translations.chooseMarketDay') !!}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>