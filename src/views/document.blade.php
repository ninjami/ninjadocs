@extends('ninjadocs::layout')

@section('title', $title)

@section('content')
<div class="container">
  <section class="legend">
    <div class="jumbotron">
    <h1>{{ $title }}</h1>
  </section>

  <section>
    {!! $content !!}
  </section>
</div>
@endsection
