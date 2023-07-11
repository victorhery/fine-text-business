<?php

namespace App\Http\Controllers;

use App\Models\personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Product::select('id','nom', 'prenom','email', 'compte','choisis_portef', 'adress_portef', 'lieu','image')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required',
            'compte'=>'required',
            'choisis_portef'=>'required',
            'adress_portef'=>'required',
            'lieu'=>'required',
            'image'=>'required|image'
        ]);

        try{
            $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('personne/image', $request->image,$imageName);
            Product::create($request->post()+['image'=>$imageName]);

            return response()->json([
                'message'=>'Votre renseignement bien enregistré!!'
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Désolée repète encore!!'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(personne $personne)
    {
        //
        return response()->json([
            'personne'=>$personne
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(personne $personne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, personne $personne)
    {
        //
        /*$request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'nullable'
        ]);

        try{

            $product->fill($request->post())->update();

            if($request->hasFile('image')){

                // remove old image
                if($product->image){
                    $exists = Storage::disk('public')->exists("product/image/{$product->image}");
                    if($exists){
                        Storage::disk('public')->delete("product/image/{$product->image}");
                    }
                }

                $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('product/image', $request->image,$imageName);
                $product->image = $imageName;
                $product->save();
            }

            return response()->json([
                'message'=>'Product Updated Successfully!!'
            ]);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while updating a product!!'
            ],500);
        }
    */

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(personne $personne)
    {
        //
        try {

            if($personne->image){
                $exists = Storage::disk('public')->exists("personne/image/{$personne->image}");
                if($exists){
                    Storage::disk('public')->delete("personne/image/{$personne->image}");
                }
            }

            $personne->delete();

            return response()->json([
                'message'=>'leur renseignement bien supprimer!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'suppression incorrect!!'
            ]);
        }
    }

   
}
