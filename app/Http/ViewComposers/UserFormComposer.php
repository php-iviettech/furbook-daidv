<?php
/**
 * Created by PhpStorm.
 * User: daidv
 * Date: 11/1/2017
 * Time: 6:50 PM
 */

namespace Furbook\Http\ViewComposers;

use Illuminate\View\View;
use Furbook\Role;

class UserFormComposer
{
    /**
     * The role repository implementation.
     *
     * @var Role
     */
    protected $roles;

    /**
     * Create a new profile composer.
     *
     * @param  Role  $roles
     * @return void
     */
    public function __construct(Role $roles)
    {
        // Dependencies automatically resolved by service container...
        $this->roles = $roles;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //dd(Role::all());
        //dd($this->roles->all());
        //dd($this->roles->pluck('name', 'id'));
        $view->with('roles', $this->roles->pluck('name', 'id'));
    }
}