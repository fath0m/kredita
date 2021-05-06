<?php

function middleware_logged_in() : void
{
    if (!user()) {
        redirect("/login.php");
    }
}

function middleware_logged_out() : void
{
    if (user()) {
        redirect("/");
    }
}