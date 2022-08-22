<?
\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);
?>
<? if (!\Nextype\Corporate\CCorporate::isCustomPage()): ?>
            </main>
	</div>
</div>
<? endif; ?>

</div>

<?
$footerType = \Nextype\Corporate\CCorporate::$options['FOOTER_TYPE'];
if (!empty($footerType) && file_exists(__DIR__ . "/footers/" . $footerType . ".php"))
    include(__DIR__ . "/footers/" . $footerType . ".php");
else
    include(__DIR__ . "/footers/type1.php");
?>

<?= \Nextype\Corporate\CCorporate::$options['YANDEX_METRIKA_COUNTER']?>
<?=\Nextype\Corporate\CCorporate::$options['GOOGLE_ANALYTICS_COUNTER']?>
</body>
</html>