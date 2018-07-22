@extends('layouts.auth')

@section('content')
<v-content>
  {{--成功時のメッセージ--}}
  @if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  {{-- エラーメッセージ --}}
  @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
      </div>
  @endif

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
</v-content>
<uploadfooter token="{{csrf_token()}}" url="{{route('upload')}}"></uploadfooter>
@endsection
