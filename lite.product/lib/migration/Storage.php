<?php

namespace Lite\Migration;

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;

class Storage
{
    private static function getTables(): array
    {
        return [
            "\Lite\Model\BrandTable",
            "\Lite\Model\ModelTable",
            "\Lite\Model\ProductTable",
            "\Lite\Model\PropertyTable",
            "\Lite\Model\ProductPropTable",
        ];
    }

    public static function createTables(): void
    {
        $tables = self::getTables();

        foreach ($tables as $table) {
            if (!Application::getConnection($table::getConnectionName())->isTableExists(
                Base::getInstance($table)->getDBTableName()
            )
            ) {
                Base::getInstance($table)->createDbTable();
            }
        }
    }

    public static function dropTables(): void
    {
        $tables = self::getTables();

        foreach ($tables as $table) {
            Application::getConnection($table::getConnectionName())
                ->queryExecute('drop table if exists ' . Base::getInstance($table)->getDBTableName());
        }
    }
}