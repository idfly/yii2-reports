idfly/yii2-reports
Модуль для экспорта отчетов из Mysql в форматах csv/json/xml.
Примечание: модуль работает совместно с admin-панелью idfly.

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