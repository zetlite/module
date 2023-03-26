<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$APPLICATION->IncludeComponent(
    "lite:catalog.section.list",
    ".default",
    [
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
        "SECTION_SORT_FIELD" => $arParams["SECTION_SORT_FIELD"],
        "SECTION_SORT_ORDER" => $arParams["SECTION_SORT_ORDER"],
    ],
    $component
);?>