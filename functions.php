<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e($value) {
    return htmlspecialchars($value ?? "", ENT_QUOTES, "UTF-8");
}

function setFlash($type, $message) {
    $_SESSION["flash"] = [
        "type" => $type,
        "message" => $message
    ];
}

function getFlash() {
    $flash = $_SESSION["flash"] ?? null;
    unset($_SESSION["flash"]);
    return $flash;
}

function validDate($date) {
    $d = DateTime::createFromFormat("Y-m-d", $date);
    return $d && $d->format("Y-m-d") === $date;
}

function getCategories() {
    return ["Assignment", "Exam", "Project", "Reading", "Other"];
}

function getPriorities() {
    return ["Low", "Medium", "High"];
}
?>
