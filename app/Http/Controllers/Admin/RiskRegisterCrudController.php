<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\AssignProcessOwnerOperation;
use App\Http\Controllers\Admin\Operations\QuestionsOperation;
use App\Http\Requests\MonitoringSheetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RiskRegisterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RiskRegisterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation { index as traitIndex; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use AssignProcessOwnerOperation;
    use QuestionsOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\MonitoringSheet::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/risk-register');
        CRUD::setEntityNameStrings('RR', 'Risk Register');
    }

    public function store()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();
        $request->request->set('category', 'rr');

        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitStore();
    }

    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();
        $request->request->set('category', 'rr');

        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitUpdate();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb();

        $this->crud->addClause(function ($query) {
            $query->where('category', 'rr');
        });

        $this->crud->removeColumn('category');

        $this->crud->setColumnDetails('area_id', [
            'label' => 'Area',
            'type' => 'select',
            'entity' => 'area',
            'attribute' => 'name',
            'model' => 'App\Models\Area'
        ]);

        $this->crud->setColumnDetails('division_id', [
            'label' => 'Division',
            'type' => 'select',
            'entity' => 'division',
            'attribute' => 'name',
            'model' => 'App\Models\Division'
        ]);

        $this->crud->setColumnDetails('process_id', [
            'label' => 'Process',
            'type' => 'select',
            'entity' => 'process',
            'attribute' => 'name',
            'model' => 'App\Models\Process'
        ]);

        $this->crud->setColumnDetails('coverage', [
            'label' => 'Coverage',
            'type' => 'select_from_array',
            'options' => [
                '1' => 'January - March',
                '2' => 'April - June',
                '3' => 'July - September',
                '4' => 'October - December'
            ]
        ]);

        CRUD::column('user_id')->remove();
        CRUD::column('prepared_by')->remove();
        CRUD::column('prepared_by_role')->remove();
        CRUD::column('checked_by')->remove();
        CRUD::column('checked_by_role')->remove();

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

        $this->crud->field([
            'label' => 'Category',
            'type' => 'text',
            'value' => 'Risk Register',
            'name' => 'category',
            'attributes' => [
                'disabled' => true,
            ]
        ]);

        $this->crud->field([
            'label' => 'Division',
            'type' => 'select',
            'name' => 'division_id',
            'entity' => 'division',
            'model' => 'App\Models\Division',
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            })

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
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            })
        ]);

        $this->crud->field([
            'label' => 'Coverage',
            'type' => 'select_from_array',
            'name' => 'coverage',
            'options' => [
                '1' => 'January - March',
                '2' => 'April - June',
                '3' => 'July - September',
                '4' => 'October - December'
            ]
        ]);

        $this->crud->field([
            'name' => 'user_id',
            'type' => 'hidden',
            'value' => backpack_auth()->user()->id
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
