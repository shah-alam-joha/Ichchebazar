<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Invoice - {{ $order->id}}</title>
  <link rel="stylesheet" href="{{ asset('css/admin_style2.css') }}">

  <style type="text/css">

  .content-wrapper{
    background: white;
  }
  
  .invoice-header {
    background: #fdfaf5;
    padding: 10px 20px 10px 20px;
    border-bottom: 1px solid gray;
  }

  .invoice-top-right h4 {
    color: red;
    font-size: 50px;
    padding-right: 20px;
    margin-top: 20px;
    font-family: serif;
}
.invoice-top-left {
    padding-left: 20px;
    border-left: 4px #e73838 solid;
    padding-top: 10px;
}
.invoice-top-left h5{
  font-size: 40px;
  color: gray;
}

.authority h5{
margin-top: -10px;
font-size: 20px;
color: red;
padding-right: 15px;
}

.thanks h4{
  font-size: 30px;
  font-family: serif;
  font-weight: normal;
  color: red;
  padding-top: 20px;
}

.site-address p {
  line-height: 6px;
  font-weight: 300;
}
</style>

</head>
<body>

  <div class="content-wrapper">
    <div class="invoice-header">
      <div class="float-left site-logo">
        <img src="{{ asset('images/products/logo.jpg') }}" alt="" style="width:100px;">
      </div>
      <div class="float-right site-address">
        <h4>Ichche Bazar</h4>
        <p> 1/1, Road 1, Block C, Mirpur 13, Dhaka 1216</p>
        <p> Phone : <a href="">01748747564</a></p>
        <p>Email : <a href="mailto:info@ichchebazar.com">info@ichchebazar.com</a></p> 
      </div>
      <div class="clearfix"></div>
    </div>

    <div class="invoice-description">
      <div class="invoice-top-left float-left">
        <p>Invoice To</p>
        <p><h5>{{ $order->name }}</h5></p>
        
        <div class="address">
         <p><strong>Address :  </strong>{{ $order->shipping_address}}</p> 
          <p>Phone No: {{ $order->phone_no}} </p>
          <p> <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
        </div>

      </div>
      <div class="invoice-top-right float-right">
        <h4>Invoice #{{ $order->id}} </h4>
        <p>{{ $order->created_at}}</p>

      </div>
      <div class="clearfix"></div>
    </div>

<hr>
        <h3>Products</h3>

        <hr>
        @if ($order->carts->count() > 0)

        <table class="table table-bordered table-stipe">

          <thead>
            <tr>
              <th>No.</th>
              <th>Product Title</th>
              <th>Product Quantity</th>
              <th>Unit Price</th>
              <th>Sub total Price</th>

            </tr>
          </thead>

          <tbody>
            @php
            $total_price = 0;
            @endphp

            @foreach ($order->carts as $cart)
            @if ($cart->product)
            <tr>
              <td> 

                {{$loop->index + 1}}
              </td>

              <td>
                {{ $cart->product->title}}
              </td>

              <td>
                {{ $cart->product_quantity }}
              </td>

               <td>
                {{ $cart->product->price }}Tk
              </td>

              <td>
                @php
                $total_price += $cart->product->price * $cart->product_quantity;
                @endphp
                {{ $cart->product->price * $cart->product_quantity }} Tk
              </td>

            </tr>
            @else
            @endif
            @endforeach

            <tr>
              <td colspan="3"></td>
              <td >Discount :</td>

              <td colspan="2" >
                {{ $order->custom_discount }} Tk
              </td>
            </tr> 

            <tr>
              <td colspan="3"></td>
              <td >Shipping Charge :</td>

              <td colspan="2" >
                {{ $order->shipping_charge }} Tk
              </td>
            </tr> 

             <tr>
              <td colspan="3"></td>
              <td >Total amount :</td>

              <td colspan="2" >
                {{ $total_price + $order->shipping_charge - $order->custom_discount }} Tk
              </td>
            </tr>

          </tbody>

        </table>
        @endif

          <div class="thanks">
            <h4>Thank you for your business !! </h4>
          </div>

          <div class="authority float-right mt-1">
            <p>--------------------------------------</p>
            <h5>Authority Signature</h5>
          </div>

          <div class="clearfix"></div>

        <hr>

     
    </div>
  </div>

</body>
</html>