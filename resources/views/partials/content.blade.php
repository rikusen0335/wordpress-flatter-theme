<div class="col-lg-4">
  <article class="card" @php post_class() @endphp>
    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
    <div class="card-body">
      <header>
        <h5 class="card-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h5>
        @include('partials/entry-meta')
      </header>
      <div class="card-text">
        @php the_excerpt() @endphp
      </div>
    </div>
  </article>
</div>