<?php

namespace Mkhodroo\AgencyInfo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mkhodroo\AgencyInfo\Models\AgencyInfo;
use Mkhodroo\AgencyInfo\Requests\AgencyDocRequest;

class HtmlCreatorController extends Controller
{
    

    public static function createInput($field_name, array $attr, $default_value = '')
    {
        if ($attr['type'] == 'text'){
            $required = '';
            echo "<input type='text' name='$field_name' value='$default_value' class='form-control' id=''>";
        }
        if ($attr['type'] == 'checkbox'){
            $checked = $default_value ? 'checked' : '';
            echo "<input type='checkbox' name='$field_name' class='' $checked>". __($field_name) . '<br>';
        }
        if ($attr['type'] == 'select'){
            echo "<select name='$field_name' class='form-control select2'>";
            foreach($attr['options'] as $option){
                $value = $option['value'];
                $label = $option['label'];
                $selected = $value == $default_value ? 'selected': '';
                echo "<option value='$value' $selected>$label</option>";
            }
            echo "</select>";
        }
        
    }
}
