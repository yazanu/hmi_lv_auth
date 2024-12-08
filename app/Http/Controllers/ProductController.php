<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Branch;
use Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::allows('isAdmin') || Gate::allows('isManager')){
            $branches = Branch::all();
            return view('product.create', compact('branches'));
        }else {
            abort(401, 'Unauthorized');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Gate::allows('isAdmin') || Gate::allows('isManager')){
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'qty' => 'required',
                'description' => 'required',
            ]);
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'qty' => $request->qty,
                'branch_id' => $request->branch_id,
                'description' => $request->description,
            ]);
    
            return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
        }else{
            abort(401, 'Unauthorized');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $this->authorize('view', $product);
        
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Gate::allows('isAdmin') || Gate::allows('isManager')){
            $branches = Branch::all();
            $product = Product::find($id);
            return view('product.edit',compact('product', 'branches'));
        }else {
            abort(401, 'Unauthorized');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Gate::allows('isAdmin') || Gate::allows('isManager')){
            $product = Product::find($id);
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'qty' => 'required',
                'description' => 'required',
            ]);
          
            $product->update($request->all());
          
            return redirect()->route('products.index')
                            ->with('success','Product updated successfully');
        }else {
            
            abort(401, 'Unauthorized');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Gate::allows('isAdmin')){
            $product = Product::find($id);
            $product->delete();
           
            return redirect()->route('products.index')
                            ->with('success','Product deleted successfully');
        }else {
            abort(401, 'Unauthorized');
        }
        
    }
}
