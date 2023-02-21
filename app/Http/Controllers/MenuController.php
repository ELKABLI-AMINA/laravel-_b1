<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Str;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    { 
        $plats=Menu::latest()->paginate(8);
       
        return view('home')->with([
            'plats'=>$plats
           
        ]);
     
    }
    public function show($slug)
    {
        $plat = Menu::where('slug',$slug)->first();

        return view('show')->with([
            'plat'=>$plat
        ]);
    }



    public function create(){ //pour afficher la form
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:3|max:10',
            'body'=>'required|min:3|max:100',
            'prix'=>'required|min:1|max:100',
            'image' =>'required|image|mimes:png,jpg,jpeg|max:2048'
        ]
    );
        if($request->has('image')){
            $file=$request->image;
            $image_name =time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $image_name);
        }
    

      Menu::create([
        'title' =>$request->title,
        'body'  =>$request->body,
        'Prix'  =>$request->prix,
        'slug'  => Str::slug($request->title),
        'image' =>$image_name
      ]);
       return redirect()->route('home')->with([
             'success'=>'Plat ajouté '
    ]);
    }


    public function edit($slug){
        $plat = Menu::where('slug',$slug)->first();
        return view('edit')->with([
                'plat'=>$plat
        ]);
    }

    public function update( Request $request, $slug)

    {
        
        $request->validate([
            'title' =>'required|min:3|max:10',
            'body'  =>'required|min:3|max:100',
        ]);
       
        $plat = Menu::where('slug',$slug)->first();
        if($request->has('image')){
            $file=$request->image;
            $image_name =time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $image_name);
            // unlink(public_path('uploads/'). $plat->image);
            $plat->image = $image_name;
        }
        $plat->update([
            'title' =>$request->title,
            'body'  =>$request->body,
            'prix'  =>$request->prix,
            'slug'  => Str::slug($request->title),
            'image' =>$plat->image
        ]) ;
        return redirect()->route('home')->with([
            'success'=>'Plat Modifié '
        ]);
        
    }
    public function delete($slug){
        $plat = Menu::where('slug',$slug)->first();
        unlink(public_path('uploads/'). $plat->image);
        $plat->delete();
        return redirect()->route('home')->with([
            'success'=>'Plat Supprimé '
        ]);
    }
 
}
