<time class="updated mr-3" datetime="{{ get_post_time('c', true) }}">公開日: {{ get_the_date() }}</time>
<time datetime="{{ get_post_time('c', true) }}">更新日: {{ get_the_modified_date() }}</time>
<p class="byline author vcard">
  {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">
    {{ get_the_author() }}
  </a>
</p>
