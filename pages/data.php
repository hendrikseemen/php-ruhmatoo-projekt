<?php
	require_once("../functions.php");
	//data
	//siia pääseb ligi sisseloginud kasutaja
	//kui kasutaja on sisse loginud
	//siis suunan data.php lehele
	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
	}
	
	//kasutaja tahab välja logida
	if(isset($_GET["logout"])){
		//aadressireal on olemas muutuja logout
		
		//kusutame kõik session muutujad ja peatame sessiooni
		session_destroy();
		
		header("Location: login.php");
	}
	
	$title = $season = $intro = $photo = "";
	$title_error = $season_error = $intro_error = $photo_error = "";
	
	
	if(isset($_POST["postseason"])){
		echo "vajutati nuppu";
		if ( empty($_POST["title"]) ) {
				$title_error = "See väli on kohustuslik";
			}else{
				$title = cleanInput($_POST["title"]);
			}

			if ( empty($_POST["season"]) ) {
				$season_error = "See väli on kohustuslik";
			} else {
				
				$season = cleanInput($_POST["season"]);
				
			}
			if ( empty($_POST["intro"]) ) {
				$intro_error = "See väli on kohustuslik";
			} else {
				
				$intro = cleanInput($_POST["intro"]);
				
			}
			if ( empty($_POST["photo"]) ) {
				$photo_error = "See väli on kohustuslik";
			} else {
				
				$intro = cleanInput($_POST["photo"]);
				
			}
		if(	$title_error == "" && $season_error == "" && $intro_error == "" && $photo_error == ""){
			
			echo "Sisestatud!";
				
				
				postseason($title, $season, $intro, $photo);
			
		}
	}
	function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
	
	
	
?>
<?php require_once("../header.php"); ?>
<div class="container">
	<div class="row">

			
		<p>
			Tere, <?=$_SESSION["name"];?>
			<a href="?logout=1">Logi välja</a>
		</p>


		<h2>Lisa uus seriaal</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
			<label for="title" >Nimi</label><br>
			<div class="form-group">
				<input name="title" id="title" type="text"  value="<?php echo $title; ?>"> <?php echo $title_error; ?><br><br>
			</div>
			<div class="form-group">
				<label for="season" >Hooaeg</label><br>
				<input name="season" type="text"  value="<?php echo $season; ?>"> <?php echo $season_error; ?><br><br>
			</div>
			<div class="form-group">
				<label for="intro" >Tutvustus</label><br>
				<textarea name="intro" rows="10" cols="100"><?php echo $intro; ?></textarea> <?php echo $intro_error; ?><br><br>
			</div>
			<div class="form-group">
				<label for="photo" >Lisa seriaali pilt</label><br>
				<input name="photo" type="text"  value="<?php echo $photo; ?>"> <?php echo $photo_error; ?><br><br>	
			</div>
			<input type="submit" name="postseason" value="Salvesta" class="btn btn-success">
		  </form>
		  
		  <a href="table.php">Vaata/Muuda postitusi</a>
	</div>
</div>
  <?php require_once("../footer.php"); ?>