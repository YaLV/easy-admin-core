<?php

$meta = (new \App\Plugins\Translations\Model\Translation)->MetaLanguage();

return $meta['translation']??[];