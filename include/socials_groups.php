<? foreach (Array ('VK', 'FACEBOOK', 'INSTAGRAM', 'TWITTER', 'GPLUS') as $code): ?>
    <? if (!empty(\Nextype\Corporate\CCorporate::$options['SOCIAL_LINK_' . $code])): ?>
        <a href="<?=\Nextype\Corporate\CCorporate::$options['SOCIAL_LINK_' . $code]?>" target="_blank" rel="nofollow" class="link icon <?=strtolower($code)?>"></a>
    <? endif; ?>
<? endforeach; ?>
