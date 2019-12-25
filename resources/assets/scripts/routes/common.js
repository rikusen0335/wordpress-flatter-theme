export default {
  init() {
    $('[id=article-card]').click(function() {
      //console.log($(this).data('myAttribute'));
      test($(this).data('myAttribute'));
    });

    function test(link) {
      window.location.href = link;
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
