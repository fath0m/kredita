<?php
include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (req_method() !== "POST") {
    bad_request();
}

if (!is_filled_in($_POST, ["request", "name"])) {
    bad_request();
}

$query = "SELECT * FROM credit_requests WHERE id = :id";
$request = exec_query($query, [
    "id" => $_POST["request"],
])->fetch();

if (!$request) {
    not_found();
}

echo print_r($_FILES);

$target_dir = "C:\Users\Jonas\Desktop\php\kredita\www\uploads\\";
$file = $_FILES["document"]["name"];
$path_info = pathinfo($file);

$filename = time() . '_' . $path_info["filename"] . '.' . $path_info['extension'];
$path = $target_dir . $filename;
move_uploaded_file( $_FILES["document"]["tmp_name"], $path);

$query = "INSERT INTO documents (name, path, type, credit_request) VALUES (:name, :path, :type, :credit_request)";
exec_query($query, [
    "name" => $_POST["name"],
    "path" => "/uploads/" . $filename,
    "type" => "image",
    "credit_request" => $request["id"],
]);

redirect("back", null, "Dokumentas sėkmingai prisegtas");