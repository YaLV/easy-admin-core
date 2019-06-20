<?php

namespace App\Plugins\Log;


use App\Plugins\Log\Functions\Log;
use App\Schedules;

class LogController
{
    use Log;

    public function index($types = null) {

        $schedules = $this->getLog($types);

        $view = view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Import/Export Log',
                'list'         => $schedules,
                'idField'      => 'name',
                'destroyName'  => 'log',
            ]);

        if($types) {
            /** @var array $viewSections */
            $viewSections = $view->renderSections();
            return ['data' => $viewSections['content'], 'noMessage' => true];
        }

        return $view;
    }
}