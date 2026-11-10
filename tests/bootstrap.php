<?php

/**
 * Unit bootstrap for the theme.
 *
 * Loads Composer's autoloader and Patchwork. No WordPress is loaded, and
 * functions.php is not loaded here: it registers a filter and an action at file
 * scope, and a file loaded before the first test is outside every test's
 * coverage, so mutation testing could not reach those two calls. The tests load
 * it (see tests/Unit/FunctionsTest.php).
 */

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../vendor/antecedent/patchwork/Patchwork.php';

if (! defined('ABSPATH')) {
    define('ABSPATH', sys_get_temp_dir().'/medicine-uams-tests-no-wordpress/');
}

// cspell:ignore ABSPATH
