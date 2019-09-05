<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Converter Page</title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Chilanka&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
    <div class="convert">
        <div class="title_convert">
          <h1 class="text-center login-title">Roman and Arabic number converter</h1>
            <form  method="post" data-ng-submit="saveNumber()">
							<div class="roman_number">
								<p>Enter roman number</p>
								<textarea rows="10" cols="40" name="roman_number" placeholder="Exmaple:MVII" id="roman_number" required><?php  if(isset( $_POST['roman_number'] )){ echo $_POST['roman_number']; }?></textarea>
							</div>
							<div class="arabic_number">
								<p>Arabic number</p>
								<textarea rows="10" cols="40" name="arabic_number" id="arabic_number" readonly><?php if(isset( $_POST['roman_number'] ) ){
										if( is_numeric( $_POST['roman_number'])){
											trim(ProjectController::toNumeral(  $_POST['roman_number'] ) );
										} elseif (is_string( $_POST['roman_number'] ) ){
											trim(ProjectController::Roman2Int(  $_POST['roman_number'] ));
										}
									}?></textarea>
							</div>
							<button type="submit" class="button"><i class="fas fa-arrows-alt-h"></i></button>
      		</div>
				</form>
			</div>
			<table class="table_blur">
				<thead>
	        <tr>
	          <th>Roman Number</th>
	          <th>Arabic Number</th>
	          <th>Latin Number</th>
	        </tr>
	      </thead>
				<tr>
			    <td>I</td>
			    <td>1</td>
			    <td>unus</td>
		    </tr>
			  <tr>
					<td>V</td>
			    <td>5</td>
			    <td>quinque</td>
		    </tr>
			  <tr>
					<td>X</td>
			    <td>10</td>
			    <td>decem</td>
		    </tr>
			  <tr>
					<td>L</td>
			    <td>50</td>
			    <td>quinquaginta</td>
			    </tr>
				<tr>
					<td>C</td>
					<td>100</td>
					<td>centum</td>
				</tr>
				<tr>
					<td>D</td>
					<td>500</td>
					<td>quingenti</td>
				</tr>
				<tr>
					<td>M</td>
					<td>1000</td>
					<td>mille</td>
				</tr>
			</table>
		</div>
		<script src="js/angular.min.js"></script>
	<script src="js/users.js"></script>
</body>
</html>
<?php require_once('controllers/ProjectController.php');
require_once('models/ProjectModel.php');
if( isset( $_POST['roman_number'] ) && isset( $_POST['arabic_number'] ) ){
	  $file = "save_number.txt";
	if ( ! file_exists( $file ) ) {
		$fp = fopen( $file, "w" );
		fwrite( $fp, strip_tags( $_POST['roman_number'] . "  " .  $_POST['arabic_number'] . PHP_EOL ) );
		fclose( $fp );
	} else {
	 $fp = fopen( $file, "a" );
		fwrite( $fp, strip_tags( $_POST['roman_number'] . "  " . $_POST['arabic_number'] . PHP_EOL ) );
	 fclose( $fp );
		}
}
?>
