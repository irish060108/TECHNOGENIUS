<?php

// All Section
function getAllSections($conn){
	$sql = "SELECT * FROM section";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	if ($stmt->rowCount() >= 1){
		$sections = $stmt->fetchAll();
		return $sections;

	}else {
		return 0;
	}

}

// Get Section by Id
function getSectionById($section_id, $conn){
	$sql = "SELECT * FROM section
			WHERE section_id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$section_id]);

	if ($stmt->rowCount() == 1){
		$section = $stmt->fetch();
		return $section;

	}else {
		return 0;
	}
}

