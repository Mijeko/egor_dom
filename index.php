<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Объекты недвижимости");
DevIncludeFile('index');
?>


	<script type="application/javascript">


        let fd = new FormData();

        fd.append('cityId', '<?=\Bitrix\Main\Application::getInstance()->getContext()->getRequest()->get("cityId") ?? 1?>')

        fetch('/ses.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(r => {
            console.log(r);
        });
	</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>