# What the theme changes

Everything the child theme does, file by file. Anything not listed here comes from the parent theme, `uams-2016`, unchanged.

Written against v1.0.2, without the `functions.php` that v1.0.2 still ships and `master` removes for the next release. Its one function, `my_acf_admin_head()`, printed a script and a style for an ACF field that the one site running the theme does not have, so it moved nothing.

| File | What it does | How WordPress loads it |
| --- | --- | --- |
| `style.css` | The theme header, and the style overrides for the site title | Enqueued by the parent as `uams-style`, after the parent's own stylesheet |
| `thinstrip.php` | The header strip at the top of every page | Replaces the parent's `thinstrip.php`, which the parent's `header.php` loads with `get_template_part( 'thinstrip' )` |
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
