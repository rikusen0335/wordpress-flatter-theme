<span class="mb-3">
  <small>
    <span class="m-0">
      <time class="updated mr-2" datetime="{{ get_post_time('c', true) }}">
        <!-- calender icon? -->
        {{ get_the_date() }}
      </time>

      @if (get_the_date() == get_the_modified_date())
        <time datetime="{{ get_post_time('c', true) }}">
          <span class="mdi mdi-update"></span><!-- not working for now -->
          {{ get_the_modified_date() }}
        </time>
      @endif
    </span>
  </small>
</span>
