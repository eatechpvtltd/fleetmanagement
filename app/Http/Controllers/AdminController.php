<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('Dashboard.index');
    }
    public function products()
    {
        $products = Product::orderby('created_at', 'desc')->get();
        return view('Dashboard.Vehicle', compact('products'));
    }
    public function AddNewProduct(Request $data)
    {
        $product = new Product();

        $product->title = $data->input('title');
        $product->price = $data->input('price');
        $product->type = $data->input('type');
        $product->quantity = $data->input('quantity');
        $product->category = $data->input('category');
        $product->description = $data->input('description');
        // return $data->file('file');
        $product->picture = $data->file('file')->getClientOriginalName();
        $data->file('file')->move('Uploads/profiles/products/', $product->picture);
        $product->save();
        return redirect()->back()->with('success', 'congrats');
    }

    public function UpdateProduct(Request $data)
    {

        $product = Product::find($data->input('id'));

        // $product->id=$data->input('id');
        if ($data->input('title')) {
            $product->title = $data->input('title');
        }

        $product->price = $data->input('price');
        $product->type = $data->input('type');
        $product->quantity = $data->input('quantity');
        $product->category = $data->input('category');
        $product->description = $data->input('description');
        if ($data->file('file') != null) {
            $product->picture = $data->file('file')->getClientOriginalName();
            $data->file('file')->move('Uploads/profiles/products/', $product->picture);
        }
        $product->save();
        return redirect()->back()->with('success', 'update successfully');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'delete successfully');
    }
}
