<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\AssignMonitoringSheetOperation;
use App\Http\Requests\ProcessOwnerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProcessOwnerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProcessOwnerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation { index as traitIndex; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use AssignMonitoringSheetOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/process-owner');
        CRUD::setEntityNameStrings('process owner', 'process owners');
    }

    public function index()
    {
        $this->crud->removeAllButtonsFromStack('top');

        return $this->traitIndex();
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

        CRUD::denyAccess('delete');
        CRUD::denyAccess('update');
        CRUD::denyAccess('show');

        $this->crud->addClause(function ($query) {
            $query->where('role', 'po');
        });

        $this->crud->setColumnDetails('process_id', [
            'label' => 'Process',
            'type' => 'select',
            'entity' => 'process',
            'attribute' => 'name',
            'model' => 'App\Models\Process'
        ]);

        $this->crud->setColumnDetails('area_id', [
            'label' => 'Area',
            'type' => 'select',
            'entity' => 'area',
            'attribute' => 'name',
            'model' => 'App\Models\Area'
        ]);

        $this->crud->addColumn([
            'name' => 'total_assigned_ms',
            'label' => 'Total Assigned Monitoring Sheets',
            'type' => 'number',
            'attribute' => 'total_assigned_ms'
        ]);

        CRUD::column('role')->remove();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProcessOwnerRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
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
