<?php

function user() : ?array
{
    return $_SESSION["user"] ?? null;
}