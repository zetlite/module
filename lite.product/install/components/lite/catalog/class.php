<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use \Bitrix\Iblock\Component\Tools;

class Catalog extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams): array
    {
        return $arParams;
    }

    public function executeComponent()
    {
        global $APPLICATION;

        $arDefaultUrlTemplates404 = [
            "sections" => "",
            "section" => "#BRAND_ID#/",
            "detail" => "detail/#ELEMENT_ID#/",
            "model" => "#BRAND_ID#/#MODEL_ID#/",
        ];

        $arDefaultVariableAliases404 = [];

        $arDefaultVariableAliases = [];

        $arComponentVariables = [
            "SECTION_ID",
            "MODEL_ID",
            "ELEMENT_ID",
        ];

        $arVariables = [];

        if ($this->arParams["SEF_MODE"] == "Y") {

            $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $this->arParams["SEF_URL_TEMPLATES"]);
            $arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $this->arParams["VARIABLE_ALIASES"]);

            $engine = new CComponentEngine($this);
            $componentPage = $engine->guessComponentPath(
                $this->arParams["SEF_FOLDER"],
                $arUrlTemplates,
                $arVariables
            );

            $b404 = false;
            if (!$componentPage) {
                $componentPage = "sections";
                $b404 = true;
            }

            if (
                $componentPage == "section"
                && isset($arVariables["SECTION_ID"])
                && intval($arVariables["SECTION_ID"]) . "" !== $arVariables["SECTION_ID"]
            )
                $b404 = true;

            if ($b404 && CModule::IncludeModule('iblock')) {
                $folder404 = str_replace("\\", "/", $this->arParams["SEF_FOLDER"]);
                if ($folder404 != "/")
                    $folder404 = "/" . trim($folder404, "/ \t\n\r\0\x0B") . "/";
                if (substr($folder404, -1) == "/")
                    $folder404 .= "index.php";

                if ($folder404 != $APPLICATION->GetCurPage(true)) {
                    Tools::process404(
                        ""
                        , ($this->arParams["SET_STATUS_404"] === "Y")
                        , ($this->arParams["SET_STATUS_404"] === "Y")
                        , ($this->arParams["SHOW_404"] === "Y")
                        , $this->arParams["FILE_404"]
                    );
                }
            }

            CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);

            $this->arResult = [
                "FOLDER" => $this->arParams["SEF_FOLDER"],
                "URL_TEMPLATES" => $arUrlTemplates,
                "VARIABLES" => $arVariables,
                "ALIASES" => $arVariableAliases,
            ];
        } else {

            $arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases, $this->arParams["VARIABLE_ALIASES"]);
            CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

            $componentPage = "";

            if (isset($arVariables["ELEMENT_ID"]))
                $componentPage = "detail";
            elseif (isset($arVariables["MODEL_ID"]))
                $componentPage = "model";
            elseif (isset($arVariables["BRAND_ID"]))
                $componentPage = "section";
            else
                $componentPage = "sections";

            $this->arResult = [
                "FOLDER" => "",
                "URL_TEMPLATES" => [
                    "section" => htmlspecialcharsbx($APPLICATION->GetCurPage()) . "?" . $arVariableAliases["BRAND_ID"] . "=#BRAND_ID#",
                    "model" => htmlspecialcharsbx($APPLICATION->GetCurPage()) . "?" . $arVariableAliases["BRAND_ID"] . "=#BRAND_ID#" . "&" . $arVariableAliases["MODEL_ID"] . "=#MODEL_ID#",
                    "detail" => htmlspecialcharsbx($APPLICATION->GetCurPage()) . "?" . $arVariableAliases["ELEMENT_ID"] . "=#ELEMENT_ID#",
                ],
                "VARIABLES" => $arVariables,
                "ALIASES" => $arVariableAliases,
            ];
        }

        $this->includeComponentTemplate($componentPage);
    }
}