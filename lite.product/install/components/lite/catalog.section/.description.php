<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = [
    "NAME" => GetMessage("LITE_CATALOG_SECTION"),
    "DESCRIPTION" => GetMessage("LITE_CATALOG_SECTION"),
    "COMPLEX" => "Y",
    "CACHE_PATH" => "Y",
    "SORT" => 40,
    "PATH" => [
        "ID" => "lite_components",
        "CHILD" => array(
            "ID" => "catalog_section_list",
            "NAME" => GetMessage("LITE_CATALOG_SECTION"),
        )
    ],
];
