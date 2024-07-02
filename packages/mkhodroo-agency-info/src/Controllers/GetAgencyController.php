<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;

class GetAgencyController extends Controller
{
    public static function getByKey($parent_id, $key)
    {
        return AgencyInfo::where('parent_id', $parent_id)->where('key', "$key")->first();
    }

    public static function getByParentId($parent_id)
    {
        return AgencyInfo::where('parent_id', $parent_id)->get();
    }

    public static function getByKeyValue($key, $value)
    {
        $parent_id = AgencyInfo::where('key', $key)->where('value', $value)->first()?->parent_id;
        if($parent_id){
            return self::getByParentId($parent_id);
        }
        return;
    }

    public static function getAllByKeyValue(array $key, array $value): array
    {
        $parent_ids = AgencyInfo::whereIn('key', $key)->whereIn('value', $value)->pluck('parent_id')->toArray();
        $parent_ids = array_unique($parent_ids);
        $agencies = [];
        $i=0;
        foreach($parent_ids as $parent_id){
            $agency = self::getByParentId($parent_id);
            $agencies[$i] = $agency->pluck('value', 'key');
            $agencies[$i]['parent_id'] = $agency->first()->parent_id;
            $i++;
        }
        return $agencies;
    }

}
