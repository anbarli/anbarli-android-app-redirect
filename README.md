# Anbarli Android App Redirect

A lightweight WordPress plugin that shows Android visitors an **Open in App** banner, opens your app with Android Intent URLs, and falls back to Google Play when the app is not installed.

[Download latest release](../../releases) · [Setup guide](https://anbarli.com.tr/blog/anbarli-android-app-redirect) · [Report an issue](../../issues)

## Why

WordPress sites with Android apps often need a simple way to move mobile visitors from a web page into the native app. This plugin adds that flow without editing theme files, adding a JavaScript framework, or building a custom banner from scratch.

## Features

- Shows an **Open in App** banner only to Android visitors.
- Opens the installed Android app with an Android Intent URL.
- Falls back to the configured Google Play URL when the app is not installed.
- Preserves the current page path and query string.
- Can be shown to all Android visitors or only logged-in users.
- Stays hidden when the website is running in PWA/standalone mode.
- Lets admins configure the title, message, button text, and dismiss period.
- Works independently of the active WordPress theme.

## Quick Start

1. Download the latest ZIP from the [Releases](../../releases) page.
2. In WordPress, open **Plugins > Add New Plugin > Upload Plugin**.
3. Upload the ZIP, install it, and activate it.
4. Open **Settings > Android App Redirect**.
5. Enter your Android package name and Google Play URL.
6. Save the settings and test from an Android browser.

## Configuration Example

```text
Android package name:
com.example.app

Google Play URL:
https://play.google.com/store/apps/details?id=com.example.app
```

When an Android visitor taps the banner, the plugin builds an Intent URL for the current WordPress page:

```text
intent://example.com/current-page#Intent;scheme=https;package=com.example.app;S.browser_fallback_url=https%3A%2F%2Fplay.google.com%2Fstore%2Fapps%2Fdetails%3Fid%3Dcom.example.app;end
```

## Android App Links Requirement

Your Android app must be configured to handle your website's HTTPS URLs. For verified Android App Links, publish a valid `assetlinks.json` file at:

```text
https://example.com/.well-known/assetlinks.json
```

The app should also include the matching intent filters in `AndroidManifest.xml`.

## Troubleshooting

**The banner does not appear**

- Test on a real Android browser. Desktop browsers and most emulators may not match the Android user agent.
- Check that the plugin is enabled in **Settings > Android App Redirect**.
- Confirm that both the package name and Google Play URL are saved.
- If "logged-in users only" is enabled, test while signed in.
- If the site is installed as a PWA, the banner is intentionally hidden in standalone mode.

**The app does not open**

- Confirm that the Android package name is correct.
- Confirm that the app supports the website URL through Android App Links or compatible deep link intent filters.
- Test in Chrome for Android first because Intent URL fallback behavior varies by browser.

**Google Play does not open**

- Confirm that the Google Play URL is a full `https://play.google.com/store/apps/details?id=...` URL.
- Make sure the browser supports Android Intent URLs.

## FAQ

### Does this share WordPress login sessions with the Android app?

No. WordPress authentication and Android app authentication must be integrated separately.

### Does this work on iOS?

No. This plugin is intentionally Android-focused. iOS requires a separate Universal Links and App Store banner strategy.

### Does this replace Android App Links?

No. The plugin renders the WordPress banner and builds the Intent URL. Your Android app and website still need the correct App Links configuration for the best user experience.

## Roadmap

- Add screenshots for the admin settings page and mobile banner.
- Add WordPress coding standards checks.
- Add translation files.
- Add filters for custom banner visibility rules.
- Add an optional shortcode or block for manual app-open buttons.

## Development

Issues and pull requests are welcome.

Useful local checks:

```bash
php -l anbarli-android-app-redirect.php
php -l uninstall.php
```

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for local setup, issue reporting, and pull request guidelines.

If this plugin saves you a custom theme edit, consider starring the repository so other WordPress developers can find it.

## License

Licensed under the GNU General Public License v2.0 or later. See [LICENSE](LICENSE).

## Turkce

Anbarli Android App Redirect, Android ziyaretcilere **Uygulamada Ac** bildirimi gosteren hafif bir WordPress eklentisidir. Uygulama yuklu degilse ziyaretciyi ayarlanan Google Play sayfasina yonlendirir.

Kurulum: ZIP dosyasini yukleyin, eklentiyi etkinlestirin, **Ayarlar > Android App Redirect** sayfasinda Android paket adini ve Google Play URL'sini girin.
