# Anbarlı Android App Redirect

A lightweight WordPress plugin that displays an **Open in App** banner to Android visitors. If the Android app is not installed, the visitor is redirected to the configured Google Play page.

Android ziyaretçilere **Uygulamada Aç** bildirimi gösteren hafif bir WordPress eklentisidir. Uygulama yüklü değilse ziyaretçi, ayarlanan Google Play sayfasına yönlendirilir.

## English

### Features

- Works only on Android devices.
- Can be displayed to all Android visitors or only logged-in users.
- Opens the installed Android app using an Android Intent URL.
- Falls back to the configured Google Play URL when the app is not installed.
- Preserves the current page path, query string, and URL fragment.
- Does not display while the website is running in PWA/standalone mode.
- Configurable title, message, button text, and dismissal period.
- Theme-independent; no theme file changes are required.

### Installation

1. Download the latest ZIP from the repository's Releases page.
2. In WordPress, go to **Plugins > Add New Plugin > Upload Plugin**.
3. Upload the ZIP, install it, and activate it.
4. Go to **Settings > Android App Redirect**.
5. Enter the Android package name and the full Google Play URL.
6. Configure visibility and banner content, then save.

### Android requirement

The Android application must be configured to handle the website's HTTPS URLs. For verified Android App Links, publish a valid `assetlinks.json` file at:

```text
https://example.com/.well-known/assetlinks.json
```

### Notes

- The banner is triggered by a user click because mobile browsers can block automatic app launches.
- This plugin does not share WordPress login sessions with the Android app.
- Google Play fallback behavior is intended for Android browsers that support Intent URLs, including Chrome.

## Türkçe

### Özellikler

- Yalnızca Android cihazlarda çalışır.
- Tüm Android ziyaretçilere veya yalnızca giriş yapmış kullanıcılara gösterilebilir.
- Android Intent bağlantısıyla yüklü uygulamayı açar.
- Uygulama yüklü değilse ayarlanan Google Play adresine yönlendirir.
- Bulunulan sayfanın yolunu, sorgu parametrelerini ve URL bölümünü korur.
- Site PWA/standalone modunda çalışırken görünmez.
- Başlık, açıklama, buton metni ve kapatıldıktan sonra bekleme süresi ayarlanabilir.
- Temadan bağımsızdır; tema dosyalarında değişiklik gerektirmez.

### Kurulum

1. Deponun Releases bölümünden güncel ZIP dosyasını indirin.
2. WordPress panelinde **Eklentiler > Yeni Eklenti Ekle > Eklenti Yükle** bölümüne gidin.
3. ZIP dosyasını yükleyin, kurun ve etkinleştirin.
4. **Ayarlar > Android App Redirect** sayfasını açın.
5. Android paket adını ve tam Google Play adresini girin.
6. Görünürlük ve bildirim metinlerini ayarlayıp kaydedin.

### Android gereksinimi

Android uygulamasının sitenizin HTTPS bağlantılarını açacak şekilde yapılandırılmış olması gerekir. Doğrulanmış Android App Links için aşağıdaki konumda geçerli bir `assetlinks.json` dosyası yayınlayın:

```text
https://ornek.com/.well-known/assetlinks.json
```

### Notlar

- Mobil tarayıcılar otomatik uygulama açmayı engelleyebildiği için işlem kullanıcı tıklamasıyla başlatılır.
- Bu eklenti WordPress oturumunu Android uygulamasıyla paylaşmaz.
- Google Play geri dönüşü, Chrome dahil Intent URL destekleyen Android tarayıcıları içindir.

## Development / Geliştirme

Issues and pull requests are welcome. / Hata bildirimleri ve katkı talepleri kabul edilir.

- Repository / Depo: https://github.com/anbarli/anbarli-android-app-redirect
- Author / Geliştirici: https://github.com/anbarli

## License / Lisans

Licensed under the GNU General Public License v2.0 or later. See [LICENSE](LICENSE).

GNU Genel Kamu Lisansı v2.0 veya üzeriyle lisanslanmıştır. Ayrıntılar için [LICENSE](LICENSE) dosyasına bakın.

