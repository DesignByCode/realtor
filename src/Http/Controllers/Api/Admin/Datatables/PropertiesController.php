<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin\DataTables;


use DesignByCode\Realtor\Models\Property;
use Illuminate\Http\Request;

/**
 * Class PropertiesController
 *
 * @package DesignByCode\Realtor\Http\Controllers\Api\Admin\DataTables
 */
class PropertiesController extends DataTableController
{

    /**
     * @var bool
     */
    protected $allowDeletion = true;

    protected $editPath = '/listing/edit/';

    //
    /**
     * @return mixed
     */
    public function builder()
    {
        return Property::query();
    }

    /**
     * @return array
     */
    public function getDisplayableColumns()
    {
        return ['id', 'reference', 'solemandate', 'sold', 'live'];
    }

    /**
     * @return array|mixed
     */
    public function getUpdatableColumns()
    {

        return ['reference' ,'solemandate', 'sold', 'live'];
    }

    /**
     * @param                          $id
     * @param \Illuminate\Http\Request $request
     */
    public function update($id, Request $request)
    {
        $request->validate([
           'reference' => 'required|integer',
            'live' => 'nullable|date'
        ]);
        
        return parent::update($id, $request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|integer|unique:properties',
            'solemandate' => 'nullable|boolean',
            'sold' => 'boolean',
            'live' => 'nullable|date'
        ]);
        return parent::store($request);
    }

    /**
     * @return array
     */
    public function getFormFieldTypes()
    {
        return ['reference' => 'text', 'solemandate' => 'checkbox', 'sold' => 'checkbox', 'live' => 'date'];
    }

}
