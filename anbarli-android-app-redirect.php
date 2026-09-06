<?php
/**
 * Plugin Name: Anbarlı Android App Redirect
 * Plugin URI: https://github.com/anbarli/anbarli-android-app-redirect
 * Description: Shows Android visitors an "Open in App" banner and sends them to Google Play when the app is not installed.
 * Version: 1.0.0
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Author: Anbarlı
 * Author URI: https://github.com/anbarli
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: anbarli-android-app-redirect
 * Update URI: https://github.com/anbarli/anbarli-android-app-redirect
 */

if (!defined('ABSPATH')) {
    exit;
}

final class Anbarli_Android_App_Redirect {
    private const OPTION_NAME = 'anbarli_android_app_redirect_options';
    private const SETTINGS_GROUP = 'anbarli_android_app_redirect_group';

    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('wp_footer', [$this, 'render_banner']);
    }

    public function add_settings_page(): void {
        add_options_page(
            'Anbarlı Android App Redirect',
            'Android App Redirect',
            'manage_options',
            'anbarli-android-app-redirect',
            [$this, 'render_settings_page']
        );
    }

    public function register_settings(): void {
        register_setting(self::SETTINGS_GROUP, self::OPTION_NAME, [
            'type' => 'array',
            'sanitize_callback' => [$this, 'sanitize_options'],
            'default' => $this->defaults(),
        ]);
    }

    private function defaults(): array {
        return [
            'enabled' => 1,
            'logged_in_only' => 1,
            'package_name' => '',
            'play_url' => '',
            'title' => 'Android uygulamamız hazır',
            'message' => 'Daha hızlı ve kolay kullanım için uygulamada devam edin.',
            'button_text' => 'Uygulamada Aç',
            'dismiss_days' => 7,
        ];
    }

    private function get_options(): array {
        return wp_parse_args((array) get_option(self::OPTION_NAME, []), $this->defaults());
    }

    public function sanitize_options($input): array {
        $input = is_array($input) ? $input : [];
        $package_name = isset($input['package_name']) ? trim((string) $input['package_name']) : '';
        $package_name = preg_replace('/[^A-Za-z0-9._]/', '', $package_name);

        return [
            'enabled' => empty($input['enabled']) ? 0 : 1,
            'logged_in_only' => empty($input['logged_in_only']) ? 0 : 1,
            'package_name' => $package_name,
            'play_url' => isset($input['play_url']) ? esc_url_raw($input['play_url']) : '',
            'title' => isset($input['title']) ? sanitize_text_field($input['title']) : '',
            'message' => isset($input['message']) ? sanitize_text_field($input['message']) : '',
            'button_text' => isset($input['button_text']) ? sanitize_text_field($input['button_text']) : '',
            'dismiss_days' => isset($input['dismiss_days']) ? max(0, min(365, absint($input['dismiss_days']))) : 7,
        ];
    }

    public function render_settings_page(): void {
        if (!current_user_can('manage_options')) {
            return;
        }

        $options = $this->get_options();
        ?>
        <div class="wrap">
            <h1>Anbarlı Android App Redirect</h1>
            <p>Android ziyaretçilere uygulama bildirimi gösterir. / Displays an app banner to Android visitors.</p>
            <form method="post" action="options.php">
                <?php settings_fields(self::SETTINGS_GROUP); ?>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">Durum / Status</th>
                        <td><label><input type="checkbox" name="<?php echo esc_attr(self::OPTION_NAME); ?>[enabled]" value="1" <?php checked($options['enabled'], 1); ?>> Etkinleştir / Enable</label></td>
                    </tr>
                    <tr>
                        <th scope="row">Görünürlük / Visibility</th>
                        <td><label><input type="checkbox" name="<?php echo esc_attr(self::OPTION_NAME); ?>[logged_in_only]" value="1" <?php checked($options['logged_in_only'], 1); ?>> Yalnızca giriş yapmış kullanıcılara göster / Show only to logged-in users</label></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="anbarli-package">Android paket adı / Package name</label></th>
                        <td><input id="anbarli-package" class="regular-text" name="<?php echo esc_attr(self::OPTION_NAME); ?>[package_name]" value="<?php echo esc_attr($options['package_name']); ?>" placeholder="com.example.app" required></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="anbarli-play-url">Google Play adresi / URL</label></th>
                        <td><input type="url" id="anbarli-play-url" class="regular-text" name="<?php echo esc_attr(self::OPTION_NAME); ?>[play_url]" value="<?php echo esc_attr($options['play_url']); ?>" placeholder="https://play.google.com/store/apps/details?id=..." required></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="anbarli-title">Başlık / Title</label></th>
                        <td><input id="anbarli-title" class="regular-text" name="<?php echo esc_attr(self::OPTION_NAME); ?>[title]" value="<?php echo esc_attr($options['title']); ?>"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="anbarli-message">Açıklama / Message</label></th>
                        <td><input id="anbarli-message" class="large-text" name="<?php echo esc_attr(self::OPTION_NAME); ?>[message]" value="<?php echo esc_attr($options['message']); ?>"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="anbarli-button">Buton metni / Button text</label></th>
                        <td><input id="anbarli-button" class="regular-text" name="<?php echo esc_attr(self::OPTION_NAME); ?>[button_text]" value="<?php echo esc_attr($options['button_text']); ?>"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="anbarli-dismiss-days">Tekrar gösterme / Show again</label></th>
                        <td><input type="number" min="0" max="365" id="anbarli-dismiss-days" name="<?php echo esc_attr(self::OPTION_NAME); ?>[dismiss_days]" value="<?php echo esc_attr($options['dismiss_days']); ?>"> gün / days<p class="description">0: Bir sonraki sayfada tekrar göster. / Show again on the next page.</p></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function render_banner(): void {
        $options = $this->get_options();

        if (!$options['enabled'] || empty($options['package_name']) || empty($options['play_url'])) {
            return;
        }

        if ($options['logged_in_only'] && !is_user_logged_in()) {
            return;
        }

        $host = wp_parse_url(home_url('/'), PHP_URL_HOST);
        if (!$host) {
            return;
        }

        $config = [
            'packageName' => $options['package_name'],
            'playUrl' => $options['play_url'],
            'host' => $host,
            'dismissDays' => (int) $options['dismiss_days'],
        ];
        ?>
        <div id="anbarli-android-app-banner" class="anbarli-aabr" hidden role="region" aria-label="Android application">
            <div class="anbarli-aabr__content">
                <strong><?php echo esc_html($options['title']); ?></strong>
                <span><?php echo esc_html($options['message']); ?></span>
            </div>
            <button type="button" class="anbarli-aabr__open"><?php echo esc_html($options['button_text']); ?></button>
            <button type="button" class="anbarli-aabr__close" aria-label="Close">&times;</button>
        </div>
        <style>
            .anbarli-aabr{position:fixed;z-index:999999;left:12px;right:12px;bottom:calc(12px + env(safe-area-inset-bottom));display:flex;align-items:center;gap:12px;padding:13px 14px;background:#20252b;color:#fff;border-radius:12px;box-shadow:0 5px 24px rgba(0,0,0,.3);font-family:inherit}
            .anbarli-aabr[hidden]{display:none!important}.anbarli-aabr__content{min-width:0;flex:1;display:flex;flex-direction:column;gap:2px}.anbarli-aabr__content strong{font-size:15px;line-height:1.3}.anbarli-aabr__content span{font-size:13px;line-height:1.35;opacity:.86}.anbarli-aabr__open{border:0;border-radius:7px;padding:10px 13px;background:#168c72;color:#fff;font:600 13px/1 inherit;white-space:nowrap;cursor:pointer}.anbarli-aabr__close{border:0;padding:2px 3px;background:transparent;color:#fff;font:24px/1 Arial,sans-serif;cursor:pointer;opacity:.8}
            @media(max-width:480px){.anbarli-aabr{align-items:flex-start;flex-wrap:wrap}.anbarli-aabr__content{flex-basis:calc(100% - 30px)}.anbarli-aabr__open{width:100%;order:3}.anbarli-aabr__close{position:absolute;right:10px;top:8px}}
        </style>
        <script>
        (() => {
            const config = <?php echo wp_json_encode($config, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
            const banner = document.getElementById('anbarli-android-app-banner');
            if (!banner || !/Android/i.test(navigator.userAgent)) return;
            if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) return;

            const storageKey = 'anbarliAndroidAppBannerDismissedAt';
            try {
                const dismissedAt = Number(localStorage.getItem(storageKey) || 0);
                const waitMs = config.dismissDays * 86400000;
                if (waitMs && dismissedAt && Date.now() - dismissedAt < waitMs) return;
            } catch (error) {}

            banner.hidden = false;
            banner.querySelector('.anbarli-aabr__close').addEventListener('click', () => {
                banner.hidden = true;
                try { localStorage.setItem(storageKey, String(Date.now())); } catch (error) {}
            });

            banner.querySelector('.anbarli-aabr__open').addEventListener('click', () => {
                const path = location.pathname + location.search + location.hash;
                const intentUrl = 'intent://' + config.host + path + '#Intent;scheme=https;package=' +
                    encodeURIComponent(config.packageName) + ';S.browser_fallback_url=' +
                    encodeURIComponent(config.playUrl) + ';end';
                location.href = intentUrl;
            });
        })();
        </script>
        <?php
    }
}

new Anbarli_Android_App_Redirect();

