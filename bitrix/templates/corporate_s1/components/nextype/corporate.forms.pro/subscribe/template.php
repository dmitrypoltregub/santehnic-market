<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

CJSCore::Init();

$jsParams = Array (
    'form_id' => 'form_' . $arResult['FORM_ID'],
    'popup_id' => 'popup_' . $arResult['FORM_ID'],
    'recaptcha_id' => 'recaptcha_' . $arResult['FORM_ID'],
);
$message = Array (
    'SUBMIT_BUTTON_TEXT' => (!empty($arParams['SUBMIT_BUTTON_TEXT'])) ? $arParams['SUBMIT_BUTTON_TEXT'] : GetMessage('NT_FORMS_SEND')
);

?>

<div class="text icon"><?=$arParams['FORM_TITLE']?></div>
<form method="post" enctype="multipart/form-data" id="<?=$jsParams['form_id']?>" class="form">
    <? if ($arParams['IS_AJAX'] == "Y") $APPLICATION->RestartBuffer(); ?>
    
    <?=bitrix_sessid_post(); ?>
    <? if ($arResult['SUCCESS']): ?>
        <div class="success-message">
            <?= $arResult['SUCCESS'] ?>
        </div>
    
    <? else: ?>
    
        
    <? foreach ($arResult['FIELDS'] as $arField): ?>
    <div class="field">
        <? if (!empty($arField['error'])): ?><div class="error-tip"><?= $arField['error']['TEXT'] ?></div><? endif; ?>
        <?= $arField['html'] ?>
    </div>
    <? endforeach; ?>
    
    
    
    <button type="submit" class="btn color"><?= $message['SUBMIT_BUTTON_TEXT'] ?></button>
    
    <? endif; ?>
    
    <? if ($arParams['IS_AJAX'] == "Y") { $APPLICATION->FinalActions(); die(); } ?>
</form>


<?

$arParams['COMPONENT_TEMPLATE'] = $templateName;
$signer = new Main\Security\Sign\Signer;
$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'nextype.corporate.forms.pro');
$messages = Loc::loadLanguageFile(__FILE__);
?>

<script>
        BX.message(<?=CUtil::PhpToJSObject($messages)?>);
        window['<?=CUtil::JSEscape($jsParams['form_id'])?>'] = new NextypeFormsProComponentInit({
            formId: '<?=CUtil::JSEscape($jsParams['form_id'])?>',
            popupId: '<?=CUtil::JSEscape($jsParams['popup_id'])?>',
            params: <?=CUtil::PhpToJSObject(Array (
                'CAPTCHA' => $arParams['CAPTCHA'],
                'MESSAGE_ERRORALL' => $arParams['MESSAGE_ERRORALL'],
                'MESSAGE_SUCCESS' => $arParams['MESSAGE_SUCCESS'],
                'RECAPTCHA_CODE' => $arParams['RECAPTCHA_CODE'],
                'RECAPTCHA_ID' => $jsParams['recaptcha_id'],
                'VIEW_TYPE' => $arParams['VIEW_TYPE'],
            ))?>,
            signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
            siteID: '<?=CUtil::JSEscape($component->getSiteId())?>',
            ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
        });

        

</script>    
    

