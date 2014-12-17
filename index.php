<?php
if (!isset($_GET['script'])) {
    die( 'Script is needed for our funny commediants');
} else {
    $path = __DIR__ . '/scripts/' . $_GET ['script'];
    
    if (!file_exists( $path )) {
        die("Script is invalid(or not very funny)");
    } else {
        $script = json_decode( file_get_contents($path) );
        
        if (!isset( $script->title )) {
            die("Script is invalid(or not very funny)");
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $script->title ?> - Comedia barata</title>
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
        
        #title {
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        </style>
        <meta charset="UTF-8">
        <meta name="Description" content="Comedia estúpida, generada por los propios usuarios..." />
        <meta property="og:image" content="img/kramer1.gif"/>

    </head>
    <body>
        <div id="title"><?php echo $script->title ?></div>
        <div id="container">
            <img width="500" height="400" src="" />
            <div id="captions">Cargando...</div>
        </div>
    
        <footer>(c) <?php echo date('Y') ?> Leprosystems</footer>
        <script
            src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            var scene = <?php echo json_encode($script->content) ?>
    
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