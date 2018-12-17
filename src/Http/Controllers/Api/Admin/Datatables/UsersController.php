<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin\DataTables;


use App\User;
use function config;
use DesignByCode\Realtor\Mail\Users\UserInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


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
     * @var bool
     */
    protected $allowDeletion = true;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $editPath = '/xscd/';

    /**
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function builder()
    {
        return User::query();
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {


        $request->validate([
           'name' => 'required|string',
           'email' => 'required|email|unique:users,email'
        ]);

        $password = $this->randomPassword();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password)
        ]);

        Mail::to($user->email)->queue(new UserInvite($user, $password));
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
     * @return array
     */
    public function getFormFieldTypes()
    {
        return ['name' => 'text', 'email' => 'text'];
    }

    /**
     * @return string
     */
    public function createCustomHTML()
    {
        return '<blockquote class="blockquote blockquote--info">
                <div class="blockquote__header">The Agent will receive and email with a random generated password</div>
                <div class="blockquote__body">The agent will be can change there password in there profile.</div>
             </blockquote>';

    }

    /**
     * @return string
     */
    protected function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


}
