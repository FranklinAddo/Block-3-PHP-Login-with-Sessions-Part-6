<?php
function escape($data) {
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}