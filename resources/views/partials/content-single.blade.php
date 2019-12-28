<header class="jumbotron jumbotron-fluid entry-thumbnail entry-header" style="background-image: url({{ get_the_post_thumbnail_url() }});">
  <div class="entry-header-inner">
    <div class="container position-relative">
      <h1 class="display-5 text-white">{{ get_the_title() }}</h1>
      <span class="text-light">@include('partials/date-meta')</span>
      {{-- <span>@include('partials/author-meta')</span> --}}
    </div>
  </div>
</header>
<div class="container">
  <article @php post_class() @endphp>
    <nav aria-label="breadcrumb">
      <!-- folder icon? -->
      <ol class="breadcrumb">
        @foreach (get_category_structure()[0] as $anc)
          <li class="breadcrumb-item">{{ get_category($anc) -> name }}</li>
        @endforeach

        <li class="breadcrumb-item"><a href="#">{{ get_category_structure()[1] -> name }}</a></li>
      </ol>
      <div class="mb-5">
        @if (has_tag())
          @foreach (get_the_tags() as $tag)
            <!-- tag icon? -->
            <span class="badge badge-dark">{{ $tag -> name }}</span>
          @endforeach
        @endif
      </div>
    </nav>
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