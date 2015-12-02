<?php
class Series {
	
	private $connection;
	private $user_id;
	
	//kui tekitan new, siis k�ivitatakse see funktsioon
	
	function __construct($mysqli, $user_id_from_session){
		
		$this->connection = $mysqli;
		$this->user_id = $user_id_from_session;
		
		echo "Huvialade haldus k�ivitatud, kasutaja=".$this->user_id;
		
	}
	
	function addSeries($add_series){
		
		$response = new StdClass();
		
		
		$stmt = $this->connection->prepare("SELECT id FROM series WHERE name=?");
		$stmt->bind_param("s", $add_interest);
		$stmt->bind_result($id);
		$stmt->execute();
		
		if($stmt->fetch()){
			
			
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Seriaal <strong>".$add_interest."</strong> on juba olemas!";
			
			$response->error = $error;
			
			return $response;
			
		}
		
		$stmt->close();
		
		$stmt = $this->connection->prepare("INSERT INTO series (name, season, description, picture) VALUES (?, ?, ?, ?)");
				
		
		$stmt->bind_param("ssss", $name, $season, $description, $picture);
		if($stmt->execute()) {
			
			$success = new StdClass();
			$success->message = "Seriaal edukalt sisestatud!";
			$response->success = $success;
			
			
		}else {
			
			//midagi l�ks katki
			$error = new StdClass();
			$error->id = 1;
			$error->message = "Midagi l�ks katki!";
			
			$response->error = $error;
			
			
		}
		
		
		$stmt->close();
		
		return $response;
		
		
	}
	
	
	function addUserList($add_list){
		
		$response = new StdClass();
		
		//kas sellel kasutajal on see list
		$stmt = $this->connection->prepare("SELECT id FROM user_list WHERE user_id=? AND name=?");
		$stmt->bind_param("is", $this->user_id, $add_list);
		$stmt->bind_result($id);
		$stmt->execute();
		
		if($stmt->fetch()){
			
			
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Sellise nimega list on sinul juba olemas!";
			
			$response->error = $error;
			
			return $response;
			
		}
		
		$stmt->close();
		
		$stmt = $this->connection->prepare("INSERT INTO user_list (user_id, name) VALUES (?,?)");
				
		
		$stmt->bind_param("is", $this->user_id, $new_interest_id);
		if($stmt->execute()) {
			
			$success = new StdClass();
			$success->message = "Huviala edukalt sisestatud!";
			$response->success = $success;
			
			
		}else {
			
			//midagi l�ks katki
			$error = new StdClass();
			$error->id = 1;
			$error->message = "Midagi l�ks katki!";
			
			$response->error = $error;
			
			
		}
		
		
		$stmt->close();
		
		return $response;
		
		
	}
	
} ?>