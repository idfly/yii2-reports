idfly\yii2-porto
================
Тема для панели управления - Admin Porto Theme

Установка
---------

Предпочтительный способ установки через [composer](http://getcomposer.org/download/).

В файл проекта `composer.json`, необходимо добавить следующий код:

```
"repositories":[
    {
        "type": "git",
        "url": "git@bitbucket.org:idfly/yii2-porto.git"
    }
]
```

Затем запустить команду:

```
php composer.phar require --prefer-dist idfly/yii2-porto "dev-master"
```

или добавить в разделе `required`, в файле вашего проекта `composer.json`, следующий код:

```
"idfly/yii2-porto": "dev-master"
```

Подключение темы
----------------

Для использования этой темы достаточно подключить asset bundle в основном макете представления (`/layouts/main`):

```
<?php \idfly\porto\PortoAsset::register($this) ?>
```

Доступные компоненты
--------------------
 * ActionColumn
 * ActiveForm
 * Breadcrubms
 * GridView
 * NavButtons

ActionColumn
------------
Персонализированные иконки для колонки actions (view, udpate, delete) в списке GridView. Пример использования:

```
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'login',
        'name',
        'readonly',
        ['class' => \idfly\porto\ActionColumn::className()],
    ],
]) ?>
```

Пример использования с обёрткой и кастомным списком кнопок:

```
<section class="panel">
    <div class="panel-body">
        <?= idfly\porto\GridView::widget([
            'dataProvider' => $partners,
            'columns' => [
                'id',
                'name',
                'email',
                'codes',
                [
                    'class' => \idfly\porto\ActionColumn::className(),
                    'template' => '{update} {delete}'
                ],
            ],
        ]) ?>
    </div>
</section>
```

ActiveForm
----------
Пример использования:

```
<?php $form = ActiveForm::begin() ?>

<?= $form->field($model, 'login') ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'readonly')->checkbox() ?>

<?php ActiveForm::end() ?>
```

Breadcrubms
-----------
Пример использования:

Контроллер:

```
<?php

namespace app\admin\controllers;

class TestController extends \yii\web\Controller {

    private function _getCrumbs() {
        return [
            [
                'label' => 'Тестовый контроллер',
                'url' => ['test/index']
            ]
        ];
    }

    public function actionList() {
        return $this->render('index', [
            'crumbs' => array_merge($this->_getCrumbs(), [
                'Список'
            ]),
        ]);
    }
}
```

Компонент вызывается из вью:

```
<header class="page-header">
    <?= \idfly\porto\Breadcrumbs::widget(['links' => $crumbs]) ?>
</header>
```

GridView
--------
Пример использования:

```
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'login',
        'name',
        'readonly',
        ['class' => \idfly\porto\ActionColumn::className()],
    ],
]) ?>
```

NavButtons
----------
Компонент отображает заданный список кнопок в панеле навигации, например: "Добавить", "Поиск".  Пример использования:

Нужные кнопки задаются индивидуально для каждого представления:

```
<?php

namespace app\admin\controllers;

class NewsController extends \yii\web\Controller {

    public $layout = 'admin.php';

    private function _getButtons() {
        return [
            ['label' => 'Добавить', 'url' => ['create']],
            [
                'label' => 'Поиск',
                'url' => ['index'],
                'options' => [
                    'class' => 'action btn btn-primary',
                    'data-toggle' => 'collapse',
                    'data-target' => '#search-form',
                    'type' => 'a',
                ],
            ]
        ];
    }

    public function actionIndex() {
        return $this->render('index', [
            'buttons' => $this->_getButtons(),
        ]);
    }
}
```

Компонент вызывается из вью:

```
<?= \idfly\porto\NavButtons::widget(['buttons' => $buttons]) ?>
```

Header
------

Позволяет построить заголовок темы.

Вью:

```
<?= idfly\porto\Header::get($this) ?>

<!-- или -->

<?= idfly\porto\Header::get($this, [
    'headerView' => 'path/to/additional/view'
]) ?>
```

Контроллер:

```
<?php

namespace app\admin\controllers;

class PartnerController extends \yii\web\Controller {

    public $layout = 'admin.php';

    public $buttons = [
        ['label' => 'Добавить', 'url' => ['create']],
        [
            'label' => 'Поиск',
            'url' => ['index'],
            'options' => [
                'class' => 'action btn btn-primary',
                'data-toggle' => 'collapse',
                'data-target' => '#search-form',
                'type' => 'a',
            ],
        ]
    ];

    public $crumbs = [
        [
            'label' => 'Партнёры',
            'url' => ['/partner/partner/index']
        ]
    ];

    public function actionIndex() {
        $this->buttons[] = ['label' => 'Экспорт', 'url' => 'export'];
        $this->crumbs[] = 'Список';
        return $this->render('index');
    }
}
```