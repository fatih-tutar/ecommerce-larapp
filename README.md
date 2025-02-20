# Laravel RESTful API - Sipariş Yönetimi
Bu proje, Laravel ile geliştirilmiş bir RESTful API uygulamasıdır. Sipariş listeleme, ekleme, silme ve siparişlere uygulanan indirimleri görüntüleme işlevlerine sahiptir.

Uygulama Docker ile konteynerleştirilmiş olup PHP, Nginx, MySQL ve phpMyAdmin bileşenlerini içermektedir.
## :rocket: Kurulum ve Başlatma
### 1. Reponun Kopyalanması
Projeyi yerel bilgisayarınıza indirip proje klasörüne girmek için aşağıdaki iki komutu çalıştırın:
``` 
git clone https://github.com/fatih-tutar/ecommerce-larapp.git
cd ecommerce-larapp
```
### 2. Docker Konteynerlerini Başlatma
Tüm servisleri Docker ile ayağa kaldırmak için:
```
docker-compose up --build -d
```
Bu komut, Laravel, MySQL ve phpMyAdmin servislerini oluşturur ve arka planda çalıştırır.
### 3. Container'a Bağlanma
Laravel ile ilgili işlemleri yapmak için PHP container'ina girmeniz gerekmektedir:
```
docker-compose exec php bash
```
### 4. Bağımlılıkların Yüklenmesi
Projenin çalışması için laravel klasörüne girmek ve gerekli PHP bağımlılıklarını yüklemek amacıyla aşağıdaki komutu çalıştırın.
```
cd laravel
composer install
```
### 5. Ortam Değişkenlerini Ayarlama
Aşağıdaki kodu çalıştırarak .env.example dosyası üzerinden .env dosyasının oluşmasını sağlayın:
```
cp .env.example .env
```
Daha sonra şu komut ile Laravel APP_KEY oluşturun:
```
php artisan key:generate
```
Artık şu adresi [http://localhost:8000/](http://localhost:8000/) kullanarak Laravel projenizi görüntüleyebilirsiniz.
### 6. Veritabanı Kurulumu
Laravel ile MySQL arasındaki bağlantının sorunsuz olması için .env dosyanızın ilgili kısmı aşağıdaki gibi olmalıdır:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```
Daha sonra, veritabanını oluşturup tabloları ve seed verilerini eklemek için şu komutu kullanın:
```
php artisan migrate --seed
```
Bütün tablolar oluşacak ve test verileri yüklenecektir. 

### ***Kurulum Aşaması Sonu :*** Projemiz ayağa kalktı ve test verileriyle beraber veritabanımız da oluştu. Şimdi sıra işlevleri test etmeye geldi.
---
---
## :bar_chart: PhpMyAdmin Kullanımı
Projede phpMyAdmin entegrasyonu bulunmaktadır. Tarayıcıda aşağıdaki URL'yi açarak veritabanını görüntüleyebilirsiniz:
```
http://localhost:8080
```
Giriş bilgileri:
- Sunucu: db
- Kullanıcı Adı: laravel
- Şifre: secret
---
---
## :link:  API Kullanımı
API'yi test etmek için Postman veya benzeri bir API istemcisi kullanabilirsiniz.
### 1. Siparişleri Listeleme
GET isteği ile tüm siparişleri listeleyebilirsiniz:
```
GET http://localhost:8000/api/orders
```
### 2. Yeni Sipariş Ekleme
POST isteği ile yeni sipariş ekleyebilirsiniz. 
```
POST http://localhost:8000/api/orders
```
İstenen request formatı aşağıda verilmiştir.
```
{
  "customer_id": 1,
  "items": [
    {
      "product_id": 100,
      "quantity": 2
    },
    {
      "product_id": 101,
      "quantity": 3
    }
  ]
}
```
### 3. Sipariş Silme
Bir siparişi silmek için ilgili order_id ile bir DELETE isteği gönderin:
```
DELETE http://localhost:8000/api/orders/{order_id}
```
### 4. Siparişe Uygulanan İndirimleri Listeleme
Bir siparişte uygulanan indirimleri görmek için GET isteği gönderin:
```
GET http://localhost:8000/api/discounts/{order_id}
```
