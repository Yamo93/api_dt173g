<?php

class Course {
    private $db;
    public $courses;

    function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Error case
        if ($this->db->connect_errno)
        {
        printf("Fel vid anslutning", $mysqli->connect_error);
        exit();
        }
    }

    function addCourse($name, $code, $progression, $syllabus) {

        if (empty($name) || empty($code) || empty($progression) || empty($syllabus)) {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO courses(name, code, progression, syllabus) VALUES(?, ?, ?, ?)");

        $stmt->bind_param("ssss", strip_tags($name), strip_tags($code), strip_tags($progression), strip_tags($syllabus));

        $result = $stmt->execute();
        if($stmt->error) { echo $stmt->error; }

        return $result;
    }

    function getCourses() {
        $sql = "SELECT * FROM courses";

        if(!$result = $this->db->query($sql)){
            die('Fel vid SQL-fråga [' . $this->db->error . ']');
        }

        while ($row = $result->fetch_assoc()) {
            $this->courses[] = $row;
        }

        return $this->courses;
    }

    function updateCourse($name, $code, $progression, $syllabus, $id) {

        if (empty($name) || empty($code) || empty($progression) || empty($syllabus)) {
            return false;
        }

        $stmt = $this->db->prepare("UPDATE courses SET name=?, code=?, progression=?, syllabus=? WHERE id = ?;");
        $stmt->bind_param("ssssd", strip_tags($name), strip_tags($code), strip_tags($progression), strip_tags($syllabus), strip_tags($id));

        $result = $stmt->execute();
        if($stmt->error) { echo $stmt->error; }

        return $result;
    }

    function deleteCourse($id) {

        $sql = "DELETE FROM courses WHERE id = $id;";

        $result = $this->db->query($sql);

        return $result;
    }
}

?>