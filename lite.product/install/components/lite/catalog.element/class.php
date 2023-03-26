<?php

use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Loader;
use Lite\Model\ModelTable;
use Lite\Model\ProductTable;
use Lite\Model\BrandTable;
use Lite\Model\PropertyTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class CatalogSectionList extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams): array
    {
        return $arParams;
    }

    public function executeComponent()
    {
        $this->includeModules();
        $this->getProduct();
        $this->includeComponentTemplate();
    }

    private function includeModules()
    {
        Loader::includeModule('lite.product');
    }

    public function getProduct()
    {

        $product = ProductTable::getList([
            'filter' => [
                '=NAME' => $this->arParams["ELEMENT_ID"],
            ],
            "select" => [
                "*",
                "MODEL_PRODUCT_" => "MODEL",
                "BRAND_" => "BRAND",
                "PROPERTY_" => "PROPERTY",
            ],
            'runtime' => [
                new ReferenceField(
                    'MODEL',
                    ModelTable::class,
                    ['this.MODEL_ID' => 'ref.ID'],
                    ['join_type' => 'inner'],
                ),
                new ReferenceField(
                    'BRAND',
                    BrandTable::class,
                    ['this.MODEL_PRODUCT_BRAND_ID' => 'ref.ID'],
                    ['join_type' => 'inner'],
                ),
            ],
            'group' => 'NAME'
        ])->fetchAll();

        foreach ($product as &$val) {
            $properties[$val["PROPERTY_ID"]] = $val["PROPERTY_NAME"];
            unset($val["PROPERTY_ID"], $val["PROPERTY_NAME"]);
        }

        $product = $product[0];
        $product["PROPERTIES"] = $properties;
        $this->arResult = $product;
    }
}