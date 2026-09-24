<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Mail, Route};

use App\Mail\Contact;
use App\Models\Product;

Route::get('/', function () {
    return view('index');
});

Route::get('/products', function () {
    $products = Product::all();
    return view('products', compact('products'));
});

Route::get('/products/{product}', function (Product $product) {
    return view('product', compact('product'));
});

Route::get('/contact', function (){
    return view('contact');
});

Route::post('/contact', function(Request $request) {
    Mail::send(new Contact($request->input('email'), $request->input('subject'), $request->input('message')));
    return redirect('/contact')->with('status', 'Email sent!');
});
