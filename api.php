<?php
    // Importing classes and instantiation of object
    spl_autoload_register(function ($class_name) {
        include $class_name . '.php';
    });

    include('properties.php');

    $course = new Course();

    // API initialization
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');

    $method = $_SERVER['REQUEST_METHOD'];
    $input = json_decode(file_get_contents('php://input'), true);

    switch ($method) {
        case "GET":
        $response = $course->getCourses();
        
            if(sizeof($response) > 0) {
                http_response_code(200);
            } else {
                $response = ['message' => 'Inga kurser hittades.', 'class' => 'error-message'];
            }
            break;

        case "POST":
            if ($course->addCourse($input['name'], $input['code'], $input['progression'], $input['syllabus'])) {
                http_response_code(200);
                $response = ['message' => 'Kurs tillagd.', 'class' => 'success-message'];
            } else {
                http_response_code(500);
                $response = ['message' => 'Fel vid tillägg av kurs.', 'class' => 'error-message'];
            }
            break;

        case "PUT":
            if ($course->updateCourse($input['name'], $input['code'], $input['progression'], $input['syllabus'], $input['id'])) {
                http_response_code(200);
                $response = ['message' => 'Kurs uppdaterad.', 'class' => 'success-message'];
            } else {
                http_response_code(500);
                $response = ['message' => 'Fel vid uppdatering av kurs.', 'class' => 'error-message'];
            }

            break;

        case "DELETE":
            if ($course->deleteCourse($input['id'])) {
                http_response_code(200);
                $response = ['message' => 'Kurs raderad.', 'class' => 'error-message'];
            } else {
                http_response_code(500);
                $response = ['message' => 'Fel vid radering av kurs.', 'class' => 'error-message'];
            }
            break;

        default:
            // Code
            break;
    }

    echo json_encode($response);

?>
