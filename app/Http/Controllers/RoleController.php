<?php

namespace App\Http\Controllers;

use PDF;
use Excel;
use App\Models\Role;
use App\Models\User;
use App\Exports\RolesExport;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RoleController extends Controller
{

    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'edit' => 'Edit Form',
        'excel' => 'Export Excel',
        'pdf' => 'Export PDF',
        'saveRole' => 'Save Role with Permissions',
    ];

    public function index()
    {
        try{
            $roles = Role::get();
            return view('backend.roles.index', [
            'roles' => $roles
        ]);
        }catch(QueryException $e){
            echo $e->getMessage();
        }
    }

    public function create()
    {
        return view('backend.roles.create');
    }

    public function store(Request $request)
    {
        try{
            $role = Role::create($request->all());

            return redirect()->route('roles.index')->withMessage('Successful create :)');
        }catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit(Role $role)
    {
        return view('backend.roles.edit',compact('role'));
    }

    public function update(Request $request, $id)
    {
        try{
            $role = Role::find($id);

            $role->update($request->all());

            return redirect()->route('roles.index')->withMessage('Successful update :)');
        }catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Role $role)
    {
        return view('backend.roles.show',compact('role'));
    }

    public function destroy($id)
    {
        try{
            $role = Role::find($id);

            $role->delete();

            return redirect()->route('roles.index')->withMessage('Successful delete :)');
        }catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function excel()
    {
        return Excel::download(new RolesExport, 'roles.xlsx');
    }

    public function pdf(Role $role)
    {
        $pdf = PDF::loadView('backend.roles.pdf', compact('role'));
        return $pdf->download('roles.pdf');
    }

    public function saveRole(Request $request)
    {
        $roleName = $request->input('roleName');
        $permissions = $request->input('permissions');

        DB::beginTransaction();
        try {
            $roleId = DB::table('roles')->insertGetId([
                'name' => $roleName
            ]);

            foreach ($permissions as $permissionName) {
                $permission = DB::table('permissions')->where('name', $permissionName)->first();
                if ($permission) {
                    DB::table('role_permissions')->insert([
                        'role_id' => $roleId,
                        'permission_id' => $permission->id
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
