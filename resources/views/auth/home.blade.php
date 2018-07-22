@extends('layouts.auth')

@section('content')
<div class="container">
    <div>
      <v-layout row>
        <v-flex xs12>
          <article-list
            mode="admin"
            rowdata="{{ $articles->toJson() }}"
            token="{{csrf_token()}}"></article-list>
        </v-flex>
      </v-layout>
      {{ $articles->links('vendor.pagination.default') }}
    </div>
</div>
@endsection
