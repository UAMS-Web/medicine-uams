# Troubleshooting

One heading per symptom, as it shows on the site or in the admin.

- [The theme is listed under Broken Themes: "The parent theme is missing"](#the-theme-is-listed-under-broken-themes-the-parent-theme-is-missing)
- [The header has no College of Medicine line](#the-header-has-no-college-of-medicine-line)

Written against v1.0.2, without the ACF editor entry that v1.0.2 still describes and `master` removes for the next release, along with the script behind it.

## The theme is listed under Broken Themes: "The parent theme is missing"

**Cause:** WordPress looks for the parent in the folder the `Template` header names, `uams-2016`, and did not find a theme there.

**Fix:** install the `uams-2016` theme in `wp-content/themes/uams-2016/`, with that folder name exactly; see [Installation](Installation.md#requirements).

## The header has no College of Medicine line

**Cause:** the site is running the parent theme's header. Either the active theme is `uams-2016` itself rather than **Snoqualmie Falls**, or the child theme's folder is missing `thinstrip.php`.

**Fix:** activate **Snoqualmie Falls** under *Appearance*, *Themes*, and confirm `thinstrip.php` is in the theme's folder. [What the theme changes](What-the-theme-changes.md#the-header-strip-thinstripphp) shows what the header should contain.
