<?php
include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (is_empty($_GET["status"])) {
    bad_request();
}

$query = "";

switch ($_GET["status"]) {
    case "new":
        $query = "SELECT *, (SELECT name FROM credit_types WHERE credit_types.id = credit_requests.credit_type) AS
            credit_type FROM credit_requests WHERE is_active = 1 AND offer IS NULL";
        break;

    case "with_offers":
        $query = "SELECT *, (SELECT name FROM credit_types WHERE credit_types.id = credit_requests.credit_type) AS
            credit_type FROM credit_requests WHERE is_active = 1 AND offer IS NOT NULL AND signature IS NULL";
        break;

    case "signed":
        $query = "SELECT *, (SELECT name FROM credit_types WHERE credit_types.id = credit_requests.credit_type) AS
            credit_type FROM credit_requests WHERE is_active = 1 AND offer IS NOT NULL AND signature IS NOT NULL";
        break;

    case "archived":
        $query = "SELECT *, (SELECT name FROM credit_types WHERE credit_types.id = credit_requests.credit_type) AS
            credit_type FROM credit_requests WHERE is_active = 0";
        break;

    default:
        not_found();
}

$requests = exec_query($query)->fetchAll();
$titles = [
    "new" => "Naujos paraiškos",
    "with_offers" => "Pateikti pasiūlymai",
    "signed" => "Pasirašytos paraiškos",
    "archived" => "Archyvas",
];

render("requests/index", [
    "requests" => $requests,
    "status" => $_GET["status"],
    "title" => $titles[$_GET["status"]],
]);