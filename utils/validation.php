<?php

function is_email(string $input) : bool
{
    return filter_var($input, FILTER_VALIDATE_EMAIL);
}

function is_alpha_num_with_underscores(string $input) : bool
{
    return preg_match("/^[a-zA-Z0-9_]+$/", $input);
}

function is_empty(?string $input) : bool
{
    return !isset($input) || empty($input);
}

function is_filled_in(array $input, array $values) : bool
{
    $is_filled = true;

    foreach ($values as $value) {
        if (is_empty($input[$value])) {
            $is_filled = false;
            break;
        }
    }

    return $is_filled;
}
