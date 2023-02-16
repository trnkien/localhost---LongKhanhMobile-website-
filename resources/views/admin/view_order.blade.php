@extends('admin_layout')
@section('admin_content')        

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>
    
    <div class="table-responsive">
      <?php
          $message = Session::get('message');
            if($message){
              echo '<span class="text-alert">'.$message.'</span>';
              Session::put('message',null);
                                    }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
            
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    
    <div class="table-responsive">
      <?php
          $message = Session::get('message');
            if($message){
              echo '<span class="text-alert">'.$message.'</span>';
              Session::put('message',null);
                                    }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_note}}</td>
            <td>@if($shipping->shipping_method==0) Chuyển khoản @else Tiền mặt @endif</td>
          </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Quản lý chi tiết đơn hàng
    </div>
    <div class="table-responsive">
      <?php
          $message = Session::get('message');
            if($message){
              echo '<span class="text-alert">'.$message.'</span>';
              Session::put('message',null);
                                    }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Số thự tự</th>
            <th>Tên sản phẩm</th>
            <th>Mã giảm giá</th>
            <th>Phí ship</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          $total = 0;
          @endphp
          @foreach($order_details as $key => $details)
            @php 
            $i++;
            $subtotal = $details->product_price*$details->product_sales_quantity;
            $total += $subtotal;
            @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{$details->product_name}}</td>
              <td>
                @if($details->product_coupon != 'no')
                  {{$details->product_coupon}}
                @else
                  Không có mã giảm giá
                @endif
              </td>
              <td>{{number_format($details->product_feeship,0,',','.')}}đ</td>
              <td>{{$details->product_sales_quantity}}</td>
              <td>{{number_format($details->product_price,0,',','.')}}đ</td>
              <td>{{number_format($subtotal,0,',','.')}}đ</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="2"> 
                @php
                    $total_coupon = 0;
                @endphp
                @if($coupon_condition ==1)
                  @php
                    $total_after_coupon = ($total*$coupon_number)/100;
                    echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.').'đ'; 
                    $total_coupon = $total - $total_after_coupon;
                  @endphp
                @else
                  @php
                    echo 'Tổng giảm: '.number_format($coupon_number,0,',','.').'đ'; 
                    $total_coupon = $total - $coupon_number;
                  @endphp
                @endif
                <br>
                Phí ship: {{number_format($details->product_feeship,0,',','.')}}đ
                <br>
                @php
                  $total_coupon += $details->product_feeship;
                @endphp
                Thanh toán: {{number_format($total_coupon,0,',','.')}}đ
            </td>
          </tr>
        </tbody>
      </table>
      <a target="blank" href = "{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
    </div>
    <footer class="panel-footer">
    </footer>
  </div>
</div>
@endsection