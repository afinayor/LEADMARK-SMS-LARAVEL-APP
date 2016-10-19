<?php

namespace leadmark\Http\Controllers;

use Illuminate\Http\Request;

use leadmark\Http\Requests;
use leadmark\Product;
use Illuminate\Http\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Form;
use Session;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function getIndex()
    {
        return view('product.index');
    }

    public function getList()
    {
        Session::put('product_search', Input::has('ok') ? Input::get('search') : (Session::has('product_search') ? Session::get('product_search') : ''));
        Session::put('product_field', Input::has('field') ? Input::get('field') : (Session::has('product_field') ? Session::get('product_field') : 'name'));
        Session::put('product_sort', Input::has('sort') ? Input::get('sort') : (Session::has('product_sort') ? Session::get('product_sort') : 'asc'));
        $products = Product::where('name', 'like', '%' . Session::get('product_search') . '%')
            ->orderBy(Session::get('product_field'), Session::get('product_sort'))->paginate(8);
        return view('product.list', ['products' => $products]);
    }

    public function getUpdate($id)
    {
        return view('product.update', ['product' => Product::find($id)]);
    }

    public function postUpdate($id)
    {
        $product = Product::find($id);
        $rules = ["unitprice" => "required|numeric"];
        if ($product->name != Input::get('name'))
            $rules += ['name' => 'required|unique:products'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $product->name = Input::get('name');
        $product->unitprice = Input::get('unitprice');
        $product->save();
        return ['url' => 'product/list'];
    }

    public function getCreate()
    {
        return view('product.create');
    }

    public function postCreate()
    {
        $validator = Validator::make(Input::all(), [
            "name" => "required|unique:products",
            "unitprice" => "required|numeric"
        ]);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $product = new Product();
        $product->name = Input::get('name');
        $product->unitprice = Input::get('unitprice');
        $product->save();
        return ['url' => 'product/list'];
    }

    public function getDelete($id)
    {
        Product::destroy($id);
        return Redirect('product/list');
    }

}
