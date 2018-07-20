@extends('layouts.auth')

@section('content')
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
<uploader token="{{csrf_token()}}"></uploader>
@endsection
