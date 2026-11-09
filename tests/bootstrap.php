<?php

/**
 * Unit bootstrap for the theme.
 *
 * Loads Composer's autoloader and Patchwork, then functions.php inside one
 * Brain Monkey session. No WordPress is loaded.
 */

declare(strict_types=1);

use function Brain\Monkey\setUp;
use function Brain\Monkey\tearDown;

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../vendor/antecedent/patchwork/Patchwork.php';

if (! defined('ABSPATH')) {
    define('ABSPATH', sys_get_temp_dir().'/medicine-uams-tests-no-wordpress/');
}

/*
 * functions.php registers a filter and an action at file scope, so it is
 * loaded inside one Brain Monkey session, which defines add_filter() and
 * add_action(). The function it defines outlives the session; the hooks it
 * registered are discarded by tearDown(), so every test starts clean.
 *
 * Add a stub here for any WordPress function functions.php comes to call at
 * file scope.
 */
setUp();

require_once __DIR__.'/../functions.php';

tearDown();

// cspell:ignore ABSPATH
