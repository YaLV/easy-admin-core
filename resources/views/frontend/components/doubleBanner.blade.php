<div class="sv-image-banner">
    <div class="item">
        <a href="{{ $component->getData('leftBannerUrl') }}" class="link"></a>
        <div class="title">
            <h3>{{ $component->getData('leftBannerTitle') }}</h3>
        </div>
        <div class="image" style="background-image: url({{ $component->getComponentImage(false,"original","pageimage1") }});"></div>
        <div class="sizing"></div>
    </div>
    <div class="item">
        <a href="{{ $component->getData('rightBannerUrl') }}" class="link"></a>
        <div class="title">
            <h3>{{ $component->getData('rightBannerTitle') }}</h3>
        </div>
        <div class="image" style="background-image: url({{ $component->getComponentImage(false,"original","pageimage2") }});"></div>
        <div class="sizing"></div>
    </div>
</div>