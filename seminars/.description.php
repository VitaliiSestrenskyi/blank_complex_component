<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("IBLOCK_NEWS_NAME"),
	"DESCRIPTION" => GetMessage("IBLOCK_NEWS_DESCRIPTION"),
	"ICON" => "",
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "seminars",
			"NAME" => GetMessage("T_IBLOCK_DESC_NEWS"),
			"SORT" => 10,
		),
	),
);

?>