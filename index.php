<?php 
if (!isset($_GET['script'])) {
    die('Script is needed for our funny commediants');
} else {
	$script = file_get_contents(__DIR__ . '/scripts/' . $_GET['script']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
        body {
            font-family: Arial, Sans;
        }
        #container {
            position: relative;
            border: 1px solid #000;
            height: 400px;
            width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        #captions {
            position: absolute;
            bottom: 0;
            width: 460px;
            background-color: #666;
            opacity: 0.8;
            text-align: center;
            font-size: 18px;
            color: #fff;
            font-weight: bold;
            padding: 20px;
            text-shadow: 1px 1px 1px #000;
        }
        footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
        }
        </style>
        <meta charset="UTF-8">
        <title>Comedia</title>
    </head>
    <body>
        <div id="container">
            <img width="500" height="400" src="" />
            <div id="captions">Cargando...</div>
        </div>

        <footer>(c) <?php echo date('Y') ?> Leprosystems</footer>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
        var scene = <?php echo $script ?>

        var i = 0;

        function changeSlide(src, caption) {
            $('#container img').attr('src', 'img/' + src);
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
            image.src = 'img/' + scene[j].img;
        }

        // Load first slide
        $( window ).load(function() {
            nextSlide();
        })

        </script>
    </body>
</html>