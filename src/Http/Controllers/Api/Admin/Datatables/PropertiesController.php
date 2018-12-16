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
        return ['id', 'reference', 'price', 'solemandate', 'sold', 'live'];
    }

    /**
     * @return array|mixed
     */
    public function getUpdatableColumns()
    {

        return ['reference' ,'price', 'solemandate', 'sold', 'live'];
    }

    /**
     * @param                          $id
     * @param \Illuminate\Http\Request $request
     */
    public function update($id, Request $request)
    {
        $request->validate([
           'reference' => 'required|integer',
           'price' => 'nullable|integer'
        ]);

        parent::update($id, $request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|integer|unique:properties',
            'price' => 'nullable|integer',
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
        return ['reference' => 'text', 'price' => 'number', 'solemandate' => 'checkbox', 'sold' => 'checkbox', 'live' => 'date'];
    }

}
