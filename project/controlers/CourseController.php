<?php
require_once '../config/database.php';
require_once '../models/CourseModel.php';

class CourseController {
    private $courseModel;

    public function __construct($db) {
        $this->courseModel = new CourseModel($db);
    }

    public function updateCourse($data, $files) {
        $id = $data['id'];
        $title = $data['title'] ?? null;
        $description = $data['description'] ?? null;
        $category = $data['category'] ?? null;
        $module = $data['module'] ?? null;
        $duration = $data['duration'] ?? null;
        $price = $data['price'] ?? null;
        $image = null;

        if (isset($files['image']) && $files['image']['name']) {
            $target_dir = "../assets/";
            $target_file = $target_dir . basename($files['image']['name']);
            if (move_uploaded_file($files['image']['tmp_name'], $target_file)) {
                $image = $files['image']['name'];
            }
        }

        return $this->courseModel->updateCourse($id, $title, $description, $category, $module, $duration, $price, $image);
    }

    public function deleteCourse($id) {
        return $this->courseModel->deleteCourse($id);
    }
}

$controller = new CourseController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    if ($action === 'update') {
        if ($controller->updateCourse($_POST, $_FILES)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to update course.']);
        }
    } elseif ($action === 'delete') {
        $id = $_POST['id'];
        if ($controller->deleteCourse($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to delete course.']);
        }
    }
}
?>