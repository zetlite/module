<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-' . $arParams['TEMPLATE_THEME'] : '';
?>
<div class="news-list<?= $themeClass ?> lite_class">
    <div class="col">
        <div class="row">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="news-list-item mb-2 col-sm">
                    <div class="card">
                        <div class="card-body">

                            <? if ($arItem["NAME"]): ?>
                                <h4 class="card-title">
                                    <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a>
                                </h4>
                            <? endif; ?>

                            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                <p class="card-text"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>

        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.pagenavigation",
            "",
            [
                "NAV_OBJECT" => $arResult["NAV"],
                "SEF_MODE" => "N",
            ],
            false
        );
        ?>
    </div>
</div>
