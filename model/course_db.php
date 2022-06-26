<?php

  function get_courses() {
    global $db;
    $query = "SELECT * FROM courses ORDER BY id";
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $courses;
  }

  function get_course_name($course_id) {
    if(!$course_id) return "All courses...";
    global $db;
    $query = "SELECT * FROM courses WHERE id = :course_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":course_id", $course_id);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
    return $course["name"];
  }

  function delete_course($course_id) {
    global $db;
    $query = "DELETE FROM courses WHERE id = :course_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":course_id", $course_id);
    $statement->execute();
    $statement->closeCursor();
  }

  function add_course($course_name) {
    global $db;
    $query = "INSERT INTO courses (name) VALUES(:course_name)";
    $statement = $db->prepare($query);
    $statement->bindValue(":course_name", $course_name);
    $statement->execute();
    $statement->closeCursor();
  }