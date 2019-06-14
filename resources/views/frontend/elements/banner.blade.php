@foreach($banners??[] as $banner)
    @if($banner->type!='popup')
        @continue
    @endif
    @if($banner->frequency=='always' || ($banner->frequency=='once_per_session' && !session()->has('banner'.$banner->id)) || ($banner->frequency=='once_a_week' && !request()->cookie('banner'.$banner->id)))
        <div class="sv-lightbox sv-newsletter hidden_ visuallyhidden_">
            <div class="content">
                <div class="content-sv-newsletter">
                    <form style="max-width:80%;max-height:80%;overflow:hidden;height:auto;width:auto;background:none;padding:0">
                        <a href="javascript:void(0)" class="sv-close toggle-sv-newsletter reportClose"
                           data-url="{{ route('closeBanner', [$banner->id]) }}"></a>
                        <a href="{{ $banner->meta['url'][language()] }}"
                           target="{{ $banner->meta['target'][language()] }}">
                            <img src="{{ $banner->getImageById($banner->meta['image'][language()]) }}"
                                 style="width:100%;height:100%;" />
                        </a>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach