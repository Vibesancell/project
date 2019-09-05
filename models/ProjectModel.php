<?php

class ProjectModel extends Model {

  public function saveNumber( $roman_number, $arabic_number ) {
		$sql = "INSERT INTO numbers ( roman_number, arabic_number )
				VALUES (:roman_number, :arabic_number )
				";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":roman_number", $roman_number, PDO::PARAM_STR);
		$stmt->bindValue(":arabic_number", $arabic_number, PDO::PARAM_STR);
		$stmt->execute();
		return true;
	}


}
