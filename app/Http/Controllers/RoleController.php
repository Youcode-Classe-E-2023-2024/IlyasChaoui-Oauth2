<?php

namespace App\Http\Controllers;

use App\Models\Role;

use Illuminate\Http\Request;

class roleController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/roles",
     *     summary="Roles data",
     *     tags={"Roles"},
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
    public function addRole(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->save();

        return response()->json(['message' => 'Role added successfully', 'role' => $role], 201);
    }

    /**
     * @OA\DELETE(
     *     path="/api/roles/{id}",
     *     summary="Delete roles",
     *     tags={"Roles"},
     *     @OA\Parameter(
     *         name="delete roles",
     *         in="query",
     *         description="as admin, i can delete roles",
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
    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();

        if (!$role) {
            return response()->json(['message' => 'role not found'], 404);
        }

        return response()->json(['message' => 'role deleted successfully'], 200);
    }

    /**
     * @OA\GET(
     *     path="/api/roles",
     *     summary="Read roles",
     *     tags={"Roles"},
     *     @OA\Parameter(
     *         name="read roles",
     *         in="query",
     *         description="en tant qu'admin, je peux afficher les roles",
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
    public function showRoles()
    {
        $roles = Role::all();
        return response()->json(['message' => 'List of Roles', 'roles' => $roles], 200);
    }

    /**
     * @OA\PUT(
     *     path="/api/roles/{id}",
     *     summary="Update roles",
     *     tags={"Roles"},
     *     @OA\Parameter(
     *         name="update roles",
     *         in="query",
     *         description="en tant qu'admin, je peux editer les roles",
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
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->name = $request->name;
        $role->save();

        return response()->json(['message' => 'Role updated successfully', 'role' => $role], 200);
    }
}
