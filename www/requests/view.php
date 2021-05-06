<?php
include_once "../../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();

if (is_empty($_GET["id"])) {
    bad_request();
}

$query = "
SELECT r.*,
    (SELECT ct.name FROM credit_types ct WHERE r.credit_type = ct.id) AS 'credit_type',
	
	o.id AS 'offer.id',
	o.credit_amount_from AS 'offer.credit_amount_from',
	o.credit_amount_to AS 'offer.credit_amount_to',
	o.credit_length_from AS 'offer.credit_length_from',
	o.credit_length_to AS 'offer.credit_length_to',
	(SELECT ct.name FROM credit_types ct WHERE o.credit_type = ct.id) AS 'offer.credit_type',
	o.interest_rate AS 'offer.interest_rate',
	o.bvkkmn AS 'offer.bvkkmn',
	o.payment AS 'offer.payment',
	o.comment AS 'offer.comment',
	o.created_at AS 'offer.created_at',
	(SELECT u.first_name || ' ' || u.last_name FROM users u WHERE u.id = o.manager) AS 'offer.manager',
	
	s.id AS 'signature.id',
	s.credit_amount AS 'signature.credit_amount',
	s.credit_length AS 'signature.credit_length',
	(SELECT ct.name FROM credit_types ct WHERE s.credit_type = ct.id) AS 'signature.credit_type',
	s.interest_rate AS 'signature.interest_rate',
	s.bvkkmn AS 'signature.bvkkmn',
	s.payment AS 'signature.payment',
	(SELECT u.first_name || ' ' || u.last_name FROM users u WHERE u.id = s.manager) AS 'signature.manager'
FROM credit_requests r LEFT JOIN offers o ON r.offer = o.id LEFT JOIN signatures s ON r.signature = s.id WHERE r.id = :id
";

$request = exec_query($query, [
    "id" => $_GET["id"],
])->fetch();

if (!$request) {
    not_found();
}

$query = "SELECT * FROM documents d WHERE d.credit_request = :credit_request";
$documents = exec_query($query, [
    "credit_request" => $request["id"],
])->fetchAll();
if (!$documents) $documents = [];

$status = "waiting_offer";

if ($request["offer"]) {
    $status = "waiting_sign";
}

if ($request["signature"]) {
    $status = "signed";
}

if ($request["is_active"] == 0) {
    $status = "archived";
}

render("requests/view", [
    "request" => $request,
    "status" => $status,
    "documents" => $documents,
]);