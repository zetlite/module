<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = [
    "NAME" => GetMessage("LITE_CATALOG"),
    "DESCRIPTION" => GetMessage("LITE_CATALOG"),
    "COMPLEX" => "Y",
    "CACHE_PATH" => "Y",
    "SORT" => 40,
    "PATH" => [
        "ID" => "lite_components",
        "CHILD" => array(
            "ID" => "catalog",
            "NAME" => GetMessage("LITE_CATALOG"),
        )
    ],
];
