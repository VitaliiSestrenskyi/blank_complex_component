<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


//настройки для ЧПУ - по-умолчанию
$arDefaultUrlTemplates404 = array(
	"list" => "",
	"detail" => "#SEMINAR_ID#/",
	"form" => "#SEMINAR_ID#/register/",
);

//настройки псевдонимов по-умолчанию
$arDefaultVariableAliases404 = array('detail'=>['ELEMENT_ID'=>'ID']);

$arDefaultVariableAliases = array();

$arComponentVariables = array(
	"FORM_ID",
	"SEMINAR_ID",
	"ELEMENT_ID",
);

//если мы включили режим ЧПУ
if($arParams["SEF_MODE"] == "Y")
{
	$arVariables = array();

    //массив шаблонов
	$arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);

    //массив псевдонимов переменных
    $arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);


	$engine = new CComponentEngine($this);
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);


    if(!$componentPage)
    {
        $componentPage = 'list';
    }


	CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);

	$arResult = array(
		"FOLDER" => $arParams["SEF_FOLDER"],
		"URL_TEMPLATES" => $arUrlTemplates,
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases,
	);


    dd( $arResult );
}
else
{
	$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
	CComponentEngine::initComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

	$componentPage = "";

	if(isset($arVariables["ELEMENT_ID"]) && intval($arVariables["ELEMENT_ID"]) > 0)
		$componentPage = "detail";
	else
		$componentPage = "list";

	$arResult = array(
		"FOLDER" => "",
		"URL_TEMPLATES" => array(
			"news" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
			"section" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"),
			"detail" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#"),
        ),
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases
	);
}


$this->includeComponentTemplate($componentPage);