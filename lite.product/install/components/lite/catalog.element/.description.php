<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = [
    "NAME" => GetMessage("LITE_CATALOG_ELEMENT"),
    "DESCRIPTION" => GetMessage("LITE_CATALOG_ELEMENT"),
    "COMPLEX" => "Y",
    "CACHE_PATH" => "Y",
    "SORT" => 40,
    "PATH" => [
        "ID" => "lite_components",
        "CHILD" => array(
            "ID" => "catalog_element_detail",
            "NAME" => GetMessage("LITE_CATALOG_BRAND_LIST"),
        )
    ],
];
