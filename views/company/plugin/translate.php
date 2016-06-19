<?php
$lang = json_encode($lang);
?>
<div id="google_translate_element"></div>

<script type="text/javascript">
    var lang = <?=$lang?>;
</script>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'zh-TW',
            includedLanguages: 'en,vi,zh-CN,es,fr,km,lo',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
