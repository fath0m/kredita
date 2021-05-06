<?php

/*
 * Main bootstrap file which **MUST** be included on every
 * single request to spin up the application.
 */

include __DIR__ . "/vendor/autoload.php";
session_start();

ini_set('file_uploads', "On");

/*
 * Define InternalException, which will be used throughout
 * the application to differentiate between known and
 * unknown exceptions, to avoid accidentally throwing
 * out some garbage stack trace to the user, don't
 * know where to put it, so it will be kept here
 */
class InternalException extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

/*
 * Generic include function, to make it a little bit nicer to
 * include various files, as it will always use directory
 * based on bootstrap.php file.
 */
function get_incl(string $file) : string
{
    return __DIR__ . "/" . $file . ".php";
}

/*
 * Load utils dependencies, which can be used throughout the application.
 * Utils functions are included as is, no need to include them again
 * in other files / templates.
 */
include_once get_incl("utils/database");
include_once get_incl("utils/http");
include_once get_incl("utils/server");
include_once get_incl("utils/template");
include_once get_incl("utils/validation");
include_once get_incl("utils/session");
include_once get_incl("utils/html");

