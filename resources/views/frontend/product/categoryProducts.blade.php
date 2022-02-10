@extends('frontend.layouts.app')

@section('app-scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection

@section('content')
    <div id="container">
        <div class="container">
            <div id="app">
                <category-product-component :category="{{$category}}"></category-product-component>
            </div>
        </div>
    </div>
@endsection
