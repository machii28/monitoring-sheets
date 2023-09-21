<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\QuestionsOperation;
use App\Http\Requests\MonitoringSheetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MonitoringSheetCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MonitoringSheetCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use QuestionsOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\MonitoringSheet::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/monitoring-sheet');
        CRUD::setEntityNameStrings('monitoring sheet', 'monitoring sheets');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MonitoringSheetRequest::class);
        CRUD::setFromDb();

        $this->crud->field([
            'label' => 'Category',
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'model' => 'App\Models\MonitoringSheetCategory',
            'attribute' => 'category',
            'options' => (function ($query) {
                return $query->orderBy('category', 'ASC')->get();
            })
        ]);

        $this->crud->field([
            'name' => 'user_id',
            'type' => 'hidden',
            'value' => backpack_auth()->user()->id
        ]);

        $this->crud->field([
            'label' => 'Area',
            'type' => 'select',
            'name' => 'area_id',
            'entity' => 'area',
            'model' => 'App\Models\Area',
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            })
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
