<?php

function get_error() : ?string
{
    return $_SESSION["error"] ?? null;
}

function set_error(string $error) : void
{
    $_SESSION["error"] = $error;
}

function del_error() : void
{
    unset($_SESSION["error"]);
}

function get_success() : ?string
{
    return $_SESSION["success"] ?? null;
}

function set_success(string $success) : void
{
    $_SESSION["success"] = $success;
}

function del_success() : void
{
    unset($_SESSION["success"]);
}