# What the theme changes

Everything the child theme does, file by file. Anything not listed here comes from the parent theme, `uams-2016`, unchanged.

Written against v1.0.2, without the `show_admin` filter that v1.0.2 still registers and `master` removes for the next release. That filter had no effect: nothing applies a filter of its name.

| File | What it does | How WordPress loads it |
| --- | --- | --- |
| `style.css` | The theme header, and the style overrides for the site title | Enqueued by the parent as `uams-style`, after the parent's own stylesheet |
| `thinstrip.php` | The header strip at the top of every page | Replaces the parent's `thinstrip.php`, which the parent's `header.php` loads with `get_template_part( 'thinstrip' )` |
| `functions.php` | One ACF editor-screen change | Loaded by WordPress before the parent's `functions.php` |
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

**Note:** the ACF the parent bundles (5.9.9) builds a field wrapper's class from the field key, then replaces each `_` with `-` and `field-field-` with `field-`. A field whose key is `field_573f70ac9357c` therefore carries the class `acf-field-573f70ac9357c`, which the selector matches. On a screen without that field, or if the field was deleted or recreated under a new key, the script finds nothing to move and does nothing. Whether the field exists on a site has not been checked.
