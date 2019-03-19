<?php
if(!pageTable()) {
    return [];
}
return (new \App\Plugins\Pages\Model\Page)->MetaLanguage();