# Installation

At the end of this page the College of Medicine theme is the active theme on a WordPress site, running on top of its parent.

## Requirements

| Requirement | Value | Where it is declared |
| --- | --- | --- |
| WordPress | 6.8 or later (since the release after v1.0.2) | `Requires at least` in `style.css` |
| PHP | 8.2 or later | `Requires PHP` in `style.css`, `require.php` in `composer.json` |
| Parent theme | `uams-2016`, installed in a folder of that name | `Template` in `style.css` |

**Note:** the parent theme's folder must be named `uams-2016` exactly. WordPress finds a child theme's parent by the folder name in the `Template` header, not by the parent's display name.

## Steps

1. **Install the parent theme.** Put the [`uams-2016`](https://github.com/UAMS-Web/uams-2016) theme in `wp-content/themes/uams-2016/`.
2. **Get this theme.** Either download the source archive of a [release](https://github.com/UAMS-Web/medicine-uams/releases) and unpack it, or clone the repository. The release download holds only what the theme runs (`style.css`, `thinstrip.php` and `screenshot.png`; v1.0.2 also holds `functions.php`); a clone also carries the tests, tooling and agent files.
3. **Put it in the themes folder**, for example `wp-content/themes/medicine-uams/`.
4. **Activate it.** In the WordPress admin, open *Appearance*, *Themes*. The theme is listed as **Snoqualmie Falls**; choose *Activate*.
5. **Check the header.** Load any page: the header reads *College of Medicine* above the site title, with the UAMSHealth, Jobs and Giving links on the right. [What the theme changes](What-the-theme-changes.md) describes the header in full.

**Warning:** where the web server serves files from the themes folder, a clone used as the live theme folder makes its tests, tooling and agent files readable from the web. Prefer the release download on a public site.

## Next

- [What the theme changes](What-the-theme-changes.md) for what each file does.
- [Troubleshooting](Troubleshooting.md) if the theme does not appear or the header looks like the parent's.
