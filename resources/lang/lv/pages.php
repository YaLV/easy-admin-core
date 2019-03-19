<?php
if(!pageTable()) {
    return ['slugs' => []];
}
return (new \App\Plugins\Pages\Model\Page)->MetaLanguage();