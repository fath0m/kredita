<?php
include_once("../bootstrap.php");

unset($_SESSION["user"]);
redirect("/", null, "Sėkmingai atsijungėte iš sistemos");