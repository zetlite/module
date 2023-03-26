<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arAscDesc = [
    "asc" => GetMessage("IBLOCK_SORT_ASC"),
    "desc" => GetMessage("IBLOCK_SORT_DESC"),
];

$arComponentParameters = [
    "GROUPS" => [
        "SECTION_LIST_SETTINGS" => [
            "NAME" => GetMessage("T_IBLOCK_DESC_SECTION_LIST_SETTINGS"),
        ],
        "LIST_SETTINGS" => [
            "NAME" => GetMessage("T_IBLOCK_DESC_LIST_SETTINGS"),
        ],
        "DETAIL_SETTINGS" => [
            "NAME" => GetMessage("T_IBLOCK_DESC_DETAIL_SETTINGS"),
        ],
    ],
    "PARAMETERS" => [
        "VARIABLE_ALIASES" => [
            "BRAND_ID" => ["NAME" => GetMessage("BRAND_ID_DESC")],
            "MODEL_ID" => ["NAME" => GetMessage("MODEL_ID_DESC")],
            "ELEMENT_ID" => ["NAME" => GetMessage("ELEMENT_ID_DESC")],
        ],
        "SEF_MODE" => [
            "section" => [
                "NAME" => GetMessage("BRAND_PAGE"),
                "DEFAULT" => "#BRAND_ID#/",
                "VARIABLES" => ["BRAND_ID"],
            ],
            "model" => [
                "NAME" => GetMessage("MODEL_PAGE"),
                "DEFAULT" => "#BRAND_ID#/#MODEL_ID#/",
                "VARIABLES" => ["MODEL_ID"],
            ],
            "detail" => [
                "NAME" => GetMessage("DETAIL_PAGE"),
                "DEFAULT" => "detail/#ELEMENT_ID#/",
                "VARIABLES" => ["ELEMENT_ID", "SECTION_ID"],
            ],
        ],
        "ELEMENTS_PER_PAGE" => [
            "PARENT"  => "BASE",
            "NAME"    => getMessage("ELEMENTS_PER_PAGE"),
            "TYPE"    => "STRING",
            "DEFAULT" => "2",
        ],
        "ELEMENT_SORT_FIELD" => [
            "PARENT" => "LIST_SETTINGS",
            "NAME" => GetMessage("IBLOCK_ELEMENT_SORT_FIELD"),
            "TYPE" => "LIST",
            "VALUES" => [
                "PRICE" => GetMessage("IBLOCK_SORT_PRICE"),
                "YEAR" => GetMessage("IBLOCK_SORT_YEAR"),
            ],
            "ADDITIONAL_VALUES" => "Y",
            "DEFAULT" => "ID",
        ],
        "ELEMENT_SORT_ORDER" => [
            "PARENT" => "LIST_SETTINGS",
            "NAME" => GetMessage("IBLOCK_ELEMENT_SORT_ORDER"),
            "TYPE" => "LIST",
            "VALUES" => $arAscDesc,
            "DEFAULT" => "asc",
            "ADDITIONAL_VALUES" => "Y",
        ],
        "CACHE_TIME" => ["DEFAULT" => 36000000],
        "CACHE_GROUPS" => [
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CP_BP_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
    ],
];

CIBlockParameters::AddPagerSettings(
    $arComponentParameters,
    true, //$bDescNumbering
    true, //$bShowAllParam
    true, //$bBaseLink
    $arCurrentValues["PAGER_BASE_LINK_ENABLE"] === "Y" //$bBaseLinkEnabled
);

CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);