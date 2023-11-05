<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii3 Doctrine Fixture Extension</h1>
    <br>
</p>


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/):

```bash
composer require stargazer-team/yii-doctrine-fixture --dev
```

Config
```php
'yiisoft/yii-doctrine-fixture' => [
        'entity_managers' => [
            'default' => [
                'dirs' => [
                    '@src/Fixture'
                ],
                'files' => [
                    '@src/Fixture/UserFixture.php'
                ],
                'classes' => [
                    UserFixture::class
                ],
            ],
        ],
    ]
```

Command:
 - doctrine:fixture:load

Load fixture:

```bash
php yii doctrine:fixture:load --em=default
```
