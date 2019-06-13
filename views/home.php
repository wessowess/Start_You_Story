<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>démarretastory06.fr</title>

        
    	<!-- Bootstrap CSS -->
    	<link rel="stylesheet" href="./css/styleNew.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>

    <body>

		<div class="wrapper">

        	<!-- HEADER -->
        	<?php require_once('header.php'); ?>
        	<!-- HEADER END -->

        	<!-- MAIN -->
            <?php require_once('mainNew.php'); ?>
            <!-- MAIN END -->
            
            <!-- FORM -->
            <?php require_once("formulaireV3.php"); ?>
            <script>
                // var test = JSON.parse("../js/listErrors.json");
                //var listErrors = <?php //echo $jsonlist; ?>
                //console.log(listErrors);
            </script>
            <!-- FORM END -->
        
            <!-- FOOTER -->
            <?php require_once("footer.php"); ?>
            <!-- FOOTER END -->

        </div>

    	<!-- Optional JavaScript -->
    	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<script src="./js/main.js"></script>
        <script src="./js/analyseForm.js"></script>
    </body>
</html>