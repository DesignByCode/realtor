<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin\DataTables;

use App\Http\Controllers\Controller;
use function array_map;
use function array_push;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use function var_dump;

/**
 * Class DataTableController
 *
 * @package DesignByCode\Realtor\Http\Controllers\Api\Admin\DataTables
 */
abstract class DataTableController extends Controller
{

    /**
     * @var bool
     */
    protected $allowCreation = true;

    /**
     * @var bool
     */
    protected $allowDeletion = false;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * @return mixed
     */
    abstract public function builder();

    /**
     * DataTableController constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $builder = $this->builder();

        if (!$builder instanceof Builder) {
            throw new Exception('Entity builder not instance of Builder');
        }

        $this->builder = $builder;

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()
            ->json([
                'data' => [
                    'allow' => [
                        'creation' => $this->allowCreation,
                        'deletion' => $this->allowDeletion
                    ],
                    'custom_html' => $this->createCustomHTML(),
                    'table' => $this->builder->getModel()->getTable(),
                    'displayable' => array_values($this->getDisplayableColumns()),
                    'updatable' => array_values($this->getUpdatableColumns()),
                    'custom_columns' => $this->getCustomColumnNames(),
                    'records' => $this->getRecords($request),
                    'form_field_type' => $this->getFormFieldTypes(),
                ]
            ]);
    }

    /**
     * @param                          $id
     * @param \Illuminate\Http\Request $request
     */
    public function update($id, Request $request)
    {
        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        if (!$this->allowCreation) 
        {
            return;
        }
        
        $this->builder->create($request->only($this->getUpdatableColumns()));
    }

    /**
     * @param                          $id
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Exception
     */
    public function destroy($id, Request $request)
    {
        if (!$this->allowDeletion) return;

        $this->builder->find($id)->delete();
    }

    /**
     * @return array
     */
    public function getDisplayableColumns()
    {
        return array_diff($this->getDatabaseColumnsName(), $this->builder->getModel()->getHidden());
    }

    /**
     * @return mixed
     */
    public function getUpdatableColumns()
    {
        return $this->getDisplayableColumns();
    }

    /**
     * @return array
     */
    public function getCustomColumnNames()
    {
        return [];
    }

    /**
     * @return string
     */
    public function createCustomHTML()
    {
        return '';
    }

    /**
     * @return array
     */
    public function getFormFieldTypes()
    {
        return [];
    }


    /**
     * @return mixed
     */
    protected function getDatabaseColumnsName()
    {
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function getRecords(Request $request)
    {
        $builder = $this->builder;

        if ($this->hasSearchQuery($request)) {
            $builder = $this->buildSearch($builder, $request);
        }

        try {

            return $this->builder->limit($request->limit)->orderBy('id', 'asc')->get($this->getDisplayableColumns());

        } catch (QueryException $e) {

            return [];
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function hasSearchQuery(Request $request)
    {
        return count(array_filter($request->only(['column', 'operator', 'value']))) === 3;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Http\Request              $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildSearch(Builder $builder, Request $request)
    {
        $queryParts = $this->resolveQueryParts($request->operator, $request->value);

        return $builder->where($request->column, $queryParts['operator'], $queryParts['value']);
    }

    /**
     * @param $operator
     * @param $value
     *
     * @return mixed
     */
    protected function resolveQueryParts($operator, $value)
    {
        return array_get([
            'equels' => [
                'operator' => '=',
                'value' => $value
            ],
            'contains' => [
                'operator' => 'LIKE',
                'value' => "%{$value}%"
            ],
            'starts_with' => [
                'operator' => 'LIKE',
                'value' => "{$value}%"
            ],
            'ends_with' => [
                'operator' => 'LIKE',
                'value' => "%{$value}"
            ],
            'greater_than' => [
                'operator' => '>',
                'value' => $value
            ],
            'less_than' => [
                'operator' => '<',
                'value' => $value
            ],
        ], $operator);
    }

}
