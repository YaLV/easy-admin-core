<div class="sv-page-title">
    <h2>
        <a href="{{ r('blog') }}">{{ __('translations.blog') }}</a>
        @if($currentCategory)
            <a href="{{ r('blog', [__('postcategory.slug.'.$currentCategory)]) }}">{{__('postcategory.name.'.$currentCategory)}}</a>
        @endif
    </h2>
</div>