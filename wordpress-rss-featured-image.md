---
title: WordPress RSS Beslemelerine Öne Çıkarılan Görsel Ekleme (Anbarlı RSS Featured Image)
date: 2025-08-20
category: WordPress
description: Varsayılan olarak WordPress, RSS beslemelerinde öne çıkarılan görselleri &amp;lt;item&amp;gt; içerisine eklemez. Bu durum, RSS okuyucularında yazıların görselle desteklenmeden listelenmesine neden olabilir.
tags: [WordPress, RSS, Plugin, Featured Image, Media RSS]
author: Admin
---

# WordPress RSS Beslemelerine Öne Çıkarılan Görsel Ekleme (Anbarlı RSS Featured Image)

Varsayılan olarak WordPress, RSS beslemelerinde öne çıkarılan görselleri `<item>` içerisine eklemez. Bu durum, RSS okuyucularında yazıların görselle desteklenmeden listelenmesine neden olabilir.  
Bunu çözmek için geliştirdiğimiz **Anbarlı RSS Featured Image** eklentisi, her yazının öne çıkarılan görselini **Media RSS (MRSS)** biçiminde `<media:content>` etiketi olarak RSS beslemesine ekler.

## Özellikler

- Her RSS öğesine (`<item>`) öne çıkarılan görseli ekler.  
- Görsel boyutunu filtreyle değiştirebilirsiniz (`thumbnail`, `medium`, `large`, `full`).  
- İsteğe bağlı olarak eski RSS okuyucuları için `<enclosure>` etiketi de eklenebilir.  
- PHP 7.4+ ve WordPress 5.0+ ile uyumlu.

## Kurulum

1. GitHub deposunu indirin veya ZIP olarak kaydedin:  
   [GitHub → anbarli-rss-featured-image](https://github.com/anbarli/anbarli-rss-featured-image)
2. Klasörü `wp-content/plugins/` içine kopyalayın.  
3. WordPress yönetim panelinde **Eklentiler** → *Anbarlı RSS Featured Image* eklentisini etkinleştirin.  

## Kullanım

Etkinleştirdikten sonra sitenizin RSS beslemesine gidin (ör. `https://alanadiniz.com/feed/`).  
Her yazının `<item>` kısmında şu şekilde bir çıktı görmelisiniz:

```xml
<media:content url="https://alanadiniz.com/uploads/2025/08/featured.jpg" medium="image" type="image/jpeg" width="1200" height="630" />
```

## Geliştirici Kancaları (Filters)

- Görsel boyutunu değiştirmek için:  

```php
add_filter('anbarli_rss_image_size', function ($size) {
    return 'full'; // veya 'medium', 'large'
});
```

- `enclosure` eklemek için:  

```php
add_filter('anbarli_rss_add_enclosure', '__return_true');
```

## Test

1. Feed URL’nizi açın: `https://siteadresiniz.com/feed/`  
2. Kaynak görünümünde `<media:content>` etiketini kontrol edin.  
3. Görsel görünmüyorsa yazının öne çıkan görseli olduğundan emin olun.  

## Sonuç

Bu küçük ama faydalı eklenti sayesinde WordPress sitenizin RSS beslemeleri artık görsellerle birlikte zenginleşecek. RSS okuyucularında içerikler daha dikkat çekici ve görsel destekli olarak listelenecek. Zapier vb. servisler ile RSS beslemeleri ile gelen içerik ve görsel sosyal medya platformlarına otomatik olarak paylaşılabilir hale gelecek.

---

> ⚠️ Not: Kod parçalarını uygulamadan önce sitenizin yedeğini almanız önerilir. Eklenti veya functions.php değişiklikleri sitenizin çalışmasını geçici olarak etkileyebilir.

> 💡 Feragatname: Bu yazı yalnızca bilgilendirme ve eğitim amaçlıdır. Buradaki komutların veya kod örneklerinin uygulanması sonucu oluşabilecek veri kaybı, sistem hatası veya güvenlik ihlallerinden yazar sorumlu değildir. Değişiklik yapmadan önce mutlaka yedek alın ve test ortamında doğrulama yapın.

> 📜 Tüm içerikler bilgilendirme amaçlıdır; uygulama sorumluluğu kullanıcıya aittir.
