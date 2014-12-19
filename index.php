<?php
if (isset($_GET['script'])) {
    $path = __DIR__ . '/scripts/' . $_GET ['script'];

    if (file_exists( $path )) {
        $script = json_decode( file_get_contents($path) );
    }
}

if (!isset( $script->title )) {
    die("Script is invalid(or not very funny)");
}
?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Comedia estúpida, generada por los propios usuarios..." />
        <meta property="og:image" content="http://comedia.l3pro.com/upimg/<?php echo $script->content[0]->img ?>"/>       
        <title><?php echo $script->title ?> - Comedia Estúpida y Barata</title>
        <link rel="stylesheet" href="css/foundation.min.css" />
        <script src="js/vendor/modernizr.js"></script>

        <style>
            /* Comedia - Leprosystems */
            .share {}
            .footer, .comedy {
                text-align: center;
            }
            .comedy h3 {
                font-weight: bold;
                text-shadow: 0 0 8px #999;
            }
            #container {
                position: relative;
                margin-left: auto;
                margin-right: auto;
            }
            .comedy img, #container {
                width: 80vw;
                height: 80vw;
                max-width: 650px;
                max-height: 650px;
            }
            #container #captions {
                width: 80vw;
                max-width: 650px;
                bottom: 0;
                position: absolute;
                color: #fff;
                text-shadow: 2px 2px 1px #000;
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <!-- Tracking -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-8155451-6', 'auto');
            ga('send', 'pageview');
        </script>

        <hr />

        <div class="row">
            <div class="panel comedy">
                <h3><?php echo $script->title ?></h3>
                <div id="container">
                    <img src="" />
                    <h4 id="captions">Cargando...</h4>
                </div>
            </div>
        </div>

        <hr />

        <div class="row share">
            <div class="large-6 medium-6 columns">
            </div>
        </div>

        <hr />

        <div class="row footer">
            <p>(c)<?php echo date('Y') ?> Leprosystems<br /><a class="tiny radius button" href="new.php">¡Crea tu propia comedia!</a></p>
        </div>
        <div class="row footer">
            <!-- Adsense -->
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Comedia ad -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:100px"
                 data-ad-client="ca-pub-1241131205896179"
                 data-ad-slot="7257820885"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();

            var scene = <?php echo json_encode($script->content) ?>;
            var i = 0;

            function changeSlide(src, caption) {
                $('#container img').attr('src', 'upimg/' + src);
                $('#captions').html(caption);
            }

            function nextSlide() {
                changeSlide(scene[i].img, scene[i].caption);
                setTimeout(function() {
                    ++i;

                    if (i == scene.length) {
                        i = 0;
                    }

                    nextSlide();
                }, scene[i].time);
            }

            /* Start */
            // Preload images
            for (j = 0; j < scene.length; ++j) {
                var image = new Image();
                image.src = 'upimg/' + scene[j].img;
            }

            // Load first slide
            $( window ).load(function() {
                nextSlide();
            })

        </script>
    </body>
</html>
