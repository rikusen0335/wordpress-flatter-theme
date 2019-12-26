<header class="jumbotron jumbotron-fluid entry-thumbnail entry-header" style="background-image: url({{ the_post_thumbnail_url() }});">
  <div class="bg-inner">
    <div class="container header-meta">
      <h1 class="display-5 text-white">{!! get_the_title() !!}</h1>
      <span class="text-light">@include('partials/entry-meta')</span>
      <span>@include('partials/end-meta')</span>
    </div>
  </div>
</header>
<div class="container">
  <article @php post_class() @endphp>
    <div class="entry-content">
      @php the_content() @endphp
    </div>
    <footer>
      {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    </footer>
    {{-- @php comments_template('/partials/comments.blade.php') @endphp --}}
    {{-- @include ('partials/disqus') --}}
  </article>
</div>