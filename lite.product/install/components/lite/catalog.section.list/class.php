<?php

use Lite\Model\BrandTable;
use Bitrix\Main\Loader;

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
        $this->getBrands();
        $this->includeComponentTemplate();
    }

    private function includeModules()
    {
        Loader::includeModule('lite.product');
    }

    public function getBrands()
    {
        $brands = BrandTable::getList([
            "select" => ["*"],
        ])->fetchCollection();

        foreach ($brands as $brand) {
            $this->arResult["ITEMS"][] = [
                "ID" => $brand->getId(),
                "NAME" => $brand->getName(),
                "DETAIL_PAGE_URL" => str_replace("#BRAND_ID#", $brand->getName(), $this->arParams["SECTION_URL"]),
            ];
        }
    }
}