<html>
    <head>        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Comedia estúpida, generada por los propios usuarios..." />
        <meta property="og:image" content="http://comedia.l3pro.com/upimg/rossa1.gif"/>       
        <title>Lista - Comedia Estúpida y Barata</title>
        <link rel="stylesheet" href="css/foundation.min.css" />
        <script src="js/vendor/modernizr.js"></script>
    </head>

    <body>
        <div class="row">
            <div class="small-12 column">
    
            <?php
            $path = __DIR__ . '/scripts/';
            
            if ($handle = opendir($path)) {
                /* This is the correct way to loop over the directory. */
                while (false !== ($entry = readdir($handle))) {
                	if ($entry!='.' && $entry!='..') {
                	    $content = file_get_contents($path . $entry);
                        $date = date('Y-m-d H:i:s', filectime($path.$entry));
                		?>
    		            <div class="row">
                            <div class="small-8 column">
                		    <?php echo json_decode($content)->title ?> => <a href="<?php echo $entry ?>">comedia/<?php echo $entry ?></a>
                		    </div>
                		    <div class="small-4 column">
                		    <?php echo $date ?>
                		    </div>
            		    </div>
            		    <?php
                	}
                }
    
                closedir($handle);
            }
            ?>
            </div>
        </div>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>