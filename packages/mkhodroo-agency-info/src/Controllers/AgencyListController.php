<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\Cities\Controllers\CityController;
use Mkhodroo\DateConvertor\Controllers\SDate;

class AgencyListController extends Controller
{
    public static function view()
    {
        // return AgencyInfo::groupBy('key')->pluck('key')->toArray();
        return view('AgencyView::list')->with([
            'cols' => self::getKeys()
        ]);
    }

    public static function getKeys(){
        return AgencyInfo::groupBy('key')->pluck('key');
    }

    public static function list()
    {
        return [
            'data' => []
        ];
    }
    public static function filterList(Request $r)
    {
        $main_field = config('agency_info.main_field_name');
        if($r->field_value === null and $r->$main_field === null){
            $agencies =  AgencyInfo::where('parent_id', DB::raw('id'))->get();
        }else{
            if($r->field_value == null){
                $agencies =  AgencyInfo::where('value', $r->$main_field)->groupBy('parent_id')->get();
            }
            elseif($r->$main_field == null){
                $agencies =  AgencyInfo::where('value', 'like', "%". $r->field_value. "%")->groupBy('parent_id')->get();
            }else{
                $parent_ids =  AgencyInfo::where('value', 'like', "%". $r->field_value. "%")->groupBy('parent_id')->pluck('parent_id');
                $agencies = AgencyInfo::whereIn('id', $parent_ids)->where('value', $r->$main_field)->groupBy('parent_id')->get();
            }
            

        }
        // return $agencies;
        $agencies =  $agencies->each(function ($agency) {
            $keys = self::getKeys();
            foreach($keys as $key){
                if($key === 'province'){
                    $agency->$key = CityController::getById(GetAgencyController::getByKey($agency->parent_id, $key)?->value)->province;
                }else{
                    $agency->$key = __(GetAgencyController::getByKey($agency->parent_id, $key)?->value);
                }
            }
            

        });
        return ['data' => $agencies];
    }

}
