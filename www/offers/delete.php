<?php
include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (is_empty($_GET["id"])) {
    bad_request();
}

$query = "SELECT * FROM offers WHERE id = :id";
$offer = exec_query($query, ["id" => $_GET["id"]])->fetch();

if (!$offer) {
    not_found();
}

if (req_method() === "GET") {
    render("offers/delete");
} elseif (req_method() === "POST") {
    $query = "DELETE FROM offers WHERE id = :id";
    exec_query($query, [
        "id" => $offer["id"],
    ]);

    redirect("/requests/view.php?id=" . $offer["credit_request"], null, "Pasiūlymas ištrintas");
} else {
    bad_request();
}
