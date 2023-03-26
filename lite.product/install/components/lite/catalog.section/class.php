<?php

use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Loader;
use Lite\Model\BrandTable;
use Lite\Model\ModelTable;
use Lite\Model\ProductTable;

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

        if ($this->arParams["TYPE"] === "PRODUCTS") {
            $this->getProducts();
        } else {
            $this->getModels();
        }

        $this->includeComponentTemplate();
    }

    private function includeModules()
    {
        Loader::includeModule('lite.product');
    }

    private function getIdByName($name, $type = '')
    {
        if ($type === "model") {
            $res = ModelTable::getList([
                'filter' => [
                    "NAME" => $name
                ],
                'limit' => 1,
                'select' => ["ID"]
            ]);
        } else {
            $res = BrandTable::getList([
                'filter' => [
                    "NAME" => $name
                ],
                'limit' => 1,
                'select' => ["ID"]
            ]);
        }


        if ($item = $res->fetch()) {
            return $item["ID"];
        }

        return null;
    }

    public function getModels()
    {
        $nameBrand = $this->arParams["VARIABLES"]["BRAND_ID"];
        $models = ModelTable::getList([
            'filter' => [
                "BRAND_ID" => $this->getIdByName($nameBrand)
            ],
            'runtime' => [
                new ReferenceField(
                    'BRAND',
                    BrandTable::class,
                    ['this.BRAND_ID' => 'ref.ID'],
                    ['join_type' => 'inner'],
                ),
            ],
            "select" => ["*"],
        ])->fetchCollection();


        $url = str_replace("#BRAND_ID#", $nameBrand, $this->arParams["SECTION_URL"]);

        foreach ($models as $model) {
            $this->arResult["ITEMS"][] = [
                "ID" => $model->getId(),
                "NAME" => $model->getName(),
                "DETAIL_PAGE_URL" => str_replace("#MODEL_ID#", $model->getName(), $url),
            ];
        }
    }

    public function getProducts()
    {

        $nav = new \Bitrix\Main\UI\PageNavigation("l_product");
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams["ELEMENTS_PER_PAGE"])
            ->initFromUri();

        $nameModel = $this->arParams["VARIABLES"]["MODEL_ID"];

        $products = ProductTable::getList([
            'order' => [$this->arParams["ELEMENT_SORT_FIELD"] => $this->arParams["ELEMENT_SORT_ORDER"]],
            'filter' => [
                "MODEL_ID" => $this->getIdByName($nameModel, 'model')
            ],
            'runtime' => [
                new ReferenceField(
                    'MODEL',
                    ModelTable::class,
                    ['this.ID' => 'ref.ID'],
                    ['join_type' => 'inner'],
                ),
            ],
            'limit' => $nav->getLimit(),
            'offset' => $nav->getOffset(),
            "select" => ["*"],
            "group" => "NAME",
            'count_total' => true,
        ]);

        $nav->setRecordCount($products->getCount());

        while ($product = $products->fetch()) {
            $this->arResult["ITEMS"][] = [
                "ID" =>   $product["ID"],
                "NAME" => $product["NAME"],
                "DETAIL_PAGE_URL" => $this->arParams["FOLDER"] . str_replace("#ELEMENT_ID#", $product["NAME"], $this->arParams["URL_TEMPLATES"]["detail"]),
            ];
        }

        $this->arResult["NAV"] = $nav;
    }
}