<?php

include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (is_empty($_GET["id"])) {
    bad_request();
}

//$query = "SELECT * FROM credit_requests r WHERE r.id = :id AND r.offer IS NOT NULL AND r.signature IS NULL AND r.is_active = 1";
$query = "SELECT * FROM credit_requests WHERE id = :id AND offer IS NOT NULL AND signature IS NULL AND is_active = 1";
$request = exec_query($query, [
    "id" => $_GET["id"],
])->fetch();

if (!$request) {
    not_found();
}

if (req_method() === "GET") {
    $query = "SELECT * FROM credit_types";
    $credit_types = exec_query($query)->fetchAll();

    render("requests/sign", [
        "request" => $request,
        "credit_types" => $credit_types,
    ]);
} else if (req_method() === "POST") {
    if (!is_filled_in($_POST, [
        "credit_type",
        "credit_amount",
        "credit_length",
        "interest_rate",
        "bvkkmn",
        "payment"
    ])) {
        redirect("back", "Užpildykite formą");
    }

    $query = "INSERT INTO signatures (credit_type, credit_amount, credit_length, interest_rate, bvkkmn, payment, 
                        manager, credit_request) VALUES (:credit_type, :credit_amount, :credit_length, :interest_rate,
                        :bvkkmn, :payment, :manager, :credit_request)";

    try {
        exec_query($query, [
            "credit_type" => $_POST["credit_type"],
            "credit_amount" => $_POST["credit_amount"],
            "credit_length" => $_POST["credit_length"],
            "interest_rate" => $_POST["interest_rate"],
            "bvkkmn" => $_POST["bvkkmn"],
            "payment" => $_POST["payment"],
            "manager" => user()["id"],
            "credit_request" => $request["id"],
        ]);
    } catch (Exception $e) {
        redirect("back", "Nepavyko pasirašyti sutarties");
    }

    $signature_id = get_db()->lastInsertId();

    $query = "UPDATE credit_requests SET signature = :signature WHERE id = :id";
    exec_query($query, [
        "signature" => $signature_id,
        "id" => $request["id"],
    ]);

    redirect("/requests/view.php?id=" . $request["id"], null, "Sutartis sėkmingai pasirašyta");
} else {
    not_found();
}