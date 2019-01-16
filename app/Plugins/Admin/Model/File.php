<?php

namespace App\Plugins\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $fillable = ['owner', 'owner_id', 'main', 'filePath', 'fileName'];
}
