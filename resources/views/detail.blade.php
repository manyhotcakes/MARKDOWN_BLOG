@extends('layouts.public')

@section('content')
<div>
    <div>
      <v-layout row>
        <v-flex xs12>
          <article-detail rowdata="{{$article->toJson()}}">
            <breadcrumbs slot="breadcrumbs" list="{{json_encode([
              ['text' => 'Home', 'url' => route('list')],
              ['text' => $article->subject, 'url' => null]
            ])}}"></breadcrumbs>
          </article-detail>
        </v-flex>
      </v-layout>
    </div>
</div>
@endsection
