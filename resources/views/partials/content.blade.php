<div class="col-md-4 col-sm-6 col-xs-120 mb-5">
  <article id="article-card" class="card" data-my-attribute="{{ get_permalink() }}" @php post_class() @endphp>
    <figure class="card-img-wrapper">
      @if (has_post_thumbnail())
        {{ the_post_thumbnail('full', ['class' => 'card-img-top']) }}
      @else
        <img src="https://via.placeholder.com/500" class="card-img-top" alt="No image">
      @endif

      @if (has_category())
        <p>
          <!-- folder icon? -->
          {{ get_lowest_category() }}
        </p>
      @endif
    </figure>
    <div class="card-body">
      <header>
        <h5 class="card-title">{!! get_the_title() !!}</h5>
      </header>

      <div class="card-text">
        @php the_excerpt() @endphp
      </div>

      <footer>
        <div class="text-center">
          @if (has_tag())
            @foreach (get_the_tags() as $tag)
              <!-- tag icon? -->
              <span class="badge badge-dark">{{ $tag -> name }}</span>
            @endforeach
          @endif
        </div>
        <div class="text-center">
          @include('partials/date-meta')
        </div>
        {{-- 投稿者名は書かなくても良さそう？ @include('partials/author-meta') --}}
      </footer>
    </div>
  </article>
</div>