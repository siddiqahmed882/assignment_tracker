<?php 
  require_once("model/database.php");
  require_once("model/assignment_db.php");
  require_once("model/course_db.php");

  $assignment_id = filter_input(INPUT_POST, "assignment_id", FILTER_VALIDATE_INT);
  $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $course_name = filter_input(INPUT_POST, "course_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $course_id = filter_input(INPUT_POST, "course_id", FILTER_VALIDATE_INT);
  if(!$course_id){
    $course_id = filter_input(INPUT_GET, "course_id", FILTER_VALIDATE_INT);
  }

  $action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if(!$action) {
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(!$action) $action = "list_assignments";
  }

  function render_view($view, $params = []){
    foreach($params as $key => $value ){
      $$key = $value;
    }
    global $course_id;
    ob_start();
    include_once("view/$view.php");
    $content = ob_get_clean(); // content variable is to be used in _layout
    include_once("view/_layout.php");
  }

  switch($action){
    case "list_courses":
      $courses = get_courses();
      render_view("course_list", [
        "courses" => $courses,
      ]);
      break;
    case "add_course":
      add_course($course_name);
      header("Location: .?action=list_courses");
      break;
    case "delete_course":
      if($course_id){
        try{
          delete_course($course_id);
        } catch(PDOException $e){
          render_view("error", [
            "error" => "You can not delete a course if assignments exist on the course."
          ]);
        }
        header("Location: .?action=list_courses");
      }
      break;
    case "add_assignment":
      if($course_id && $description){
        add_assignment($description, $course_id);
        header("Location: .?course_id=$course_id");
      } else{
        $error = "Invalid assignment data. Check all fields and try again.";
        render_view("error", [
          "error" => $error,
        ]);
      }
      break;
    case "delete_assignment":
      if($assignment_id){
        delete_assignment($assignment_id);
        header("Location:.?course_id=$course_id");
      } else{
        render_view("error", [
          "error" => "Missing or invalid assignment id"
        ]);
      }
      break;
    default:
      $course_name = get_course_name($course_id);
      $courses = get_courses();
      $assignments = get_assignment_by_course($course_id);
      render_view("assignment_list", [
        "course_name" => $course_name,
        "courses" => $courses,
        "assignments" => $assignments,
      ]);
  }