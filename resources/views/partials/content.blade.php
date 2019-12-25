<div class="col-md-4 col-sm-6 col-xs-120 mb-3">
  <article id="article-card" class="card" data-my-attribute="{{ get_permalink() }}" @php post_class() @endphp>
    <img src="https://via.placeholder.com/500" class="card-img-top" alt="...">
    <div class="card-body">
      <header>
        <h5 class="card-title mb-1">{!! get_the_title() !!}</h5>
        <div class="mb-3">
        @if (has_tag())
          @foreach (get_the_tags() as $tag)
            <!-- tag icon? -->
            <span class="badge badge-dark">{{ $tag -> name }}</span>
          @endforeach
        @endif

        <!-- category -->
      </div>

      <div class="mb-3">
        @include('partials/entry-meta')
      </div>

      </header>
      <div class="card-text">
        @php the_excerpt() @endphp
      </div>
      <footer>
        @include('partials/end-meta')
      </footer>
    </div>
  </article>
</div>