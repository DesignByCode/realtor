<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin\DataTables;

use App\User;
use Illuminate\Http\Request;

/**
 * Class UsersController
 *
 * @package DesignByCode\Realtor\Http\Controllers\Api\Admin\DataTables
 */
class UsersController extends DataTableController
{

    /**
     * @var bool
     */
    protected $allowCreation = true;

    /**
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function builder()
    {
        return User::query();
    }

    /**
     * @return array
     */
    public function getDisplayableColumns()
    {
        return ['id', 'name', 'email'];
    }

    /**
     * @return array|mixed
     */
    public function getUpdatableColumns()
    {
        return ['name', 'email'];
    }

    /**
     * @param                          $id
     * @param \Illuminate\Http\Request $request
     */
    public function update($id, Request $request)
    {
        $request->validate([
           'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        parent::update($id, $request);
    }

    /**
     * @return array
     */
    public function getCustomColumnNames()
    {
        return ['name' => 'Full name'];
    }

    /**
     * @return string
     */
    public function createCustomHTML()
    {
        return 'html';

    }


}
