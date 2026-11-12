<?php

/**
 * Pest configuration, for the Unit suite.
 */

declare(strict_types=1);

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

use function Brain\Monkey\setUp;
use function Brain\Monkey\tearDown;

/*
 * Brain Monkey around every test, on a base test case rather than `uses()`
 * closures: PHPStan cannot type `$this` inside a bound closure.
 *
 * setUp() defines WordPress' hook functions and arms Patchwork; tearDown()
 * verifies every expectation the test set (a `->once()` that never happened
 * fails here) and removes every mock, so nothing leaks into the next test.
 *
 * The assertion count: Brain Monkey's expectations are Mockery expectations,
 * which PHPUnit does not count. MockeryPHPUnitIntegration adds them, so a test
 * whose only check is `Functions\expect(...)->once()` is not reported as risky
 * (failOnRisky would fail it).
 */
abstract class UnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void
    {
        parent::setUp();

        setUp();
    }

    protected function tearDown(): void
    {
        tearDown();

        parent::tearDown();
    }
}

uses(UnitTestCase::class)->in('Unit');
