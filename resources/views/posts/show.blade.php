@extends('layouts/app')

@section('content')
    <h1>{{ $post->title }}</h1>

    <P> {{ $post->content }}</P>

    <P> {{ $post->user->name }}</P>

@endsection
