<?php

namespace Lite\Model;

use \Bitrix\Main\ORM\{
    Data\DataManager,
    Fields\IntegerField,
    Fields\StringField,
    Fields\Relations\OneToMany,
};


class BrandTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'l_brand';
    }

    public static function getMap(): array
    {
        return [
            (new IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),

            (new StringField('NAME')),

            (new OneToMany('MODEL', ModelTable::class, 'BRAND'))
                ->configureJoinType('inner')
        ];
    }
}