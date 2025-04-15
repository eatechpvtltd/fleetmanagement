<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
class MainController extends Controller
{

   public function index(){
    $allProducts=Product::all();
    $newArrival=Product::where('type','new-arrivals')->get();
    $hotSale=Product::where('type','sale')->get();

    
     return view('index',compact('allProducts','newArrival','hotSale'));
   }
   public function cart(){
    return view('cart');
   }
   public function checkout(){
    return view('checkout');
   }
   public function shop(){
    return view('shop');
   }
   public function singleproduct(){
    return view('singleproduct');
   }
   public function register(){
    return view('register');
   }
   public function login(){
    return view('login');
   }
   public function loginUser(request $data){
      $users=User::where('email',$data->input('email'))->where('password',$data->input('password'))->first();
      if($users){
         session()->put('id',$users->id);
         session()->put('type',$users->type);
         if($users->type=='Customer')
         return redirect ('/');
      }
      // else if($users->type=='Admin'){
      //   return redirect('/admin');   
      // }
      else{
        return redirect ('login')->with('error','Email/password is incorrect');
      }
    
   }

   public function logout(){
    session()->forget('id');
    session()->forget('type');

    return view('login');
   }
   
   
   public function registerUser(Request $data){
    $newUser=new User();

    $newUser->fullname=$data->input('fullname');
    $newUser->email=$data->input('email');
    $newUser->password=$data->input('password');
    $newUser->picture=$data->file('picture')->getClientOriginalName();
   $data->file('picture')->move('Uploads/profiles/',$newUser->picture);
   $newUser->type = "Customer";
  if($newUser->save()){
    return redirect ('login')->with('success','Congrats your acount is ready');
  }

    
  }
}
