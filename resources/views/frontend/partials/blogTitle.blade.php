<div class="sv-page-title">
    <h2>
        {{ __('posts.name.'.$item->id) }}
    </h2>
    <h3>
        <a href="{{ r('blog') }}">{{ __('translations.blog') }}</a>
        <a href="{{ r('blog', [__('postcategory.slug.'.$item->main_category)]) }}">{{ __('postcategory.name.'.$item->main_category) }}</a>
    </h3>
</div>