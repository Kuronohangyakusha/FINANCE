<?php
/**
 * Fonctions utilitaires globales
 */

function redirect($url) {
    header("Location: $url");
    exit();
}

function old($key, $default = '') {
    return $_SESSION['old'][$key] ?? $default;
}

function errors($key = null) {
    if ($key) {
        return $_SESSION['errors'][$key] ?? null;
    }
    return $_SESSION['errors'] ?? [];
}

function clearOldInputs() {
    unset($_SESSION['old']);
    unset($_SESSION['errors']);
}

function setFlashMessage($type, $message) {
    $_SESSION['flash'][$type] = $message;
}

function getFlashMessage($type) {
    $message = $_SESSION['flash'][$type] ?? null;
    unset($_SESSION['flash'][$type]);
    return $message;
}

function isAuthenticated() {
    return isset($_SESSION['user']);
}

function getCurrentUser() {
    return $_SESSION['user'] ?? null;
}