<?php

namespace App\Model\Pages;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $primaryKey = 'page_id';

    protected $fillable = [
        'status', 'hidden', 'parent_id', 'name', 'seo_name', 'short_description',
        'description', 'image', 'icon', 'meta_title', 'meta_keyword', 'meta_description', 'order'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }
    // todo: yönetim panelinde children -> childrens olacak
    public function childrens()
    {
        return $this->hasMany('App\Model\Pages\Page', 'parent_id')->orderBy('order', 'ASC')->with('childrens');
    }

    public function children()
    {
        return $this->hasMany('App\Model\Pages\Page', 'parent_id')->orderBy('order', 'ASC');
    }

    public function parents()
    {
        return $this->belongsTo('App\Model\Pages\Page', 'parent_id')->orderBy('order', 'ASC')->with('parents');
    }

    public function parent()
    {
        return $this->belongsTo('App\Model\Pages\Page', 'parent_id')->orderBy('order', 'ASC');
    }

    /**
     * breadcrumbs
     * @return array
     */
    public function breadcrumbs($based)
    {
        $breadcrumbs = [];
        $breadcrumb = [];
        $breadcrumb['name'] = $this->name;
        if ($based == 'backend') {
            $breadcrumb['link'] = route('backend.page.lists', ['id' => $this->id()]);
        } elseif ($based = 'frontend') {
            $breadcrumb['link'] = route('frontend.page.view', ['seo_name' => $this->seo_name]);
        }
        array_push($breadcrumbs, $breadcrumb);
        $parents = $this->parents;
        if ($parents) {
            while (true) {
                $breadcrumb = [];
                $breadcrumb['name'] = $parents->name;

                if ($based == 'backend') {
                    $breadcrumb['link'] = route('backend.page.lists', ['id' => $parents->id()]);
                } elseif ($based = 'frontend') {
                    $breadcrumb['link'] = route('frontend.page.view', ['seo_name' => $parents->seo_name]);
                }
                array_push($breadcrumbs, $breadcrumb);
                if ($parents->parents) {
                    $parents = $parents->parents;
                } else {
                    break;
                }
            }
        }
        return array_reverse($breadcrumbs);
    }

    /**
     * Backend breadcrumbs
     * @return array
     */
    public function backendBreadcrumbs()
    {
        return $this->breadcrumbs('backend');
    }

    /**
     * Frontend breadcrumbs
     * @return array
     */
    public function frontendBreadcrumbs()
    {
        return $this->breadcrumbs('frontend');
    }

    public function countChildren()
    {
        return $this->where('parent_id', $this->id())->count();
    }
}
