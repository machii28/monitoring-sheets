<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AreaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AreaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AreaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Area::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/area');
        CRUD::setEntityNameStrings('area', 'areas');
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
        $this->crud->removeButtonFromStack('show', 'line');

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
        CRUD::setValidation(AreaRequest::class);
        CRUD::setFromDb();
        $this->crud->replaceSaveActions([
            [
                'name' => 'save_and_new',
                'button_text' => 'Save and New',
                'redirect' => function ($crud, $request, $itemId) {
                    return $crud->route . '/create';
                }
            ],
            [
                'name' => 'save_and_back',
                'button_text' => 'Save and Back',
                'redirect' => function ($crud, $request, $itemId) {
                    return $crud->route;
                }
            ]
        ]);
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
        CRUD::setValidation(AreaRequest::class);
        CRUD::setFromDb();
        $this->crud->removeSaveActions([
            'save_and_back',
            'save_and_new',
            'save_and_preview'
        ]);

        $this->crud->replaceSaveActions([
            'name' => 'save_and_edit',
            'button_text' => 'Save',
            'redirect' => function ($crud, $request, $itemId) {
                return $crud->route . "/$itemId/edit";
            }
        ]);
    }
}
