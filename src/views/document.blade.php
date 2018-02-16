@extends('ninjadocs::layout')

@section('title', $title)

@section('content')
<div class="container">
  <section class="legend">
    <div class="jumbotron">
    <h1>{{ $title }}</h1>
    <ul>
      @foreach ($content->lines() as $key => $value)
        @isset($value['link'])
          <li>
            <a href="#{{$value['link']}}">{{$value['element']['text']}}</a>
          </li>
        @endisset
      @endforeach
    </ul>
  </section>

  <section>
    {!! $content->html() !!}
  </section>
</div>
@endsection
