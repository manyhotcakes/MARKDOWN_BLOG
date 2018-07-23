@extends('layouts.public')

@section('content')
<v-content>
<title-area title="{{config('app.name')}}"
  background-path="{{asset('backgroundimage.png')}}"
  logo-path="{{asset('Markdown-mark.svg')}}"
  login-page-url="{{route('login')}}"></title-area>
<div class="container">
    <div>
      <article-list rowdata="{{ $articles->toJson() }}"></article-list>
      {{ $articles->links('vendor.pagination.default') }}
    </div>
</div>
</v-content>
@endsection
