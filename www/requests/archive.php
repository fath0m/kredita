<?php
include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (is_empty($_GET["id"])) {
    bad_request();
}

$query = "SELECT * FROM credit_requests WHERE id = :id AND is_active = 1";
$request = exec_query($query, [
    "id" => $_GET["id"],
])->fetch();

if (!$request) {
    not_found();
}

if (req_method() === "GET") {
    render("requests/archive");
} elseif (req_method() === "POST") {
    $query = "UPDATE credit_requests SET is_active = 0 WHERE id = :id";
    exec_query($query, [
        "id" => $request["id"],
    ]);

    redirect("/requests/view.php?id=" . $request["id"], null, "Paraiška sėkmingai suarchyvuota");
} else {
    bad_request();
}
