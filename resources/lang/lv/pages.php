<?php
if(!pageTable()) {
    return ['slug' => []];
}
return (new \App\Plugins\Pages\Model\Page)->MetaLanguage();