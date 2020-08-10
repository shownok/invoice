<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class InvoiceController extends Controller
{
    public function index()
    {
        $product= Product::all();
        return view('invoice.index')->with('product',$product);
    }
}