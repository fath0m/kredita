<?php

$templates = new League\Plates\Engine(__DIR__ . "/../templates");

function render(string $template, array $data = []) : void
{
    global $templates;
    echo $templates->render($template, $data);
}
