# Development

How to work on the theme: setting up a clone, the Composer scripts, and the checks a pull request runs. The issue-to-merge path (an issue, a branch linked to it, a pull request to `master` with a test plan) is in the [contributing guide](https://github.com/UAMS-Web/medicine-uams/blob/master/CONTRIBUTING.md).

Written against v1.0.2.

## Setting up

1. Clone the repository and install the development dependencies with `composer install`. Nothing in `require` is installed into the theme at run time: every package is a development dependency (Pest, Brain Monkey, PHPStan with the WordPress extension and stubs, Rector and Pint).
2. Run `composer test` to confirm the suite passes.

The suite needs no WordPress install and no database: WordPress functions are mocked with Brain Monkey.

## Composer scripts

| Script | What it runs |
| --- | --- |
| `composer test` | The Pest unit suite in `tests/Unit/` |
| `composer mutate` | Pest mutation testing over `functions.php` and `thinstrip.php`, naming the two test files |
| `composer stan` | PHPStan, configured in `phpstan.neon.dist` |
| `composer test:pint` | Pint in check mode; `composer pint` applies the formatting |
| `composer test:refactor` | Rector's gating profile as a dry run; `composer refactor` applies it |
| `composer test:refactor:sweep` | Rector's sweep profile as a dry run; `composer refactor:sweep` applies it, and its diff is reviewed by hand |

**Note:** `composer mutate` names the test files on purpose. The unit bootstrap loads Patchwork, and a mutation child that scans `tests/Unit` for tests dies and is scored as a kill.

## Tests

| Test file | What it pins |
| --- | --- |
| `tests/Unit/FunctionsTest.php` | The markup `my_acf_admin_head()` prints, and the filter and action `functions.php` registers |
| `tests/Unit/ThinstripTest.php` | The header markup `thinstrip.php` prints |

Before changing code that has no test, add one that captures what it does now; the contributing guide describes the order.

## Checks on a pull request

The `CI` workflow calls the shared job chain in [`UAMS-Web/uams-ci-workflows`](https://github.com/UAMS-Web/uams-ci-workflows) at a release tag. The chain runs Pest, mutation testing on the changed files, PHPStan, Pint, Rector, a PHP 8.2 parse of every shipped PHP file, the download-archive check and the checks on the synced agent files. Its last job, `CI`, passes only when every job in the chain succeeded, and it is the check `master` requires, together with `Attribution footer` and `Closing keywords` on the pull request body.

A full mutation run also runs weekly on a schedule.

## What ships

`.gitattributes` keeps the GitHub download to `style.css`, `functions.php`, `thinstrip.php` and `screenshot.png`. A new file the theme runs needs its own `-export-ignore` line in the same change, or it is missing from the download; the download-archive check reports any file that ships and should not.

## The wiki

These pages live in `docs/wiki/` and are published by the `Publish wiki` workflow on each published release, and by hand. Each publish replaces the whole wiki with the folder, so a page edited in the browser is lost at the next publish.
