<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\sitesTrait;

use App\User;
use App\Role;
use App\Permission;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function start(){

        $manageUser = new Permission;
        $manageUser->name = 'manageUser';
        $manageUser->label = 'Manage User';
        $manageUser->save();

        $manageSeries = new Permission;
        $manageSeries->name = 'manageSeries';
        $manageSeries->label = 'Manage Series';
        $manageSeries->save();

        $manageLessons = new Permission;
        $manageLessons->name = 'manageLessons';
        $manageLessons->label = 'Manage Lessons';
        $manageLessons->save();

        $manageTag = new Permission;
        $manageTag->name = 'manageTag';
        $manageTag->label = 'Manage Tag';
        $manageTag->save();

        $enroleUser = new Permission;
        $enroleUser->name = 'enroleUser';
        $enroleUser->label = 'Enrole User';
        $enroleUser->save();

        $admin = new Role;
        $admin->name = 'admin';
        $admin->label = 'Administrator';
        $admin->save();

        $screencaster = new Role;
        $screencaster->name = 'screencaster';
        $screencaster->label = 'Screencaster';
        $screencaster->save();

        $user = new Role;
        $user->name = 'user';
        $user->label = 'User';
        $user->save();


        /*

            Give permission to admin role

            manageUser, manageSeries, manageLessons, manageTag, enroleUser
        */
        $admin->givePermissionTo($manageUser);
        $admin->givePermissionTo($manageSeries);
        $admin->givePermissionTo($manageLessons);
        $admin->givePermissionTo($manageTag);
        $admin->givePermissionTo($enroleUser);

         /*

            Give permission to screencaster role

            manageSeries, manageLessons, enroleUser
        */
        $screencaster->givePermissionTo($manageSeries);
        $screencaster->givePermissionTo($manageLessons);
        $screencaster->givePermissionTo($enroleUser);


        /*-------------------------------------------
            Create a dummy user and assign admin role
        -----------------------------------------------*/
        $dummyUser = User::create([
            'name' => 'Arief Hikam',
            'email' => 'a@a.com',
            'password' => bcrypt('1234')
        ]);

        $dummyUser->assignRole('admin');
    }
}
