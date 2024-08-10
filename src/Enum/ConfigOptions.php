<?php

declare(strict_types=1);

namespace Yiisoft\Yii\DoctrineFixture\Enum;

final class ConfigOptions
{
    public const CLASSES = 'classes';

    public const DIRS = 'dirs';

    public const ENTITY_MANAGERS = 'entity_managers';

    public const FILES = 'files';

    private function __construct()
    {
    }
}
