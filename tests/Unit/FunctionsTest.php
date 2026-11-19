<?php

/**
 * my_acf_admin_head(), the ACF admin head callback in functions.php.
 *
 * Pins the markup it prints today, the action functions.php registers at file
 * scope, and the absence of the ACF show_admin filter it used to register.
 *
 * The file is loaded by the first test that needs it, inside that test's Brain
 * Monkey session, so its file-scope lines run under a test and mutation
 * testing can reach them. It declares a function, so it can load only once per
 * process; what that load registered is kept and read by the registration
 * test, which is first in the file so that it is the test that loads it.
 *
 * @see functions.php
 */

declare(strict_types=1);

/**
 * Load functions.php once, and return what its file scope registered.
 *
 * @return array{action: int|false, show_admin: bool}
 */
function load_functions_file(): array
{
    /** @var array{action: int|false, show_admin: bool}|null $registered */
    static $registered = null;

    if ($registered === null) {
        require_once dirname(__DIR__, 2).'/functions.php';

        $registered = [
            'action' => has_action('acf/input/admin_head', 'my_acf_admin_head'),
            'show_admin' => has_filter('_includes/acf-pro/settings/show_admin')
                || has_filter('acf/settings/show_admin'),
        ];
    }

    return $registered;
}

it('registers the admin head action at the default priority and no show_admin filter', function (): void {
    expect(load_functions_file())->toBe(['action' => 10, 'show_admin' => false]);
});

it('prints the script that moves the post editor into the ACF field', function (): void {
    load_functions_file();

    ob_start();
    my_acf_admin_head();
    $output = (string) ob_get_clean();

    expect($output)
        ->toContain('<script type="text/javascript">')
        ->toContain("$('.acf-field-573f70ac9357c .acf-input').append( $('#postdivrich') );")
        ->toContain('})(jQuery);');
});

it('prints the style that clears the editor toolbar background', function (): void {
    load_functions_file();

    ob_start();
    my_acf_admin_head();
    $output = (string) ob_get_clean();

    expect($output)
        ->toContain('<style type="text/css">')
        ->toContain('.acf-field #wp-content-editor-tools {')
        ->toContain('background: transparent;')
        ->toContain('padding-top: 0;');
});

it('prints exactly the markup it printed when it was pinned', function (): void {
    load_functions_file();

    ob_start();
    my_acf_admin_head();

    expect((string) ob_get_clean())->toMatchSnapshot();
});

// cspell:ignore postdivrich
