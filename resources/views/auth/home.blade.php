@extends('layouts.auth')

@section('content')
<div class="container">
    <div>
      @foreach ($articles as $article)
      <div>
          {{ $article->subject }}
          <img class="logo" src="{{ asset('storage/'.$article->image_path) }}" alt="thumbnail">
          {{ $article->body }}
        </div>
      @endforeach
      {{ $articles->links() }}
    </div>
</div>
@endsection
