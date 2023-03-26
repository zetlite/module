<?php

/** @global CMain $APPLICATION */

use Bitrix\Main\Localization\Loc;

?>
<form action="<?= $APPLICATION->GetCurPage(); ?>">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
    <input type="hidden" name="id" value="lite.product">
    <input type="hidden" name="install" value="Y">
    <input type="hidden" name="step" value="2">
    <p>
        <input type="checkbox" name="delete_data" id="delete_data" value="Y">
        <label for="delete_data">
            <?= Loc::getMessage("LITE_DELETE_TABLES") ?>
        </label>
    </p>
    <p>
        <input type="checkbox" name="install_demo" id="install_demo" value="Y" checked>
        <label for="install_demo">
            <?= Loc::getMessage("LITE_INSTALL_DEMO") ?>
        </label>
    </p>
    <input type="submit" name="" value="<?= Loc::getMessage("MOD_INSTALL") ?>">
</form>