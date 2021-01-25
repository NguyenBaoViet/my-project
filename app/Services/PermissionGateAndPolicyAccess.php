<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess {

    public function setGateAndPolicyAccess() {
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateSlider();
        $this->defineGateProduct();
    }

    public function defineGateCategory() {
        Gate::define('list-category','App\Policies\CategoryPolicy@view');
        Gate::define('add-category','App\Policies\CategoryPolicy@create');
        Gate::define('edit-category','App\Policies\CategoryPolicy@update');
        Gate::define('delete-category','App\Policies\CategoryPolicy@delete');
    }

    public function defineGateMenu() {
        Gate::define('list-menu','App\Policies\MenuPolicy@view');
        Gate::define('add-menu','App\Policies\MenuPolicy@create');
        Gate::define('edit-menu','App\Policies\MenuPolicy@update');
        Gate::define('delete-menu','App\Policies\MenuPolicy@delete');
    }

    public function defineGateProduct() {
        Gate::define('list-product','App\Policies\ProductPolicy@view');
        Gate::define('add-product','App\Policies\ProductPolicy@create');
        Gate::define('edit-product','App\Policies\ProductPolicy@update');
        Gate::define('delete-product','App\Policies\ProductPolicy@delete');
    }

    public function defineGateSlider() {
        Gate::define('list-slider','App\Policies\SliderPolicy@view');
        Gate::define('add-slider','App\Policies\SliderPolicy@create');
        Gate::define('edit-slider','App\Policies\SliderPolicy@update');
        Gate::define('delete-slider','App\Policies\SliderPolicy@delete');
    }

    
}
