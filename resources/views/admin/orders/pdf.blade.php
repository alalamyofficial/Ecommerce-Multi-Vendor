<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
</head>
<body>
    

                <span>({{$order->product_title}})</span>
                
                <!-- <br>
                <img src="product_imgs/{{$order->image}}" width="450" height="250">
                <br> -->

                <br>
                <h2>Product Description</h2> : <b>{{$order->product->description}}</b>
                <br>

                <br>
                <b>User Phone : </b>  {{$order->phone}}
                <br>

                <br>
                <b>User Email : </b>  {{$order->email}}
                <br>

                <br>
                <b>User Address : </b>  {{$order->address}}
                <br>

                <br>
                <b>User Quantity : </b>  {{$order->quantity}}
                <br>

                <br>
                <b>User Price : </b>  {{$order->price}}
                <br>

                <br>
                <b>User : </b>  {{$order->name}}
                <br>

                <br>
                <b>Payment Status : </b>  {{$order->payment_status}}
                <br>


                <br>
                <b>Delivery Status : </b>  {{$order->delivery_status}}
                <br>

                <br>
                <b>Dated : </b> {{$order->created_at->diffForHumans()}}
                <br>
</body>
</html>