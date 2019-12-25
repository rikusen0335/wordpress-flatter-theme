<div class="col-md-4 col-sm-6 col-xs-120 mb-3">
  <article id="article-card" class="card" data-my-attribute="{{ get_permalink() }}" @php post_class() @endphp>
    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
    <div class="card-body">
      <header>
        <h5 class="card-title">{!! get_the_title() !!}</h5>
        @include('partials/entry-meta')
      </header>
      <div class="card-text">
        @php the_excerpt() @endphp
      </div>
    </div>
  </article>
</div>