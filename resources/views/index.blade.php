@extends('layouts.public')

@section('content')
<div class="container">
    <div>
      <v-layout row>
        <v-flex xs12>
          <article-list rowdata="{{ $articles->toJson() }}"></article-list>
        </v-flex>
      </v-layout>
      {{ $articles->links('vendor.pagination.default') }}
    </div>
</div>
@endsection
