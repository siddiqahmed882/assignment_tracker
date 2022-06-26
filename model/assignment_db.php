<?php
  function get_assignment_by_course($course_id) {
    global $db;
    if($course_id){
      $query = "SELECT A.id as assignment_id, A.description as assignment_description, C.name as course_name FROM assignments A LEFT JOIN courses C on A.course_id = C.id WHERE A.course_id = :course_id ORDER BY A.id";
    } else{
      $query = "SELECT A.id as assignment_id, A.description as assignment_description, C.name as course_name FROM assignments A LEFT JOIN courses C on A.course_id = C.id ORDER BY C.id";
    }
    $statement = $db->prepare($query);
    if($course_id) $statement->bindValue(":course_id", $course_id);
    $statement->execute();
    $assignments = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $assignments;
  }

  function delete_assignment($assignment_id) {
    global $db;
    $query = "DELETE FROM assignments WHERE id = :assignment_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":assignment_id", $assignment_id);
    $statement->execute();
    $statement->closeCursor();
  }

  function add_assignment($description, $course_id){
    global $db;
    echo json_encode(["description" => $description, "course_id" => $course_id]);
    $query = "INSERT INTO assignments (description, course_id) VALUES (:description, :course_id)";
    $statement = $db->prepare($query);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":course_id", $course_id);
    $statement->execute();
    $statement->closeCursor();
  }
