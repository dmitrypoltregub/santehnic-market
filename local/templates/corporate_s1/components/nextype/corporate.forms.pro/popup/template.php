<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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

<div class="box">
    <div class="head">
        <div class="title"><?=$arParams['FORM_TITLE']?></div>
        <a href="javascript:void();" data-close class="close"></a>
    </div>
    <form method="post" enctype="multipart/form-data" id="<?=$jsParams['form_id']?>">
        <? if ($arParams['IS_AJAX'] == "Y") $APPLICATION->RestartBuffer(); ?>
    
        <?=bitrix_sessid_post(); ?>
        <? if ($arResult['SUCCESS']): ?>
            <div class="success-message">
                <?= $arResult['SUCCESS'] ?>
            </div>
            <a href="javascript:void();" data-close class="btn color"><?= GetMessage('NT_FORMS_CLOSE'); ?></a>
        <? else: ?>

            <? foreach ($arResult['FIELDS'] as $arField): ?>
            <? if ($arField['name'] == "SYSTEM_PERSONAL_PROCESSING") continue; ?>
            <div class="field">
                <div class="label">
                    <label for="<?=$arField['name']?>"><?=$arField['label']?></label>
                    <? if (!empty($arField['error'])): ?>
                    <div class="error-tip"><?=$arField['error']['TEXT']?></div>
                    <? endif; ?>
                </div>

                <?= $arField['html'] ?>
            </div>
            <? endforeach; ?>
        
            
            <? if ($arParams['CAPTCHA'] == 'RECAPTCHA'): ?>
            <div class="captcha field">
                <div id="<?= $jsParams['recaptcha_id'] ?>"></div>
                <? if ($arResult['ERROR']['CAPTCHA']): ?>
                        <div class="error-tip"><?= $arResult['ERROR']['CAPTCHA']['TEXT'] ?></div>
                    <? endif; ?>
            </div>
            <? elseif ($arParams['CAPTCHA'] == 'DEFAULT'): ?>
            <div class="captcha field">
                    <div class="label"><?= GetMessage('NT_FORMS_CAPTCHA_LABEL') ?><span class="required">*</span></div>
                    <div class="image">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA_CODE']; ?>" alt="CAPTCHA" />
                        <input type="hidden" name="<?= $arResult['FORM_ID'] ?>[captcha_sid]" value="<?= $arResult['CAPTCHA_CODE']; ?>" />
                    </div>
                    <input type="text" required="required" class="form-text" name="<?= $arResult['FORM_ID'] ?>[captcha_word]" value="" />
                    <? if ($arResult['ERROR']['CAPTCHA']): ?>
                        <div style="clear:both"></div>
                        <div class="error-tip"><?= $arResult['ERROR']['CAPTCHA']['TEXT'] ?></div>
                    <? endif; ?>
                </div>
            <? endif; ?>
            
            
            
        <? if ($arParams['PERSONAL_PROCESSING'] == "Y"): ?>
        <div class="field">
            <div class="checkbox">
                <?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['html']?>
                <label for="<?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['field_id']?>"><?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['label']?></a></label>
                <?if($arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['error']):?>
                <div class="error-tip"><?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['error']['TEXT'] ?></div>
                <? endif; ?>
            </div>
        </div>
        <? endif; ?>
        
        
        <button class="btn color"><?= $message['SUBMIT_BUTTON_TEXT'] ?></button>
        
        <? endif; ?>
        <script data-skip-moving="true">
            $("#<?=$jsParams['form_id']?> input[data-mask]").each (function () {
                var mask = $(this).data('mask').replace(/#/g, "9");
                $(this).mask(mask);
            });
        </script>
        <? if ($arParams['IS_AJAX'] == "Y") { $APPLICATION->FinalActions(); die(); } ?>
    </form>
</div>


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
    
    

