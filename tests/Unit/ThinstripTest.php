<?php

/**
 * thinstrip.php, the College of Medicine thin strip header partial.
 *
 * The partial is markup plus one call to the parent theme's uams_site_title(),
 * mocked here, so the test needs neither WordPress nor the parent theme.
 *
 * @see thinstrip.php
 */

declare(strict_types=1);

use Brain\Monkey\Functions;

function render_thinstrip(): string
{
    ob_start();
    require dirname(__DIR__, 2).'/thinstrip.php';

    return (string) ob_get_clean();
}

it('prints the site title from the parent theme once, after the college name', function (): void {
    Functions\expect('uams_site_title')
        ->once()
        ->withNoArgs()
        ->andReturnUsing(static function (): void {
            echo '<span class="site-title">Test Site</span>';
        });

    expect(render_thinstrip())
        ->toContain('<span class="com-site-title">College of Medicine<br/></span><span class="site-title">Test Site</span></h1>');
});

it('prints the quick links toggle button', function (): void {
    Functions\when('uams_site_title')->justReturn(null);

    expect(render_thinstrip())
        ->toContain("<button class='uams-quicklinks' aria-haspopup='true' aria-expanded=\"false\" aria-label=\"Open quick links\">Quick Links");
});

it('prints exactly the markup it printed when it was pinned', function (): void {
    Functions\when('uams_site_title')->alias(static function (): void {
        echo 'Test Site';
    });

    expect(render_thinstrip())->toMatchSnapshot();
});

// cspell:ignore quicklinks
