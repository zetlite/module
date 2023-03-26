<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-' . $arParams['TEMPLATE_THEME'] : '';
CUtil::InitJSCore(['fx', 'ui.fonts.opensans']);
?>
<div class="news-detail<?= $themeClass ?> lite_class">
    <div class="mb-3" id="<? echo $this->GetEditAreaId($arResult['ID']) ?>">

        <div class="news-detail-body">

            <? if ($arResult["NAME"]): ?>
                <h1 class="news-detail-title"><?= $arResult["NAME"] ?></h1>
            <? endif; ?>
            <p><?= Loc::getMessage('BRAND', ["#BRAND#" => $arResult["BRAND_NAME"]]) ?></p>
            <p><?= Loc::getMessage('MODEL', ["#MODEL#" => $arResult["MODEL_PRODUCT_NAME"]]) ?></p>
            <p><?= Loc::getMessage('PRICE', ["#PRICE#" => $arResult["PRICE"]]) ?></p>
            <p><?= Loc::getMessage('YEAR', ["#YEAR#" => $arResult["YEAR"]]) ?></p>
        </div>

        <div>
            <h2 class="news-detail-title"><?= Loc::getMessage('OPTIONS') ?></h2>
            <ul class="list-group">

                <? foreach ($arResult["PROPERTIES"] as $pid => $arProperty) {
                    echo "<li class='list-group-item'>" . $arProperty . "</li>";
                } ?>
            </ul>
        </div>


    </div>
</div>
