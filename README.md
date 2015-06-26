Модуль yii2 от idfly для экспорта данных из Mysql
=====================
Модуль для экспорта данных из Mysql в форматах csv/json/xml.
Примечание: модуль работает совместно с admin-панелью idfly.

Описание
---------
Модуль иммет возможность выгружать данные в форматах: csv, json, xml.
Для создания отчета необходимо указать sql-запрос и формат, в котором 
необходимо выполнить экспорт данных в файл.

Особенностью модуля является возможность подставление в запрос 
$_GET-параметров, например:

Доступ к экпорту отчета доступен по подобной ссылке: 
```http://localhost/api/reports/$reportSecret/?args[:limit]=3```
где $reportSecret - секретный код отчета, а параметры для подстановки в 
sql-запрос, должны передаваться в $_GET['args']

```
SELECT * FROM `ware` LIMIT :limit
```

1) Экспорт в .csv:
 
 - есть возможность указать csv-разделитель (',', ';', '\t')
 - есть возможность указать csv-обертку для полей (", ', NULL)
 

Пример запроса: 
```
SELECT * FROM `ware`
```
Результат файл .csv:
```
id;category_id;name;description;type
4;2;'Песок карьерный';;Материал
5;2;'Песок речной';;Материал
6;2;'Песок сеяный';;Материал
7;6;'Аренда эксаватора-погрузчика (типа JCB)';;Услуга
```

2) Экспорт в .json:

Пример запроса: 
```
SELECT * FROM `ware`
```
Результат файл .json:
```
[
    {"id":"4","category_id":"2","name":"Песок карьерный","description":"","type":"Материал"},
    {"id":"5","category_id":"2","name":"Песок речной","description":"","type":"Материал"},
    {"id":"6","category_id":"2","name":"Песок сеяный","description":"","type":"Материал"}
]
```

3) Экспорт в .xml:

Пример запроса: 
```
SELECT * FROM `ware`
```
Результат файл .xml:
```
<?xml version="1.0" encoding="UTF-8"?>
<string>
	<id>4</id>
	<category_id>2</category_id>
	<name>Песок карьерный</name>
	<description></description>
	<type>Материал</type>
</string>
<string>
	<id>5</id>
	<category_id>2</category_id>
	<name>Песок речной</name>
	<description></description>
	<type>Материал</type>
</string>
<string>
	<id>6</id>
	<category_id>2</category_id>
	<name>Песок сеяный</name>
	<description></description>
	<type>Материал</type>
</string>
```

Миграция таблицы отчетов: 
```
CREATE TABLE `report` (
            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(128) NOT NULL COMMENT \'название\',
            `secret` VARCHAR(256) NOT NULL COMMENT \'секретный ключ\',
            `active` TINYINT(1) UNSIGNED NOT NULL COMMENT \'активность\',
            `sql` TEXT NOT NULL COMMENT \'sql - запрос\',
            `format` ENUM(\'csv\', \'json\', \'xml\') DEFAULT NULL
              COMMENT \'формат выгрузки отчета\',
            `csv_delimiter` ENUM(\',\', \';\', \'\t\') DEFAULT NULL
              COMMENT \'разделитель для csv формата\',
            `csv_enclosure` ENUM("\'", \'"\', \'NULL\') DEFAULT NULL
               COMMENT \'обёртка для полей csv\',
            PRIMARY KEY(`id`)
        ) COMMENT \'отчёты\'
```

Установка
---------
Предпочтительный способ установки через [composer](http://getcomposer.org/download/).

В файл проекта `composer.json`, необходимо добавить следующий код:

```
"repositories":[
        {
            "type": "git",
            "url": "git@bitbucket.org:idfly/yii2-reports.git"
        }
]
```

Затем запустить команду:

```
php composer.phar require --prefer-dist idfly/yii2-reports "dev-master"
```

или добавить в разделе `require`, в файле вашего проекта `composer.json`, следующий код:

```
"idfly/yii2-reports": "dev-master"
```

Настроить роутинг в файле web.php: 
```
        'api/reports/<secret:\w+>' => 'reports/reports/get-report',
        'admin/reports' => 'reports/reports',
        'admin/reports/<action>' => 'reports/reports/<action>',
```

Подключить модуль в файле common.php:
```
$config['modules']['reports'] = ['class' => 'idfly\reports\Module'];
```

Миграции выполняются с указанием директории модуля:
```
﻿./yii migrate --migrationPath=@vendor/idfly/yii2-reports/migrations
```