### Для запуска сего творения требуется

- php v8.0.25
- npm 10.1.0
- composer 2.2.5

## Шаги для установки:
1. Переименовать .env.example в .env
2. Записать свою бд в поля DB 
   ### !!! ВНИМАНИЕ !!! СОЗДАВАТЬ В БАЗЕ ДАННЫХ НИЧЕГО НЕ НУЖНО. ДЛЯ РАБОТЫ НУЖНА ПУСТАЯ БАЗА ДАННЫХ  
   <img src="https://github.com/Wombat2077/superfuelsite/assets/78274743/1f4bddf8-f17e-4813-8909-f87ddedb74aa"/>
        
   где:
   - DB_CONNECTION - тип используемой бд
   - DB_HOST - адрес хоста бд
   - DB_PORT - порт подключения к бд
   - DB_DATABASE - имя бд
   - DB_USERNAME - имя пользователя бд
   - DB_PASSWORD - пароль пользователя бд
    
    
3. Запустить миграцию  
   `php artisan migrate`
4. сгенерировать ключ приложения  
   `php artisan key:generate`
5. Установить Node.js пакеты
   `npm install`
## Запуск
запуск производятся двумя командами:  
`npm run dev`  
`php artisan serve --port=5000`  
после этого сайт станет доступен по адресу [http://127.0.0.1:5000/](http://127.0.0.1:5000/)
##### внимание! данных в бд пока нет
это значит пока нет товаров, пользователей, комментариев и заказов.    
_сейчас 4.26 и я дико хочу спать, поэтому либо я завтра найду как все заэкспортить, либо:_
- зарегистрируетесь дважды
- в любом редакторе бд выставьте is_admin=1 любому пользователю
- для добавления товаров авторизируйтесь этим пользователем
- для добавления заказов авторизируйтесь вторым пользователем и закажите что-либо во вкладке каталог
- для добавления комментариев авторизируйтесь вторым пользователем (третьим, четвертым - не важно, главное чтобы is_admin стоял 0 p.s хотя если переходить с помощью адресной строки - поебать)
- готово, здесь рассказано как заполнить все 4 вида сущностей
- вы великолепны
