<?php

class web {

	public function getClassTypes()
    {
		global $db;

		$result = $db->query("SELECT * FROM class_types");

		if ($result->num_rows > 0) {
			$data = [];
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
		  return "0 results";
		}
		$db->close();
    }

	public function getTeams()
    {
		global $db;

		$result = $db->query("SELECT * FROM teams");

		if ($result->num_rows > 0) {
			$data = [];
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
		  return "0 results";
		}
		$db->close();
    }

	public function getTeamsById($id)
    {
		global $db;

		$result = $db->query("SELECT * FROM teams WHERE id = ".$id."");

		if ($result->num_rows > 0) {
			$data = [];
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
		  return "0 results";
		}
		$db->close();
    }

	public function getTeamById($id)
    {
		global $db;

		$result = $db->query("SELECT * FROM teams WHERE id = ".$id."");

		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
		  return 0;
		}
		$db->close();
    }

	public function getStudentById($id)
    {
		global $db;

		$result = $db->query("SELECT * FROM students WHERE id = ".$id."");

		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
		  return 0;
		}
		$db->close();
    }

	public function getStudentsByTeamIdAndClassTypeId($team_id,$classtype_id)
    {
		global $db;

		$result = $db->query("SELECT * FROM students WHERE team_id = ".$team_id." AND classtype_id = ".$classtype_id."");

		if ($result->num_rows > 0) {
			$data = [];
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
		  return 0;
		}
		$db->close();
    }

	public function getStudentsByTeamIdAndClassTypeIdHighestScores($team_id,$classtype_id)
    {
		global $db;

		$result = $db->query(
			"SELECT students.id, students.classtype_id, students.roll_number, students.student_name, students.house, students.team_id,
			SUM(student_scores.score) as score
			FROM students
			INNER JOIN student_scores ON student_scores.student_id = students.id
			WHERE students.team_id = ".$team_id." AND students.classtype_id = ".$classtype_id."
			GROUP BY students.id
			ORDER BY score DESC
			LIMIT 5"
		);

		if ($result->num_rows > 0) {
			$data = [];
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
		  return 0;
		}
		$db->close();
    }

	public function totalScoreByStudent($id)
    {
		global $db;

		$result = $db->query("SELECT * FROM student_scores WHERE student_id = ".$id."");

		if ($result->num_rows > 0) {
			$qty= 0;
			while($row = $result->fetch_assoc()) {
				$qty += $row['score'];
			}
			return $qty;
		} else {
		  return 0;
		}
		$db->close();
    }

	public function totalScoreByStudentsOfTeam($id)
    {
		global $db;

		$result = $db->query("SELECT * FROM student_scores WHERE team_id = ".$id."");

		if ($result->num_rows > 0) {
			$qty= 0;
			while($row = $result->fetch_assoc()) {
				$qty += $row['score'];
			}
			return $qty;
		} else {
		  return 0;
		}
		$db->close();
    }

	public function totalStudentsOfTeam($id)
    {
		global $db;

		$result = $db->query("SELECT * FROM students WHERE team_id = ".$id."");

		if ($result->num_rows > 0) {
			$data = [];
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return sizeof($data);
		} else {
		  return 0;
		}
		$db->close();
    }

	public function totalScoreByTeam($team_id)
    {
		global $db;

		$result = $db->query("SELECT * FROM scores WHERE team_id = ".$team_id."");

		if ($result->num_rows > 0) {
			$qty= 0;
			while($row = $result->fetch_assoc()) {
				$qty += $row['score'];
			}
			return $qty;
		} else {
		  return 0;
		}
		$db->close();
    }

	public function totalScoreAllTeam()
    {
		global $db;

		$result = $db->query("SELECT * FROM student_scores");

		if ($result->num_rows > 0) {
			$qty= 0;
			while($row = $result->fetch_assoc()) {
				$qty += $row['score'];
			}
			return $qty;
		} else {
		  return 0;
		}
		$db->close();
    }

}

?>