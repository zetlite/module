<?php

namespace Lite\Model;

use \Bitrix\Main\ORM\{
    Data\DataManager,
    Fields\IntegerField,
    Fields\StringField,
    Fields\FloatField,
    Fields\Relations\ManyToMany,
    Fields\Relations\Reference,
    Query\Join,
};

class ProductTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'l_product';
    }

    public static function getMap(): array
    {
        return [
            (new IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),

            (new StringField('NAME')),
            (new StringField('YEAR')),
            (new FloatField('PRICE')),
            (new IntegerField('MODEL_ID')),

             (new Reference(
                 'MODEL',
                 BrandTable::class,
                 Join::on('this.MODEL_ID', 'ref.ID')
             )),

            (new ManyToMany('PROPERTY', PropertyTable::class))
                ->configureTableName('l_product_prop_link')
        ];
    }
}