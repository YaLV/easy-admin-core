<div class="sv-blog-list">
    <div class="container">
        <div class="row">
            @foreach($frontController->getHighlightedPosts() as $item)
                <div class="item">
                    <a href="{{ r('blog', [__('postcategory.slug.'.$item->main_category), __('posts.slug.'.$item->id)]) }}"
                       class="link"></a>
                    <div class="title">
                        <h2>{{ __('posts.name.'.$item->id) }}</h2>
                    </div>
                    <div class="image" style="background-image: url({{ $item->getImageByKey('blog_picture') }});"></div>
                    <div class="sizing"></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
