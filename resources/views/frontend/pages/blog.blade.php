@extends('layouts.app')

@section('content')

    @include('frontend.partials.blogTitleMain')

    <div class="sv-blank-spacer small"></div>
    <div class="sv-blog-list page-list">
        <div class="container">
            <div class="row">
                <div class="list">
                    @foreach($items as $item)
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
                <div class="sv-blog-sidebar">

                    @include('frontend.elements.blogcategories')

                    @include('frontend.elements.subscribe')

                </div>
            </div>
        </div>
    </div>

@endsection
