<?php

namespace App\Components;
use App\Menu;

class MenuRecusive {

    private $html;
    public function __construct() {
        $this->html = '';
    }

    public function MenuRecusiveAdd($parent_id = 0, $subtext = '') {
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $value) {
            $this->html .= '<option value ="'.$value['id'].'">'.$subtext.$value['name'].'</option>';
            $this->MenuRecusiveAdd($value['id'], $subtext.'--');
        }
        return $this->html;
    }

    public function MenuRecusiveEdit($id = 0, $subtext = '',$parent_id = 0) {
        $data = Menu::where('parent_id', $id)->get();
        foreach ($data as $value) {
            if ($parent_id == $value->id) {
                $this->html .= '<option selected value ="'.$value['id'].'">'.$subtext.$value['name'].'</option>';
            } else {
                $this->html .= '<option value ="'.$value['id'].'">'.$subtext.$value['name'].'</option>';
            }
            $this->MenuRecusiveEdit($value['id'], $subtext.'--',$parent_id);
        }
        return $this->html;
    }
}