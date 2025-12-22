<?php
// View Helper - Load views with data
function view($name, $data = []) {
    extract($data);
    $viewPath = ROOT_PATH . 'app/Views/' . str_replace('.', '/', $name) . '.php';
    
    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "View not found: " . $name;
    }
}

// Redirect Helper
function redirect($path) {
    header('Location: ' . BASE_URL . ltrim($path, '/'));
    exit;
}

// Asset URL Helper
function asset($path) {
    return BASE_URL . 'assets/' . ltrim($path, '/');
}

// URL Helper
function url($path = '') {
    return BASE_URL . ltrim($path, '/');
}

// Old Input Helper (for form refill)
function old($key, $default = '') {
    return $_POST[$key] ?? $_GET[$key] ?? $default;
}

// CSRF Token
function csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// CSRF Field
function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Get current user ID  
function userId() {
    return $_SESSION['user_id'] ?? null;
}

// Escape HTML
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
