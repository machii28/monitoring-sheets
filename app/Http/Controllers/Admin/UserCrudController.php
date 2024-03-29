<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Mail\SendPassword;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Request as HttpRequest;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
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

    public function store()
    {
        Mail::to(request()->get('email'))->send(new SendPassword(request()->get('password')));

        return $this->traitStore();
    }

    protected  function handlePassword($request, $password)
    {
        $request->request->set('password', $password);

        return $request;
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'model_function',
            'function_name' => 'showFullName'
        ]);

        $this->crud->addColumn([
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email'
        ]);

        $this->crud->addColumn([
            'name' => 'role',
            'type' => 'role',
            'label' => 'Role'
        ]);
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

        CRUD::setFromDb();

        CRUD::field('role')
            ->type('select_from_array')
            ->label('User Role')
            ->options(config('user_roles'));

        $this->crud->field('position')
            ->remove();

        if (Request::route()->getName() === 'user.edit') {
            $this->crud->field('password')
                ->remove();
        }

        $this->crud->removeSaveActions([
            'save_and_back',
            'save_and_edit',
            'save_and_preview'
        ]);

        $this->crud->replaceSaveActions([
            'name' => 'save_and_new',
            'button_text' => 'Save',
            'redirect' => function ($crud, $request, $itemId) {
                return $crud->route . '/create';
            }
        ]);

        CRUD::field('password')
            ->type('text')
            ->label('')
            ->attributes([
                'style' => 'display: none;'
            ])
            ->value(Str::random(12));
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field('role')
            ->type('select_from_array')
            ->label('User Role')
            ->options(config('user_roles'));

        $this->crud->field('position')
            ->remove();

        if (Request::route()->getName() === 'user.edit') {
            $this->crud->field('password')
                ->remove();
        }

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
