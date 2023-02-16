<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use DB;
use Session;
session_start();

class HomeController extends Controller
{
	public function index(){
		//Slide
		$slider = Slider::orderBy('slider_id','DESC')->where('Slider_status','1')->paginate(4)->get();
		$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		// $all_product=DB::table('tbl_product')
  //       ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
  //       ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
  //       ->orderby('tbl_product.product_id','desc')->get();
		$all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6); 
	    return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('slider',$slider);
    }
    public function search(Request $request){
    	$keywords = $request->keywords_submit;
		$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
		// $all_product=DB::table('tbl_product')
  //       ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
  //       ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
  //       ->orderby('tbl_product.product_id','desc')->get();
		$search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
	    return view('pages.product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}