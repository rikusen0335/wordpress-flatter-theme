<header class="jumbotron jumbotron-fluid entry-thumbnail entry-header" style="background-image: url({{ get_the_post_thumbnail_url() }});">
  <div class="entry-header-inner">
    <div class="container position-relative">
      <h1 class="display-5 text-white">{{ get_the_title() }}</h1>
      <span class="text-light">@include('partials/entry-meta')</span>
      <span>@include('partials/end-meta')</span>
    </div>
  </div>
</header>
<div class="container">
  <article @php post_class() @endphp>
    @php
      /* 参考 https://ja.wordpress.org/support/topic/%E8%A6%AA%E3%80%81%E5%AD%90%E3%80%81%E5%AD%AB%E3%81%AE%E9%A0%86%E3%81%A7%E3%82%AB%E3%83%86%E3%82%B4%E3%83%AA%E3%82%92%E8%A1%A8%E7%A4%BA%E3%81%97%E3%81%9F%E3%81%84/ */
      $post_cats = get_the_category();
      if($post_cats){
        $bottom_cat = $post_cats[0];
        $bottom_anc = get_ancestors($bottom_cat->term_id, 'category');
        foreach ($post_cats as $index => $cat) {
          if ($index > 0) {
            $anc = get_ancestors($cat->term_id, 'category');
            if(count($anc) > count($bottom_anc)){
              $bottom_cat = $cat;
              $bottom_anc = $anc;
            }
          }
        }
        $bottom_anc = array_reverse($bottom_anc);
      }
    @endphp
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        @foreach ($bottom_anc as $anc)
          <li class="breadcrumb-item">{{ get_category($anc) -> name }}</li>
        @endforeach

        <li class="breadcrumb-item"><a href="#">{{ $bottom_cat->name }}</a></li>
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