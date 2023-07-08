<?php
    $uri = $_SERVER["REQUEST_URI"];
    $uri_parts = explode("/", $uri);
    $owner = $uri_parts[2];
    $id = str_replace("_fassetdot_", ".", $uri_parts[3]);
    $extension = strtolower(pathinfo($id, PATHINFO_EXTENSION));
    header("Content-Type: image/$extension");
    echo file_get_contents("../../storage/$id");