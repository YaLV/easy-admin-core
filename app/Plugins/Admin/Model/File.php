<?php

namespace App\Plugins\Admin\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 *
 * @package App\Plugins\Admin\Model
 */
class File extends Model
{
    /**
     * @var array
     */
    public $fillable = ['owner', 'owner_id', 'main', 'filePath', 'fileName'];
}
