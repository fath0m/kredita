<?php
include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (is_empty($_GET["request"])) {
    bad_request();
}

$query = "SELECT * FROM credit_requests WHERE id = :id AND is_active = 1";
$request = exec_query($query, [
    "id" => $_GET["request"],
])->fetch();

if (!$request || $request["offer"] !== null) {
    not_found();
}

if (req_method() === "GET") {
    $query = "SELECT * FROM credit_types";
    $credit_types = exec_query($query)->fetchAll();

    render("offers/create", [
        "request" => $request,
        "credit_types" => $credit_types,
    ]);
} else if (req_method() === "POST") {
    if (!is_filled_in($_POST, [
        "credit_type",
        "credit_amount_from",
        "credit_amount_to",
        "credit_length_from",
        "credit_length_to",
        "interest_rate",
        "bvkkmn",
        "payment"
    ])) {
        redirect("back", "Užpildykite formą");
    }

    if (intval($_POST["credit_amount_from"]) > intval($_POST["credit_amount_to"])) {
        redirect("back", "Paraiškos suma (nuo) negali būti didesnė nei paraiškos suma (iki)");
    }

    if (intval($_POST["credit_length_from"]) > intval($_POST["credit_length_to"])) {
        redirect("back", "Paraiškos laikotarpis (nuo) negali būti didesnė nei paraiškos laikotarpis (iki)");
    }

    $query = "INSERT INTO offers (credit_type, credit_amount_from, credit_amount_to, credit_length_from, 
                    credit_length_to, interest_rate, bvkkmn, payment, comment, manager, credit_request) VALUES
                    (:credit_type, :credit_amount_from, :credit_amount_to, :credit_length_from, 
                    :credit_length_to, :interest_rate, :bvkkmn, :payment, :comment, :manager, :credit_request)";

    try {
        exec_query($query, [
            "credit_type" => $_POST["credit_type"],
            "credit_amount_from" => $_POST["credit_amount_from"],
            "credit_amount_to" => $_POST["credit_amount_to"],
            "credit_length_from" => $_POST["credit_length_from"],
            "credit_length_to" => $_POST["credit_length_to"],
            "interest_rate" => $_POST["interest_rate"],
            "bvkkmn" => $_POST["bvkkmn"],
            "payment" => $_POST["payment"],
            "comment" => $_POST["comment"],
            "manager" => user()["id"],
            "credit_request" => $request["id"],
        ]);
    } catch (Exception $e) {
        redirect("back", "Nepavyko sukurti pasiūlymo");
    }

    $offer_id = get_db()->lastInsertId();

    $query = "UPDATE credit_requests SET offer = :offer WHERE id = :id";
    exec_query($query, [
        "offer" => $offer_id,
        "id" => $request["id"],
    ]);

    redirect("/requests/view.php?id=" . $request["id"], null, "Pasiūlymas sėkmingai išsaugotas");
} else {
    bad_request();
}

