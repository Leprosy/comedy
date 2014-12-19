<?php
if (isset($_POST['title'])) {
    $obj = array();
    $obj["title"] = $_POST['title'];
    $obj["content"] = array();

    foreach ($_POST['img'] as $i => $item) {
    	$subobj = array();
    	$subobj['img'] = $item;
    	$subobj['caption'] = $_POST['caption'][$i];
    	$subobj['time'] = $_POST['time'][$i];
    	$obj["content"][] = $subobj;
    }

    $filename = substr(md5(time()), 0 ,10);
    $file = fopen(__DIR__ . "/scripts/" . $filename, "w");
    fwrite($file, json_encode($obj));
    fclose($file);

    header('Location: ' . $filename);
} else {
    ?><!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Editor de la comedia estúpida, generada por los propios usuarios..." />
        <meta property="og:image" content="http://comedia.l3pro.com/upimg/kramer1.gif"/>
        <title>Editor de diálogos - Comedia Estúpida y Barata</title>
        <link rel="stylesheet" href="css/foundation.min.css" />
        <script src="js/vendor/modernizr.js"></script>
        <style>
            #imgs img {
                width: 60px;
                height: 60px;
            }
        </style>
    </head>

    <body>
        <div id="imgs" class="reveal-modal" data-reveal>
            <h3>Elija animación:</h3>
            <?php

            if ($handle = opendir(__DIR__ . '/upimg/')) {
                /* This is the correct way to loop over the directory. */
                while (false !== ($entry = readdir($handle))) {
                	if ($entry!='.' && $entry!='..') {
                		?>
                		<a class="th" href="javascript:void(0)" onclick="setAnim(this)"><img src="upimg/<?php echo $entry ?>" /></a>
                		<?php
                	}
                }

                closedir($handle);
            }
            ?>

            <a class="close-reveal-modal">&#215;</a>
        </div>

        <form action="new.php" method="post">
            <div class="row">
                <h3>Crea tu diálogo</h3>
            </div>

            <div class="row">
                <div class="large-12 columns">
                  <label>Título del Dialogo
                    <input type="text" name="title" placeholder="Elija un título interesante..." />
                  </label>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns" id="frames">
                    <fieldset>
                        <legend>Cuadro 1:</legend>
                        <div class="large-6 columns">
                            <label>Imagen:
                                <input type="text" name="img[]" onclick="selectImg(this)" />
                            </label>
                        </div>

                        <div class="large-6 columns">
                            <label>Duración:
                                <input name="time[]" type="number" value="3000" step="500" min="1000" max="60000" />
                            </label>
                        </div>

                        <div class="large-12 columns">
                            <label>Texto:
                                <textarea name="caption[]" placeholder="Acá va el texto de este cuadro(opcional)..." rows="4"></textarea>
                            </label>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <a class="tiny radius button info" href="javascript:addFrame()">Agregar otro cuadro</a>
                    <input type="submit" class="tiny radius button" value="Guardar" onclick="return valid()" />
                </div>
            </div>
        </form>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
            var elem = null;

            function valid() {
                var valid = true;
                $('input').each(function(a,b) {
                    if (b.value == '') {
                        valid = false
            	    } 
                });

        	    if (!valid) {
            	    alert('Complete los campos');
        	    }

        	    return valid;
        	}

            function addFrame() {
                var frame = $('#frames fieldset:last-child').clone();
                frame.children()[0].innerHTML = "Cuadro " + (1 + $('#frames fieldset').length) +" :";
                $('#frames').append(frame);
            }

            function setAnim(an) {
                var path = an.children[0].src.split('/').pop();
                elem.value = path;
                $('#imgs').foundation('reveal', 'close');
            }

            function selectImg(el) {
                elem = el;
                $('#imgs').foundation('reveal', 'open');
            }
        </script>
    </body>
</html>
<?php 
}