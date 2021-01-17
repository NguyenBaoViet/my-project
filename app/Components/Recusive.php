<?php

namespace App\Components;

Class Recusive {
    
    private $data;
    private $htmlSelection = '';

    public function __construct($data){
        $this->data = $data;
    }

    function categoryRecusive($id = 0, $text = '',$parentId) {

        foreach($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if (!empty($parentId) && $parentId == $value['id']) {
                    $this->htmlSelection .= "<option selected value = ".$value['id'].">" . $text . $value['name'] . "</option>";
                } else {
                    $this->htmlSelection .= "<option value = ".$value['id'].">" . $text . $value['name'] . "</option>";
                }  
                $this->categoryRecusive($value['id'],$text . '--',$parentId);
            }
        }

        return $this->htmlSelection;
    }

    function getTags($id = 0) {
        foreach($this->data as $value) {
            $this->htmlSelection .= "<option>". $value['name'] . "</option>";
        }
        return $this->htmlSelection;
    }
}