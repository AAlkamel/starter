<?php

namespace App\Http\Controllers;

use App\Models\Offer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class OfferController extends Controller
{


    public function __construct()
    {

    }

    public function getOffers(){
       return Offer::get();
    }
//    public function store(){
//        Offer::create([
//            'price'=>'300',
//            'name'=>'car',
//            'details'=>'the first car'
//        ]);
//    }
    public function create(){
        return View('offer.offerCreate');
    }
    public function store(Request $request){

        $rules=[
            'name'=>'required|max:10|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required'
        ];

        $messages=[
            'name.required'=>"الأسم مطلوب "
        ];

        $validator =Validator::make($request->all(),$rules,$messages);
        if($validator -> fails()){
            return redirect()->back()->withInputs($request->all())->withErrors($validator);
        }
        Offer::create([
            'name'=>$request -> name,
            'price'=>$request -> price,
            'details'=>$request -> details,
        ]);

        return redirect()->back()->with(['success'=>'تم الإضافة بنجاح']);

    }
}
