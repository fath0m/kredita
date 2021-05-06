<?php
include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (is_empty($_GET["id"])) {
    bad_request();
}

$query = "SELECT * FROM documents d WHERE d.id = :id";
$document = exec_query($query, ["id" => $_GET["id"]])->fetch();

if (!$document) {
    not_found();
}

if (req_method() === "GET") {
    render("documents/delete");
} elseif (req_method() === "POST") {
    $query = "DELETE FROM documents WHERE id = :id";
    exec_query($query, [
       "id" => $document["id"],
    ]);

    redirect("/requests/view.php?id=" . $document["credit_request"], null, "Dokumentas ištrintas");
} else {
    bad_request();
}
