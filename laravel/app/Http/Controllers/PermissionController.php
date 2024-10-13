<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

class PermissionController extends Controller
{
    //
    public function index()
    {
        //
        $datarole = Permission::get();
        // dd($datarole);
        $hasUpdatePermission = Permission::where('role', Auth::user()->role)
            ->where('view', 'permission')
            ->where('update', 1)
            ->exists();
        return view('auth.permission', ['userRole' => Auth::user()->role], ['hasUpdatePermission' => $hasUpdatePermission]);
    }


    public function getpermissionList(Request $request)
    {

        $datapermission = Permission::get();
        return response()->json(
            array(
                'status' => 'ok',
                'data' => $datapermission
            ),
            200
        );
    }

    public function changepermission(Request $request)
    {
        //
        $id = $request->get('id');
        $data = Permission::find($id);
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => view('auth.changepermission', compact('data'))->render() //untuk modal data dan view diambil dari sini
            ),
            200
        );
    }
    public function actionChangePermission(Request $request)
    {
        $id = $request->get('id');
        $create = $request->get('create');
        $read = $request->get('read');
        $update = $request->get('update');
        $delete = $request->get('delete');

        $permission = Permission::find($id);

        if ($permission) {
            $permission->update([
                'create' => $create,
                'read' => $read,
                'update' => $update,
                'delete' => $delete,
            ]);

            return response()->json(['status' => 'ok', 'msg' => 'Permissions updated successfully!']);
        }

        return response()->json(['status' => 'error', 'msg' => 'Permission not found.']);
    }
}
