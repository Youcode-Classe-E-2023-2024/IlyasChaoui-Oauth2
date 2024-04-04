<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/permissions",
     *     summary="Permissions data",
     *     tags={"Permissions"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="criteria",
     *         in="query",
     *         description="Some optional other parameter",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function addPermission(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role_id' => 'required|integer',
        ]);

        $permission = new Permission;
        $permission->name = $request->name;
        $permission->role_id = $request->role_id;
        $permission->save();

        return response()->json(['message' => 'Permission added successfully', 'role' => $permission], 201);
    }


    /**
     * @OA\DELETE(
     *     path="/api/permissions/{id}",
     *     summary="Delete permissions",
     *     tags={"Permissions"},
     *     @OA\Parameter(
     *         name="delete Permission",
     *         in="query",
     *         description="as admin, i can delete permissions",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="criteria",
     *         in="query",
     *         description="Some optional other parameter",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        if (!$permission) {
            return response()->json(['message' => 'permission not found'], 404);
        }

        return response()->json(['message' => 'permission deleted successfully'], 200);
    }

    /**
     * @OA\GET(
     *     path="/api/permissions",
     *     summary="Read Permissions",
     *     tags={"Permissions"},
     *     @OA\Parameter(
     *         name="read permissions",
     *         in="query",
     *         description="en tant qu'admin, je peux afficher les permissions",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="criteria",
     *         in="query",
     *         description="Some optional other parameter",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function showPermissions()
    {
        $permissions = Permission::all();
        return response()->json(['message' => 'List of Permissions', 'permissions' => $permissions], 200);
    }

    /**
     * @OA\PUT(
     *     path="/api/permissions/{id}",
     *     summary="Update permissions",
     *     tags={"Permissions"},
     *     @OA\Parameter(
     *         name="update permissions",
     *         in="query",
     *         description="en tant qu'admin, je peux editer les permissions",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="criteria",
     *         in="query",
     *         description="Some optional other parameter",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['message' => 'permission not found'], 404);
        }

        $permission->name = $request->name;
        $permission->save();

        return response()->json(['message' => 'Permission updated successfully', 'permission' => $permission], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
