<?php

/**
 * Minimal PHPUnit bootstrap for wp-meta-fields.
 *
 * This package renders form fields into WordPress admin markup via plain
 * PHP templates in templates/. We do not attempt full WordPress
 * integration testing here -- instead we stub out only the handful of WP
 * functions actually called from src/ and templates/, as simple
 * passthroughs, so the rendering code can run in isolation.
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

if (!function_exists('__')) {
    function __($text, $domain = 'default')
    {
        return $text;
    }
}

if (!function_exists('esc_attr')) {
    function esc_attr($text)
    {
        return htmlspecialchars((string) $text, ENT_QUOTES);
    }
}

if (!function_exists('esc_html')) {
    function esc_html($text)
    {
        return htmlspecialchars((string) $text, ENT_QUOTES);
    }
}

if (!function_exists('locate_template')) {
    /**
     * Always report "no theme override found" so rendering falls back to
     * this package's own bundled templates.
     */
    function locate_template($templateNames, $load = false, $requireOnce = true)
    {
        return '';
    }
}

if (!function_exists('load_template')) {
    /**
     * Minimal stand-in for WP's load_template(): just requires the given
     * template file with $args in scope, since the bundled templates read
     * their input via `[$input] = $args;`.
     */
    function load_template($_template_file, $load_once = true, $args = [])
    {
        if (!is_array($args)) {
            $args = [];
        }
        require $_template_file;
    }
}

if (!function_exists('wp_register_script')) {
    function wp_register_script($handle, $src, $deps = [])
    {
        return true;
    }
}

if (!function_exists('wp_enqueue_script')) {
    function wp_enqueue_script($handle)
    {
    }
}

if (!function_exists('wp_add_inline_script')) {
    function wp_add_inline_script($handle, $data)
    {
        return true;
    }
}
