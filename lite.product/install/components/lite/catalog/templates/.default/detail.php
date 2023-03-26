<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

$APPLICATION->IncludeComponent(
    "lite:catalog.element",
    ".default",
    Array(
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],    // ID элемента
        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],    // URL, ведущий на страницу с содержимым раздела
        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],    // URL, ведущий на страницу с содержимым элемента раздела
        "MESSAGE_404" => $arParams["MESSAGE_404"],    // Сообщение для показа (по умолчанию из компонента)
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],    // Устанавливать статус 404
        "SHOW_404" => $arParams["SHOW_404"],    // Показ специальной страницы
    ),
    $component
);?>
