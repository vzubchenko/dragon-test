Поднять проект:
1) composer install
2) php init
   0
3) Добавляем доступы к базе /common/config/main-local.php, миграция выполнена, база чистая.
 'db' => [
   'class' => \yii\db\Connection::class,
   'dsn' => 'mysql:host=kotspay.mysql.tools;dbname=kotspay_test',
   'username' => 'kotspay_test',
   'password' => '%njDgY9+54',
   'charset' => 'utf8',
   ],
4) docker-compose.yml services -> frontend -> ports:
- 23380:80
Если нужно - меняем.

5) chmod -R 777 frontend/web/uploads
6) https://phpmyadmin.adm.tools/index.php - бд
7) docker up/down command:
   docker-compose up -d
   docker-compose down
8) http://127.0.0.1:23380/ - если не меняли порт в пункте 4, доступен будет тут.