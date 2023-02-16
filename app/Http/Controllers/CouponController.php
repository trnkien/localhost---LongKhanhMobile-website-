<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    public function insert_coupon(){
    	return view('admin.coupon.insert_coupon');
    }
    public function unset_coupon(){
    	$coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');     
            return redirect()->back()->with('message',"Đã xoá mã giảm giá");
        }
    }
    public function delete_coupon($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
    	Session::put('message','Xoá mã giảm giá sản phẩm thành công');
    	return Redirect::to('list-coupon');
;    }
    public function list_coupon(){
    	$coupon = Coupon::orderby('coupon_id','DESC')->get();
    	return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
    public function insert_coupon_code(Request $request){
    	$data = $request->all();
    	$coupon = new Coupon;

    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_number = $data['coupon_number'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_time = $data['coupon_time'];
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->save();

    	Session::put('message','Thêm mã giảm giá thành công');
    	return Redirect::to('insert-coupon');
    }
}
