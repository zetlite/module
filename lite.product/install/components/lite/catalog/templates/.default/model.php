<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @global \CMain $APPLICATION */
/** @var array $arParams */
/** @var array $arResult */
/** @var \CBitrixComponent $component */

$APPLICATION->IncludeComponent(
    "lite:catalog.section",
    ".default",
    [
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "FILTER_NAME" => "",
        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
        "ELEMENTS_PER_PAGE" => $arParams["ELEMENTS_PER_PAGE"],
        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
        "SEF_MODE" => $arParams["SEF_MODE"],
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "SHOW_404" => $arParams["SHOW_404"],
        "MESSAGE_404" => $arParams["MESSAGE_404"],
        "TYPE" => "PRODUCTS",
        "VARIABLES" => $arResult["VARIABLES"],
        "URL_TEMPLATES" => $arResult["URL_TEMPLATES"],
        "FOLDER" => $arResult["FOLDER"],
        "USE_SORT" => "Y",
    ],
    $component
);
