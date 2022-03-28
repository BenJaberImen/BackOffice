<?php

namespace App\Http\Controllers;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

    }
    public function index()
    {
        $configs = $this->config::all();

        return view("configs.index", ['configs' => $configs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configs.create');
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
        // $this->authorize('create', Role::class);
         try {

             $request->validate([
                 'tag' => 'required',
                 'valeur' => 'required',
                 'description' => 'required',
             ]);

             Config::create($request->all());

             DB::commit();
             return redirect()->route('configs.index')->with('success','Configs created successfully.');
         } catch (\Throwable $th) {
             DB::rollback();
             return redirect()->route('configs.add')->with('error',$th->getMessage());
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = Config::whereId($id)->first();

        return view('configs.edit', ['config' => $config]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $config = Config::whereId($id)->first();

        return view('configs.edit', ['config' => $config]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'tag' => 'required',
                'valeur' => 'required',
                'description' => 'required',

            ]);

            $config = Config::whereId($id)->first();

            $config->tag = $request->tag;
            $config->valeur = $request->valeur;
            $config->description = $request->description;
            $config->save();


            DB::commit();
            return redirect()->route('configs.index')->with('success','Role updated successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('configs.edit',['config' => $config])->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Config::whereId($id)->delete();

            DB::commit();
            return redirect()->route('configs.index')->with('success','Permissions deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('configs.index')->with('error',$th->getMessage());
        }
    }
}
