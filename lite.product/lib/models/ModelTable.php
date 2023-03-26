<?php

namespace Lite\Model;

use \Bitrix\Main\ORM\{
    Data\DataManager,
    Fields\IntegerField,
    Fields\StringField,
    Fields\Relations\Reference,
    Query\Join,
};

class ModelTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'l_model';
    }

    public static function getMap(): array
    {
        return [
            (new IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),

            (new StringField('NAME')),

            (new IntegerField('BRAND_ID')),

            (new Reference(
                'BRAND',
                BrandTable::class,
                Join::on('this.BRAND_ID', 'ref.ID')
            ))
        ];
    }
}