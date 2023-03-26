<?php

namespace Lite\Model;

use \Bitrix\Main\ORM\{
    Data\DataManager,
    Fields\IntegerField,
    Fields\Relations\Reference,
    Query\Join,
};

class ProductPropTable extends DataManager
{

    public static function getTableName(): string
    {
        return "l_product_prop_link";
    }


    public static function getMap(): array
    {
        return [
            (new IntegerField('PRODUCT_ID'))
                ->configurePrimary(true),

            (new Reference('PRODUCT', ProductTable::class,
                Join::on('this.PRODUCT_ID', 'ref.ID')))
                ->configureJoinType('inner'),

            (new IntegerField('PROPERTY_ID'))
                ->configurePrimary(true),

            (new Reference('PROPERTY', PropertyTable::class,
                Join::on('this.PROPERTY_ID', 'ref.ID')))
                ->configureJoinType('inner'),

        ];
    }
}