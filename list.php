<?php
$path = __DIR__ . '/scripts/';
$list = array();

if ($handle = opendir($path)) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        if ($entry!='.' && $entry!='..') {
            $content = json_decode(file_get_contents($path . $entry));
            $content->date = date('Y-m-d H:i:s', filectime($path.$entry));
            $content->link = $entry;
            $list[] = $content;
        }
    }

    closedir($handle);
}

?>
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
        <?php 
        foreach ($list as $item) {
        ?>
            <div class="row">
              <div class="large-12 columns">
                <div class="panel clearfix">
                  <h4><a href="<?php echo $item->link ?>"><?php echo $item->title ?></a></h4>

                  <div class="large-2 columns">
                    <img class="th" src="upimg/<?php echo $item->content[0]->img ?>" width="100" height="100" />
                  </div>

                  <div class="large-10 columns">
                    <p>"<?php echo $item->content[0]->caption ?>"</p>
                    <small>Creado en: <?php echo $item->date ?></small>
                  </div>

                </div>
              </div>
            </div>
        <?php 
        }
        ?>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>