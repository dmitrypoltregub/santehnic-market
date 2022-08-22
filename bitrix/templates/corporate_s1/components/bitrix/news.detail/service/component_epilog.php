<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<script>
    jqmPopup('service', 'include/ajax/forms/services.php?SERVICE=<?=urlencode($arResult['NAME'])?>');
</script>