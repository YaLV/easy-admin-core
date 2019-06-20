<?php

namespace App\Plugins\Pages\Model;

use App\BaseModel;
use App\Plugins\Admin\Model\File;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends BaseModel
{
    use SoftDeletes;

    public $fillable = ['template', 'title', 'homepage', 'hasChildren'];
    public $metaClass = __NAMESPACE__ . '\PageMeta';


    public function templates() {
        return $this->belongsTo(Template::class, 'template', 'id');
    }

    public function images()
    {
        return $this->hasMany(File::class, 'owner_id');
    }

    public function components() {
        return $this->hasMany(PageComponent::class);
    }

    public function getTemplateNameAttribute() {
        return $this->templates->name;
    }
}
