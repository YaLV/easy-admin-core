<?php

namespace App\Plugins\Pages\Model;

use App\BaseModel;
use App\Plugins\Admin\Model\File;
use Illuminate\Database\Eloquent\Builder;


/**
 * Class PageComponent
 *
 * @package App\Plugins\Pages\Model
 */
class PageComponent extends BaseModel
{
    /**
     * @var array
     */
    public $fillable = ['component_name', 'component_slug', 'page_id', 'template_id', 'sequence'];
    /**
     * @var string
     */
    public $metaClass = __NAMESPACE__ . '\PageComponentMeta';

    public static function boot()
    {
        static::addGlobalScope('order', function(Builder $builder) {
            $builder->orderBy('sequence', 'asc');
        });

        parent::boot();
    }

    /**
     * @param $parameter
     *
     * @return string|array
     */
    public function getData($parameter)
    {
        if (array_key_exists($parameter, $this->meta['data'][language()] ?? [])) {
            return $this->meta['data'][language()][$parameter] ?? "";
        }

        return "";
    }

    /**
     * @param        $method
     * @param string $size
     *
     * @return string
     */
    public function getComponentImage($method = 'shuffle', $size = "original", $name = false)
    {
        if(!($this->meta['data']??false)) {
            return "";
        }
        $path = "";
        $filename = "";
        if($name) {
            $path = config("app.uploadFile.$name");
            $size = "original";
            $ids = $this->getData('image');
            $ids = is_array($ids)?$ids:[$ids];
            $filename = File::where('owner', $name)->whereIn('id', $ids)->first()->filePath ?? "";
        } else {
            if ($this->meta['data'][language()]['image']) {
                $path = config("app.uploadFile.pageimage", "temp");
                switch ($method) {
                    case "shuffle":
                    default:
                        $images = $this->getData('image');
                        shuffle($images);
                        $filename = File::find(current($images))->filePath ?? "";
                        break;

                    case "first":
                        $filename = File::find(current($this->getData('image')))->filePath ?? "";
                        break;

                    case "last":
                        $images = array_reverse($this->getData('image'));
                        $filename = File::find(current($images))->filePath ?? "";
                        break;

                    case "main":
                        $images = $this->getData('image');
                        $filename = File::whereIn('id', $images)->where('main', true)->first()->filePath ?? "";
                        break;
                }
            }
        }

        return implode("/", [$path, $size, $filename]);
    }

    public function images() {
        return $this->hasMany(File::class, 'owner_id');
    }
}
