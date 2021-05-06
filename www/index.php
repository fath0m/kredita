<?php
include_once "../bootstrap.php";
include_once get_incl("middleware/auth");

middleware_logged_in();
render("index");
