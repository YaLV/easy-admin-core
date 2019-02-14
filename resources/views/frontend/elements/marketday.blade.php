
<div class="sv-marketday-dropdown">
    <a href="javascript:void(0)" class="title"><span>{{ $cache->getSelectedMarketDayFormatted() }}</span></a>
    <div class="content">
        <a href="javascript:void(0)" class="title"><span>{{ $cache->getSelectedMarketDayFormatted() }}</span></a>
        <div class="calendar">
            <div class="container">
                <div class="row">
                    <div class="intro">
                        <h3>Pirms turpini -<br />izvēlies <span>tirgus dienu</span></h3>
                        <p>
                            Tirgus diena ir diena uz kuru notiks produktu pievedums. <a href="#">Uzzini vairāk</a>
                        </p>
                    </div>
                    <div class="days">
                        @foreach($cache->getClosestMarketDayList() as $availableTo => $marketDay)
                        <div class="sv-day {{ $cache->isSelectedMarketDay($marketDay)?"is-active":"" }}">
                            <div>
                                <div class="nr">
                                    <span>{{ $marketDay->date->format('d') }}</span>
                                    <span>{{ __(":month", ["month" => $marketDay->date->format('F')]) }}</span>
                                </div>
                                <div class="name">
                                    {{ $marketDay->name }}
                                </div>
                            </div>
                            <a href="{{ route('setMarketDay', [$availableTo]) }}" class="button">Izvēlēties</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>