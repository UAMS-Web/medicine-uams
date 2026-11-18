# Troubleshooting

One heading per symptom, as it shows on the site or in the admin.

- [The theme is listed under Broken Themes: "The parent theme is missing"](#the-theme-is-listed-under-broken-themes-the-parent-theme-is-missing)
- [The header has no College of Medicine line](#the-header-has-no-college-of-medicine-line)
- [The post editor sits above the ACF fields instead of inside one](#the-post-editor-sits-above-the-acf-fields-instead-of-inside-one)

Written against v1.0.2.

## The theme is listed under Broken Themes: "The parent theme is missing"

**Cause:** WordPress looks for the parent in the folder the `Template` header names, `uams-2016`, and did not find a theme there.

**Fix:** install the `uams-2016` theme in `wp-content/themes/uams-2016/`, with that folder name exactly; see [Installation](Installation.md#requirements).

## The header has no College of Medicine line

**Cause:** the site is running the parent theme's header. Either the active theme is `uams-2016` itself rather than **Snoqualmie Falls**, or the child theme's folder is missing `thinstrip.php`.

**Fix:** activate **Snoqualmie Falls** under *Appearance*, *Themes*, and confirm `thinstrip.php` is in the theme's folder. [What the theme changes](What-the-theme-changes.md#the-header-strip-thinstripphp) shows what the header should contain.

## The post editor sits above the ACF fields instead of inside one

**Cause:** the script `my_acf_admin_head()` prints moves the editor only into a field matched by `.acf-field-573f70ac9357c .acf-input`. The likely cause is that the selector does not match: the bundled ACF 5.9.9 writes the wrapper class with the full field key, normally `acf-field-field_573f70ac9357c`. On a screen without that field, it moves nothing either.

**Fix:** with the field on the screen, compare the class on the field's wrapper in the browser's inspector with the selector, and [open an issue](https://github.com/UAMS-Web/medicine-uams/issues) with what it shows. See [What the theme changes](What-the-theme-changes.md#the-acf-editor-change-functionsphp).
