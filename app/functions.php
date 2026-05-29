<?php
// Escape output before displaying it in HTML
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// Check whether the current request is a POST request
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

// Redirect to another page and stop script execution
function redirect_to($path)
{
    header('Location: ' . $path);
    exit;
}

// Return the active class for navigation links
function active_nav($currentPage, $pageName)
{
    return $currentPage === $pageName ? 'active' : '';
}
