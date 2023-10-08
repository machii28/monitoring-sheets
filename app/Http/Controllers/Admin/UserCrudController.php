<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
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

        $this->crud->setColumnDetails('role', [
            'label' => 'Role',
            'type' => 'select_from_array',
            'options' => [
                'qao' => 'QMR',
                'po' => 'Process Owner',
                'qa' => 'QA Coordinator / Admin'
            ]
        ]);
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
        CRUD::setValidation(UserRequest::class);

        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field('role')
            ->type('select_from_array')
            ->label('User Role')
            ->options([
                'qao' => 'QMR',
                'po' => 'Process Owner',
                'qa' => 'QA Coordinator / Admin'
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

        $this->crud->field([
            'label' => 'Process',
            'type' => 'select',
            'name' => 'process_id',
            'entity' => 'process',
            'model' => 'App\Models\Process',
            'attribute' => 'name'
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
