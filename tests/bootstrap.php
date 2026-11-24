<?php

/**
 * Unit bootstrap for the theme.
 *
 * Loads Composer's autoloader and Patchwork. No WordPress is loaded.
 */

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../vendor/antecedent/patchwork/Patchwork.php';

if (! defined('ABSPATH')) {
    define('ABSPATH', sys_get_temp_dir().'/medicine-uams-tests-no-wordpress/');
}

// cspell:ignore ABSPATH
