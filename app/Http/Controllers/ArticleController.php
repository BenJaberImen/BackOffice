<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

        return view('articles.index')->with('articles',$articles);
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
        if($request->hasFile("cover")){
        $file=$request->file("cover");
        $imageName=time().'_'.$file->getClientOriginalName();
        $file->move(\public_path("cover/"),$imageName);


        $article =[
            "libille" =>$request->libille,
            "description" =>$request->description,
            "prix_intial" =>$request->prix_intial,
            "cover" =>$imageName,
            'categorie_id'=> $request->categorie_id,
        ];
        DB::table('articles')->insert($article);
        $article_id = DB::getPdo()->lastInsertId();
       //Article::create($article);
    }
    if($request->hasFile("images")){
        $files=$request->file("images");

        foreach($files as $file){
            $imageName=time().'_'.$file->getClientOriginalName();
            $request['article_id']=$article_id;
            $request['image']=$imageName;
            $file->move(\public_path("/images"),$imageName);
            //Image::create($request->all());
            $image=['image'=>$imageName,'article_id'=>$article_id,'created_at'=>new \DateTime(),'updated_at'=>new \DateTime()];
            DB::table('images')->insert($image);

        }
    }
    return redirect()->route('articles.index')
    ->with('success','Product updated successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article=Article::find($id);
        if(!$article) abort(404);
        $images=$article->image;
        return view('articles.show',compact('article','images'));

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
    {/*
        $article=Article::findOrFail($id);

        if($request->hasFile("cover")){
            if (File::exists("cover/".$article->cover)) {
                File::delete("cover/".$article->cover);
            }
            $file=$request->file("cover");
            $article->cover=time()."_".$file->getClientOriginalName();
            $file->move(\public_path("/cover"),$article->cover);
            $request['cover']=$article->cover;


        $article =([
            "libille" =>$request->libille,
            "description" =>$request->description,
            "prix_intial" =>$request->prix_intial,
            "cover" =>$article->cover,
            'categorie_id'=> $request->categorie_id,
        ]);
        DB::table('articles')->insert($article);

    }
    $article_id = DB::getPdo()->lastInsertId();
        if($request->hasFile("images")){
            $files=$request->file("images");

            foreach($files as $file){
                $imageName=time().'_'.$file->getClientOriginalName();
                $request['article_id']=$article_id;
                $request['image']=$imageName;
                $file->move(\public_path("/images"),$imageName);
                //Image::create($request->all());
                $image=['image'=>$imageName,'article_id'=>$article_id,'created_at'=>new \DateTime(),'updated_at'=>new \DateTime()];
                DB::table('images')->insert($image);

            }

        }

           return redirect()->route('articles.index')
           ->with('success','Post updated successfully');
    */

    $article=Article::findOrFail($id);
    if($request->hasFile("cover")){
        if (File::exists("cover/".$article->cover)) {
            File::delete("cover/".$article->cover);
        }
        $file=$request->file("cover");
        $article->cover=time()."_".$file->getClientOriginalName();
        $file->move(\public_path("/cover"),$article->cover);
        $request['cover']=$article->cover;
    }

       $article->update([
        "libille" =>$request->libille,
        "description" =>$request->description,
        "prix_intial" =>$request->prix_intial,
        "cover" =>$article->cover,
        'categorie_id'=> $request->categorie_id,
       ]);

       if($request->hasFile("images")){
           $files=$request->file("images");
           foreach($files as $file){
               $imageName=time().'_'.$file->getClientOriginalName();
               $request["article_id"]=$id;
               $request["image"]=$imageName;
               $file->move(\public_path("images"),$imageName);
               Image::create($request->all());

           }
       }
       return redirect()->route('articles.index')
       ->with('success','Post updated successfully');}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    //list image
public function images($id){

  //
}
    public function destroy($id)
    {
        $article=Article::findOrFail($id);

         if (File::exists("cover/".$article->cover)) {
             File::delete("cover/".$article->cover);
         }
         $images=Image::where("article_id",$article->id)->get();
         foreach($images as $image){
         if (File::exists("images/".$image->image)) {
            File::delete("images/".$image->image);
        }
         }
         $article->delete();
         return back();
    }
    public function deleteimage($id){
        $images=Image::findOrFail($id);

        if (File::exists("images/".$images->image)) {
           File::delete("images/".$images->image);
       }

       Image::find($id)->delete();
       return back();
   }

   public function deletecover($id){
    $cover=Article::findOrFail($id)->cover;
    if (File::exists("cover/".$cover)) {
       File::delete("cover/".$cover);
   }
   return back();
}


}
