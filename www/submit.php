<?php
include_once("../bootstrap.php");

if (req_method() === "GET") {
    // Get valid credit types
    $query = "SELECT * FROM credit_types";
    $credit_types = exec_query($query)->fetchAll();

    render("submit", [
        "credit_types" => $credit_types,
    ]);
} else if (req_method() === "POST") {
    if (!is_filled_in($_POST, [
        "first_name",
        "last_name",
        "personal_id",
        "email",
        "contact_number",
        "credit_type",
        "credit_amount",
        "credit_length",
        "personal_income",
        "financial_obligations",
        "work_experience"
    ])) {
        redirect("back", "Užpildykite formą");
    }

    if (!is_email($_POST["email"])) {
        redirect("back", "Neteisingas el. paštas");
    }

    if (strlen($_POST["personal_id"]) !== 11) {
        redirect("back", "Neteisingas asmens kodas");
    }

    if (strlen($_POST["contact_number"]) !== 8) {
        redirect("back", "Neteisingas kontaktinis telefonas");
    }

    $query = "INSERT INTO credit_requests (first_name, last_name, personal_id, email, contact_number, is_married, 
                             credit_type, credit_amount, credit_length, personal_income, financial_obligations,
                             work_experience) VALUES (:first_name, :last_name, :personal_id, :email, :contact_number,
                                                      :is_married, :credit_type, :credit_amount, :credit_length,
                                                      :personal_income, :financial_obligations, :work_experience)";

    try {
        exec_query($query, [
            "first_name" => $_POST["first_name"],
            "last_name" => $_POST["last_name"],
            "personal_id" => $_POST["personal_id"],
            "email" => $_POST["email"],
            "contact_number" => $_POST["contact_number"],
            "is_married" => isset($_POST["is_married"]) && $_POST["is_married"] === "on" ? 1 : 0,
            "credit_type" => $_POST["credit_type"],
            "credit_amount" => $_POST["credit_amount"],
            "credit_length" => $_POST["credit_length"],
            "personal_income" => $_POST["personal_income"],
            "financial_obligations" => $_POST["financial_obligations"],
            "work_experience" => $_POST["work_experience"]
        ]);
    } catch (Exception $e) {
        redirect("back", "Nepavyko sukurti paraiškos, bandykite dar kartą");
    }

    redirect("/thanks.php");
} else {
    bad_request();
}