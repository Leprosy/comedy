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
    ?><!DOCTYPE html>
<html>
    <head>
        <style>
        body {
            font-family: Arial, sans;
            font-size: 12px;
        }
        #imgs {
            display: none;
            position: absolute;
            margin-left: auto;
            margin-right: auto;

            border: 1px solid #000;
            overflow: auto;
            background-color: #fff;
            width: 450px;
            padding: 10px;
            box-shadow: 1px 1px 20px #000;
        }
        #imgs img {
            float: left;
            margin-right: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        ul { width:0; margin-bottom: 30px; }
        li {
            list-style-type: none;
            text-align: right;
            margin-bottom: 5px;
        }
        li input {
            padding: 5px;
        }

        </style>
        <script
            src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <div id="imgs">
            Elija animación: <br />
            <?php
            
            if ($handle = opendir(__DIR__ . '/img/')) {
                /* This is the correct way to loop over the directory. */
                while (false !== ($entry = readdir($handle))) {
                	if ($entry!='.' && $entry!='..') {
                		?><img src="img/<?php echo $entry ?>" width="100" height="100"
                		onclick="setAnim(this.src)" />
                		<?php
                	}
                }

                closedir($handle);
            }
            ?>
        </div>
        <form action="new.php" method="post">
            Título: <input name="title" size="60" />
            <hr />
            <h3>Contenido:</h3>
            <div id="frames">
                <ul>
                    <li>Animación: <input name="img[]" onclick="selectImg(this)" /></li>
                    <li>Texto: <input name="caption[]" size="60" /></li>
                    <li>Duración: <input name="time[]" type="number" min="1000" max="60000" step="500" size="4" value="5000" /></li>
                </ul>
            </div>

            <input type="button" value="Agregar otro cuadro" onclick="addFrame()" />
            <hr />
            <input type="submit" value="Guardar" onclick="return valid()" />
        </form>
        <script>
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
                var frame = $('#frames ul:last-child').clone();
                $('#frames').append(frame);
            }

            function setAnim(path) {
                path = path.split('/').pop();
                elem.value = path;
                $('#imgs').fadeOut()
            }

            function selectImg(el) {
                elem = el;
                $('#imgs').fadeIn()
            }
            
        	</script>
    </body>
</html>
<?php 
}