<?php
include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (req_method() !== "GET") {
    bad_request();
}

if (is_empty($_GET["id"])) {
    bad_request();
}


$query = "SELECT * FROM documents d WHERE d.id = :id";
$document = exec_query($query, ["id" => $_GET["id"]])->fetch();

if (!$document) {
    not_found();
}

render("documents/view", [
    "document" => $document,
]);
