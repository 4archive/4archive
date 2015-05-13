<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title', '4archive - Easily archive your favorite 4chan threads')</title>
        
        <link rel="stylesheet" href="/css/homepage.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="@yield('description')" />
        <link rel="icon" type="image/ico" href="/favicon.ico">
        <meta name="ROBOTS" content="noarchive">
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div id="wrapper">
            <header>
                <a href="/" title="4archive"><div class="header-banner"></div></a>
                <nav>
                    <a href="/">homepage</a> / 
                    <a href="/faq">faq</a> / 
                    <a href="/donate">donate</a> / 
                    <a href="/takedown">takedown</a> / 
                    <a href="/terms">terms of service</a>
                </nav>
            </header>
            <div class="content-header">
                @yield('contentHeaer', '4archive')
            </div>

            @yield('content')

            <footer>
                <a href="mailto:admin@4archive.org">admin@4archive.org</a> / <a href="http://www.twitter.com/4archive">@4archive</a> / <a href="http://www.facebook.com/4archive">facebook</a><br />
                
                <strong>4archive is in no way associated with 4chan.org or its affiliates.</strong><br />
                Server time: <?php echo date('F d Y, h:i A'); ?>
            </footer>
        </div>
        <div id="socialLinks">
            <a href="https://twitter.com/4archive" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @4archive</a><br />
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
            </script>
            <br />
            <div class="fb-like" data-href="http://facebook.com/4archive" data-width="130" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
        </div>
    </body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/main.js"></script>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-42862980-4', '4archive.org');
      ga('send', 'pageview');
    </script>
</html>