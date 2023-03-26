<?php

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Lite\Migration\Demo;

Loc::loadMessages(__FILE__);

class lite_product extends CModule
{
    public $MODULE_ID = "lite.product";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_GROUP_RIGHTS = "Y";

    public function __construct()
    {
        $arModuleVersion = [];
        include(dirname(__FILE__) . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = Loc::getMessage("lite.product_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("lite.product_MODULE_DESC");

        $this->PARTNER_NAME = Loc::getMessage("lite.product_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("lite.product_PARTNER_URI");
    }

    public function getPath()
    {
        return dirname(__DIR__);
    }


    public function installDemo()
    {
        Loader::includeModule($this->MODULE_ID);

        Demo::installData();
    }

    public function InstallDB(): void
    {
        Loader::includeModule($this->MODULE_ID);

        Lite\Migration\Storage::createTables();
    }

    public function UnInstallDB(): void
    {
        Loader::includeModule($this->MODULE_ID);

        Lite\Migration\Storage::dropTables();
    }

    public function InstallEvents(): void
    {

    }

    public function UnInstallEvents(): void
    {

    }

    public function InstallFiles(): void
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/local/modules/lite.product/install/components", $_SERVER["DOCUMENT_ROOT"] . "/local/components", true, true);
    }

    public function UnInstallFiles(): void
    {

    }

    public function DoInstall()
    {
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

        if ($request["step"] < 2) {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("lite.product_INSTALL_TITLE"), $this->getPath() . "/install/step1.php");
        } elseif ($request["step"] == 2) {
            ModuleManager::registerModule($this->MODULE_ID);

            if ($request["delete_data"] == "Y") {
                $this->UnInstallDB();
            }

            $this->InstallDB();
            $this->InstallFiles();
            $this->InstallEvents();

            if ($request["install_demo"] == "Y") {
                $this->installDemo();
            }

        }
    }


    public function DoUninstall()
    {
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

        if ($request["step"] < 2) {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("lite.product_UNINSTALL_TITLE"), $this->getPath() . "/install/unstep1.php");
        } elseif ($request["step"] == 2) {
            $this->UnInstallFiles();
            $this->UnInstallEvents();

            if ($request["savedata"] != "Y") {
                $this->UnInstallDB();
            }

            ModuleManager::unRegisterModule($this->MODULE_ID);
            $APPLICATION->IncludeAdminFile(Loc::getMessage("lite.product_UNINSTALL_TITLE"), $this->getPath() . "/install/unstep2.php");
        }
    }
}

