<?php

namespace Lite\Model;


use \Bitrix\Main\ORM\{
    Data\DataManager,
    Fields\IntegerField,
    Fields\StringField,
    Fields\Relations\ManyToMany,
};

class PropertyTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'l_product_prop';
    }

    public static function getMap(): array
    {
        return [
            (new IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),

            (new StringField('NAME')),

            (new ManyToMany('PRODUCTS', ProductTable::class))
                ->configureTableName('l_product_prop_link')
        ];
    }
}