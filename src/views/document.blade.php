@extends('ninjadocs::layout')

@section('title', $title)

@section('content')
<div class="container">
  <section class="legend">
    <h1>{{ $title }}</h1>
    <ul class="table-of-contents list-unstyled">
      @foreach ($content->lines() as $object)
        @isset($object['link'])
          <li class="{{$object['element']['name']}}-link">
            <a href="#{{$object['link']}}">{{$object['element']['text']}}</a>

            @isset($object['link-inset'])
              <ul>
            @else

            @endisset
          </li>
        @endisset
      @endforeach
    </ul>
  </section>

  <hr>

  <section class="document-content">
    {!! $content->html() !!}
  </section>
</div>
@endsection
