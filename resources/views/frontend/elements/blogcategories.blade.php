    <ul class="menu">
        @foreach($categories as $category)
            <li>
                <a href="{{ r('blog', [__('postcategory.slug.'.$category->id)]) }}">{{ __('postcategory.name.'.$category->id) }}</a>
            </li>
        @endforeach
    </ul>
