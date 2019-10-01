## Laravel+Vue+Docker
- **Easy run with Docker**
- **Laravel API**
- **Vue JS**
- **Specific validation rules**
- **Minimized & versioned CSS/JS**
- **IDE Helpers & DB Seeders**

All you need for run this project at you machine is linux with installed git, docker & docker-compose

Clone repository, navigate to root project directory and just run:
```
make build composer-install config-default key migrate-fresh seed yarn-install yarn-dev perm
```

Now application should be accessible at http://localhost:8080. 
Enjoy testing =)

Also see: [Run on clean ubuntu machine step-by-step](https://github.com/maks-sl/laravel-order/blob/master/install-ubuntu-clean.txt)

## Задача

Нужно сделать форму оформления заказа для сайта.

Для оформления заказа клиент должен: 
указать телефон и имя
выбрать тариф
выбрать первый день доставки и адрес (из возможных для данного тарифа)

После оформления заказа в БД должна появиться запись о заказе и клиенте (если такого клиента не было до этого) .

Все указанные клиентом данные должны быть сохранены.

Все заказы с одним номером телефона должны привязаться к одному клиенту в БД. Клиентов с одинаковым номером телефона не должно быть в БД.

Тарифы предварительно занесены в БД, у каждого тарифа есть название, цена, и дни по которым он может доставляться.

- **Требования**

- *Бэк: PHP, возможно использование любого фреймворка, предпочтительно laravel*
- *БД: mysql, postgresql*
- *Фронт: верстка bootstrap, все данные через ajax, оформление заказа без перезагрузки страницы. В идеале Vue.js но не принципиально.*

