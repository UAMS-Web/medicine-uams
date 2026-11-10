<?php

/**
 * my_acf_admin_head(), the ACF admin head callback in functions.php.
 *
 * Pins the markup it prints today. The filter and action functions.php
 * registers at file scope are not asserted here: the bootstrap loads the file
 * once and discards its registrations, so registration needs a test that boots
 * WordPress.
 *
 * @see functions.php
 */

declare(strict_types=1);

it('prints the script that moves the post editor into the ACF field', function (): void {
    ob_start();
    my_acf_admin_head();
    $output = (string) ob_get_clean();

    expect($output)
        ->toContain('<script type="text/javascript">')
        ->toContain("$('.acf-field-573f70ac9357c .acf-input').append( $('#postdivrich') );")
        ->toContain('})(jQuery);');
});

it('prints the style that clears the editor toolbar background', function (): void {
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
    ob_start();
    my_acf_admin_head();

    expect((string) ob_get_clean())->toMatchSnapshot();
});

// cspell:ignore postdivrich
