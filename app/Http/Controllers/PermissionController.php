<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;

    }
    public function index()
    {
        $permissions = $this->permission::all();

        return view("permission.index", ['permission' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.add');
    }
    public function getAllPermissions(){
        $permissions = $this->permission::all();

        return response()->json([
            'permissions' => $permissions
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',

            ]);

            Permission::create($request->all());

            DB::commit();
            return redirect()->route('permission.index')->with('success','Permissions created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('permission.add')->with('error',$th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::whereId($id)->first();

        return view('permission.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required'

            ]);

            $permission = Permission::whereId($id)->first();

            $permission->name = $request->name;

            $permission->save();


            DB::commit();
            return redirect()->route('permission.index')->with('success','Permissions updated successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('permission.edit',['permission' => $permission])->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        DB::beginTransaction();
        try {

            Permission::whereId($id)->delete();

            DB::commit();
            return redirect()->route('permission.index')->with('success','Permissions deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('permission.index')->with('error',$th->getMessage());
        }
    }
    }
