@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @if (get_the_title() != 'aboutme')
      @include('partials.page-header')
    @endif
    @include('partials.content-page')
  @endwhile
@endsection
