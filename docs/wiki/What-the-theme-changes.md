# What the theme changes

Everything the child theme does, file by file. Anything not listed here comes from the parent theme, `uams-2016`, unchanged.

Written against v1.0.2.

| File | What it does | How WordPress loads it |
| --- | --- | --- |
| `style.css` | The theme header, and the style overrides for the site title | Enqueued by the parent as `uams-style`, after the parent's own stylesheet |
| `thinstrip.php` | The header strip at the top of every page | Replaces the parent's `thinstrip.php`, which the parent's `header.php` loads with `get_template_part( 'thinstrip' )` |
| `functions.php` | One ACF editor-screen change, and one filter that has no effect | Loaded by WordPress before the parent's `functions.php` |
| `screenshot.png` | The image shown on *Appearance*, *Themes* | Read by WordPress |

## The header strip (`thinstrip.php`)

The child's copy matches the parent's except in three places:

- **The site title has a line above it:** a `<span class="com-site-title">` holding *College of Medicine* and a line break, before the title the parent's `uams_site_title()` prints.
- **The audience links carry `role="navigation"` and the label `audience based`**, where the parent's say `UAMS Landing Pages`.
- **The search and quick links navigation carries `role="navigation"`**; its label is the same as the parent's.

The links themselves (UAMSHealth, Jobs, Giving), the search button and the quick links button are the parent's.

## The style overrides (`style.css`)

The theme header names the parent (`Template: uams-2016`), the minimum WordPress and PHP versions, and the display name **Snoqualmie Falls**. The rules below it size the site title so the extra *College of Medicine* line fits.

| Selector | Wide screens | 769 to 991 pixels | 768 pixels and narrower |
| --- | --- | --- | --- |
| `#site-title` | `max-width: 50%` | `max-width: 55%` | `max-width: 90%` |
| `#site-title h1` | `font-size: 28px` | (wide value) | `font-size: 20px` |
| `#site-title h1 a.long-title` | `font-size: 24px` | (wide value) | `font-size: 24px` |
| `.com-site-title` | `font-size: 20px`, `line-height: 0`, `color: #404040` | (wide value) | `font-size: 18px` |
| `#ham:before` | (parent's) | (parent's) | `font-size: 25px`, `margin: -7px 0` |

## The ACF editor change (`functions.php`)

`my_acf_admin_head()` runs on ACF's `acf/input/admin_head` action, which ACF fires wherever it prints its input scripts. Neither this theme nor the parent calls `acf_form()` on the front end, so in practice that is the admin screens where ACF draws fields. It prints:

- **a script** that moves the post editor (`#postdivrich`) into the input area of the field matched by the selector `.acf-field-573f70ac9357c .acf-input`, so the editor would appear inside that field rather than above the field groups;
- **a style** that removes the editor toolbar's background and top padding inside a field.

**Note:** the ACF the parent bundles (5.9.9) writes a field wrapper's class as `acf-field-` followed by the full field key, and field keys normally begin with `field_`, so the field's wrapper would carry `acf-field-field_573f70ac9357c`. The selector then matches only if the stored key has no `field_` prefix. Where nothing matches, the script finds nothing to move and does nothing. This has not been checked on a running site.

## The filter that has no effect

`functions.php` also registers `__return_true` on a filter named `_includes/acf-pro/settings/show_admin`. The ACF copy the parent bundles applies its settings filters as `acf/settings/<name>`, so nothing applies a filter of that name, and the line changes nothing. ACF's own `show_admin` setting defaults to `true`, so ACF's admin menu shows either way. The tests in `tests/Unit/FunctionsTest.php` pin the registration as it is.
