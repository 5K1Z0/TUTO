<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request){

    	if($request->isMethod('post')){
    		$data = $request->all();

    		$category = new Category;
    		$category->name = $data['name'];
    		$category->description = $data['description'];
    		$category->url = $data['url'];
    		$category->save();
            return redirect('/admin/view-category')->with('flash_message_success', 'Catégorie créée avec succés');
    	}

        $levels = Category::where(['parent_id' => 0])->get();

    	return view('admin.categories.add_category')->with(compact('levels'));
    }


    public function editCategory(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die; //debug

            Category::where(['id'=>$id])->update(['name'=>$data['name'], 'description'=>$data['description'], 'url'=>$data['url']]);
            return redirect('/admin/view-category')->with('flash_message_success', 'La catégorie a été mise à jour.');
        }

        $categorie = Category::where(['id' => $id])->first();

        return view('admin.categories.edit_category')->with(compact('categorie'));
    }


    public function viewCategory(){

        $categories = Category::get(); //Récupére toutes les catégories.
        $categories = json_decode(json_encode($categories)); 

        //echo "<pre>"; print_r($categories); die; //Debug

    	return view('admin.categories.view_category')->with(compact('categories'));
    }

    public function deleteCategory($id){
        if(!empty($id)){
            Category::where(['id' => $id])->delete();

            return redirect()->back()->with('flash-message_success', 'La catégorie a été supprimé.');
        }
    }


}
