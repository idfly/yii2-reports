yii2-reports
=====================

Модуль для экспорта данных из Mysql в форматах csv/json/xml.
Примечание: модуль работает совместно с admin-панелью idfly.

## Установка

1. В проектный `composer.json` добавить в секцию `require`:

        "idfly/yii2-reports": "dev-master",

2. В секцию `repositories`:

        {
            "type": "git",
            "url": "git@bitbucket.org:idfly/yii2-reports.git"
        }

3. Выполнить `composer update`

4. Настроить роутинг в проектном конфиге:

```
'api/reports/<secret:\w+>' => 'reports/export',
'admin/reports' => 'reports/reports',
'admin/reports/<action>' => 'reports/reports/<action>',
```

5. Подключить модуль в проектном конфиге:

```
$config['modules']['reports'] = ['class' => 'idfly\reports\Module'];
```

6. Миграции выполняются с указанием директории модуля:

```
﻿./yii migrate --migrationPath=@vendor/idfly/yii2-reports/migrations
```


Описание
---------

Модуль имеет возможность выгружать данные в форматах: csv, json, xml.
Для создания отчета необходимо указать sql-запрос и формат, в котором
необходимо выполнить экспорт данных в файл.

Особенностью модуля является возможность подставления в sql-запрос
$_GET-параметров.

Например, для того, чтобы подставить параметры в запрос:

```
SELECT * FROM `ware` LIMIT :limit WHERE `category_id` = :category_id
```

Необходимо передать в `$_GET['args']` параметры `:limit` и `:category_id`
следующим способом:

```
http://localhost/api/reports/$reportSecret/?args[:limit]=100&args[:category_id]=5
```

где `$reportSecret` - секретный код отчета, указанный в БД.


### Экспорт в .csv:

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


### Экспорт в .json:

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

### Экспорт в .xml:

Пример запроса:

```
SELECT * FROM `ware`
```

Результат файл .xml:

```
<?xml version="1.0" encoding="UTF-8"?>
<elements>
    <element>
    	<id>4</id>
    	<category_id>2</category_id>
    	<name>Песок карьерный</name>
    	<description></description>
    	<type>Материал</type>
    </element>
    <element>
    	<id>5</id>
    	<category_id>2</category_id>
    	<name>Песок речной</name>
    	<description></description>
    	<type>Материал</type>
    </element>
    <element>
    	<id>6</id>
    	<category_id>2</category_id>
    	<name>Песок сеяный</name>
    	<description></description>
    	<type>Материал</type>
    </element>
</elements>
```