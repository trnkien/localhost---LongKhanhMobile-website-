@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
                        @foreach($brand_name as $key => $name)
                            <h2 class="title text-center">{{$name->brand_name}}</h2>
                        @endforeach
                        @foreach($brand_by_id as $key => $product)
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                <h2>{{number_format($product->product_price,0,',','.').' đồng'}}</h2>
                                                <p>{{$product->product_name}}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                            </div>
                                    </div>
                                    {{-- <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                        </a>
                        @endforeach
</div><!--features_items-->


@endsection
