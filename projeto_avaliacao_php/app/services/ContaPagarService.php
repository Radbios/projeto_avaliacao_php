<?php

namespace app\services;

class ContaPagarService {
    public static function sum($obj, $attr, $group = null) {
        $sum = $group ? [] : null;
        foreach ($obj as $item) {
            if(is_array($sum)){
                $sum[$item->$group] = key_exists($item->$group, $sum) ? $sum[$item->$group] + $item->$attr : $item->$attr;
            }
            else $sum += $item->$attr;
        }
        return $sum;
    }
}