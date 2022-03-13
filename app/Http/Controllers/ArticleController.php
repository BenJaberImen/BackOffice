<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::all();
        
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::get();

        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        { $request->validate([
            'libille' => 'required',
            'description' => 'required',
            'prix_intial'=> 'required',
            'categorie_id' =>'required',
        ]);
        try {
            DB::beginTransaction();
           

            $create_article = Article::create([
                'libille' => $request->libille,
                'description' => $request->description,
                'prix_intial' => $request->prix_intial,
                'categorie_id' =>$request->categorie_id,
               
            ]);

            if(!$create_article){
                DB::rollBack();

                return back()->with('error', 'Something went wrong while saving user data');
            }

            DB::commit();
            return redirect()->route('articles.index')->with('success', 'User Stored Successfully.');


        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;

        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article =  Article::whereId($id)->first();
        $categories = Categorie::get();


        if(!$article){
            return back()->with('error', 'User Not Found');
        }
        return view('articles.edit',compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'libille' => 'required',
            'description' => 'required',
            'prix_intial'=> 'required',
            'categorie_id' =>'required'
        ]);
       
        try {
            DB::beginTransaction();
            // Logic For Save User Data

            $update_article = Article::where('id', $id)->update([
                'libille' => $request->libille,
                'description' => $request->description,
                'prix_intial' => $request->prix_intial,
                'categorie_id'=> $request->categorie_id
            ]);

            if(!$update_article){
                DB::rollBack();

                return back()->with('error', 'Something went wrong while update user data');
            }

            DB::commit();
            return redirect()->route('articles.index')->with('success', 'User Updated Successfully.');


        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $delete_article = Article::whereId($id)->delete();
            //up date champ

            if(!$delete_article){
                DB::rollBack();
                return back()->with('error', 'There is an error while deleting user.');
            }

            DB::commit();
            return redirect()->route('articles.index')->with('success', 'User Deleted successfully.');



        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
