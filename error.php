<?php
	require_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <link href="<?php echo $WEB_PATH ?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $WEB_PATH ?>lib/jQuery/jquery-3.2.1.min.js" type="text/javascript" ></script>
        <script src="<?php echo $WEB_PATH ?>lib/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
    </head>
    <body>
        <div class="alert alert-warning">
            <strong>Atención:</strong>
						<?php
							$message = filter_input(INPUT_GET, 'message', FILTER_SANITIZE_STRING);
            	echo $message;
						?>
        </div>
    </body>
</html>
