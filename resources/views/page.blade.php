@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @if (get_the_title() != 'aboutme')
      @include('partials.page-header')
    @else
      <div class="page-header text-center my-5">
        <h1>About me</h1>
      </div>
    @endif
    @include('partials.content-page')
  @endwhile
@endsection
