<?php
include_once("../bootstrap.php");

if (req_method() === "GET") {
    render("login");
} else if (req_method() === "POST") {
    if (!is_filled_in($_POST, ["username", "password"])) {
        redirect("back", "Užpildykite formą");
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = :username";
    $user = exec_query($query, [
        "username" => $username
    ])->fetch();

    if (!$user || !password_verify($password, $user["password"])) {
        redirect("back", "Neteisingi prisijungimo duomenys");
    }

    $_SESSION["user"] = $user;
    redirect("/", null, "Sėkmingai prisijungta prie sistemos");
} else {
    bad_request();
}
