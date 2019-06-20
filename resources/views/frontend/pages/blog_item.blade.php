@extends('layouts.app')

@section('content')

    @include('frontend.partials.blogTitle')

    <div class="sv-blank-spacer small"></div>

    <div class="sv-blog-list page-list">
        <div class="container">
            <div class="row">
                <div class="post">
                    {{ __('posts.content.'.$item->id) }}
                </div>
                <div class="sv-blog-sidebar">

                    @include('frontend.elements.blogcategories')

                    @include('frontend.elements.subscribe')

                </div>
            </div>
        </div>
    </div>
@endsection
