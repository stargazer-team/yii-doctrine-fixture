<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii3 Doctrine Fixture Extension</h1>
    <br>
</p>

[![Latest Stable Version](https://poser.pugx.org/stargazer-team/yii-doctrine-fixture/v/stable.png)](https://packagist.org/packages/stargazer-team/yii-doctrine-fixture)
[![Total Downloads](https://poser.pugx.org/stargazer-team/yii-doctrine-fixture/downloads.png)](https://packagist.org/packages/stargazer-team/yii-doctrine-fixture)
[![Build status](https://github.com/stargazer-team/yii-doctrine-fixture/workflows/build/badge.svg)](https://github.com/stargazer-team/yii-doctrine-fixture/actions)
[![Code Coverage](https://scrutinizer-ci.com/g/stargazer-team/yii-doctrine-fixture/badges/coverage.png)](https://scrutinizer-ci.com/g/stargazer-team/yii-doctrine-fixture/)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/stargazer-team/yii-doctrine-fixture/badges/quality-score.png)](https://scrutinizer-ci.com/g/stargazer-team/yii-doctrine/)
[![static analysis](https://github.com/stargazer-team/yii-doctrine-fixture/workflows/static%20analysis/badge.svg)](https://github.com/stargazer-team/yii-doctrine-fixture/actions?query=workflow%3A%22static+analysis%22)
[![type-coverage](https://shepherd.dev/github/stargazer-team/yii-doctrine-fixture/coverage.svg)](https://shepherd.dev/github/stargazer-team/yii-doctrine-fixture)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/):

```bash
composer require stargazer-team/yii-doctrine-fixture --dev
```

Config
```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\DoctrineFixture\Enum\ConfigOptions;

'yiisoft/yii-doctrine-fixture' => [
        ConfigOptions::ENTITY_MANAGERS => [
            'default' => [
                ConfigOptions::DIRS => [
                    '@src/Fixture',
                ],
                ConfigOptions::FILES => [
                    '@src/Fixture/UserFixture.php',
                ],
                ConfigOptions::CLASSES => [
                    UserFixture::class,
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
