<?php

namespace App\Plugins\Banners\Model;

use App\BaseModel;
use App\Plugins\Admin\Model\File;
use App\Plugins\Categories\Model\Category;
use Carbon\Carbon;

class Banner extends BaseModel
{
    public $fillable = [
        'title',
        'dateFrom',
        'dateTo',
        'frequency',
        'colors',
    ];
    public $casts = [
        'colors' => 'array',
    ];
    public $metaClass = __NAMESPACE__ . "\BannerMeta";

    public $imageList;

    public function images()
    {
        return $this->hasMany(File::class, 'owner_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getDatesAttribute()
    {
        if (!$this->id) return "";

        return implode(" ~ ", [(new Carbon($this->dateFrom))->format("d.m.Y H:i"), (new Carbon($this->dateTo))->format("d.m.Y H:i")]);
    }

    public function getColorTextAttribute()
    {
        return $this->colors['color_text'] ?? "000000";
    }

    public function getColorUrlAttribute()
    {
        return $this->colors['color_url'] ?? "1f9363";
    }

    public function getColorBackgroundAttribute()
    {
        return $this->colors['color_background'] ?? "f8ddc4";
    }

    public function getCatListAttribute()
    {
        $return = [];
        foreach ($this->categories as $category) {
            $return[] = $category->meta['name'][language()];
        }

        return count($return) ? implode(", ", $return) : "All Categories";
    }

    public function getShowAsInactiveAttribute() {
        $now = Carbon::now();
        if($now > $this->dateFrom && $now < $this->dateTo){
            return false;
        } else {
            return true;
        }
    }

    public function getBannerImageAttribute() {
        if(!$this->imageList) {
            foreach(languages() as $lng) {
                $this->imageList[$lng->code] = $this->images()->where('id', $this->meta['image'][$lng->code])->get();
            }
        }
        return $this->imageList[$this->language];
    }

    public function getTargetAttribute() {
        return $this->meta['target'][$this->language];
    }

}
