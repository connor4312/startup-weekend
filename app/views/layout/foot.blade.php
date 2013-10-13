</div>
    <div id="footer">
      <div class="container">
        <div class="col-md-6">
          Created at <a href="https://twitter.com/search?q=%23swpns&amp;src=hash">#SWPNS</a>
        </div>
        <div class="col-md-6">
          &copy; {{ date('Y') }} Mooody
        </div>
      </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    {{ HTML::script('js/bootstrap.min.js') }}
    @if (isset($scripts))
      @if (is_array($scripts))
        @foreach ($scripts as $script)
          {{ HTML::script($script) }}
        @endforeach
      @else
        {{ HTML::script($scripts) }}
      @endif
    @endif
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44776360-1', 'mooody.co');
  ga('send', 'pageview');

</script>
  </body>
</html>