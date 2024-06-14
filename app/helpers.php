<?php

function dateFormate($date=null){
	$value='';
	if ($date) {
		$value=date('M d Y', strtotime($date));
	}
	return $value;
}

function getImage($folder=null,$value=null){

	$url = asset('images/no_found.png');
	$path = public_path($folder.'/'.$value);
	if (!empty($folder) && (!empty($value))) {
		if(file_exists($path)){
			$url = asset($folder.'/'.$value);
		}
	}
	return $url;
}

function deleteImage($folder=null, $file=null){

    if (!empty($folder) && !empty($file)) {
        $path = public_path($folder.'/'.$file);
        $isExists = file_exists($path);
        if ($isExists) {
            unlink($path);
        }
    }
    return true;
}


function priceFormate($amount=0){
    
    return '৳'.number_format($amount,0);
    
}

function getRole(){

	return auth()->user()->roles->pluck('name')[0] ??'';
}


function getTotalCart(){

	return count(session()->get('cart',[]));
}

function getProductInfo($product){


	$price=($product->after_discount  > 0) ? $product->after_discount : $product->sell_price;
	$discount_amount=$product->dicount_amount;
	
// 	$old_price=($product->after_discount > 0) ? $product->sell_price : $product->regular_price;
	$old_price=$product->sell_price;

	return ['price'=>$price,'discount_amount'=>$discount_amount,'old_price'=>$old_price];
}

function getSectionLists(){

	return ['0'=>'None','1'=>'Trending','2'=>'Hot Deals','3'=>'Recommended','4'=>'Top Brand'];

}

function getOrderStatus($type=""){

	if($type != "")
    {
     return [''=> 'All', 'pending'=>'Pending','processing'=>'Processing','on_the_way'=>'On The Way','on_hold'=>'On Hold','complete'=>'Complete','cancell'=>'Cancelled']; 
    }
  
  	return ['pending'=>'Pending','processing'=>'Processing','on_the_way'=>'On The Way','on_hold'=>'On Hold','complete'=>'Complete','cancell'=>'Cancelled'];

}

function getOrderMethod(){
	return ['cash'=>'Cash','Card'=>'Card'];
}

function SendSms($number=null,$message=null){
  	$data =[
            'apikey' => 'fa1417caaf958cbc',
            'secretkey' => '71fe721b',
            'callerID' => '1234',
            'toUser' => $number,
            'messageContent' => $message
    ];
    $query = http_build_query($data);
    $url = "http://217.172.190.215/sendtext?$query";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $done =  curl_exec($ch);
  //  dd($done);
    
    
    curl_close($ch);
    return $done;
    
}


function getPageName(){

	return ['about'=>'About Us','return-policy'=>'Return Policy','privacy-policy'=>'Privacy Policy','term'=>'Term And Condition'];

}


function getCouponDiscount(){
    $coupon=session()->get('coupon_discount');
  	$type=session()->get('discount_type');
  
  	
    
    $cart = session()->get('cart');
    $total=0;
    $amount=0;
    
    if($cart){
        foreach($cart as $id=>$item){
            $total +=$item['price'] * $item['quantity'];
        }
    }
  
  	if($type=='fixed'){
    	$amount=$coupon;
  	}else{
      	$amount=(($total*$coupon)/ 100);
    }
    
    if(($total >0) and ($coupon)){
        $amount=$amount;
    }
    
	return round($amount);
}

function full_name($user)
{
    if($user)
    {
        return $user->first_name.' '.$user->last_name;
    }
    
    return '';
}

function BanglaText($index)
{      
  $bangla_text = array(
    "cust_info"             =>"কাস্টমার ইনফরমেশন",
    "instruction"           =>"অর্ডার কনফার্ম করতে আপনার নাম, ঠিকানা, মোবাইল নাম্বার লিখে অর্ডার কনফার্ম করুন বাটনে ক্লিক করুন",
    "name"                  => "আপনার নাম",
    "placeholder_name"      => "আপনার নাম লিখুন",
    "mobile"                => "আপনার মোবাইল নাম্বার",
    "placeholder_mobile"    => "আপনার মোবাইল নাম্বার লিখুন",
    "address"               => "আপনার সম্পূর্ণ ঠিকানা",
    "placeholder_address"   => "বাসা নাম্বার, রোড নাম্বার, থানা, জেলা",
    "delivery_zone"         => "ডেলিভারি এলাকা নির্বাচন করুন",
    "confirm_order"         => "অর্ডার কনফার্ম করুন",
    "alert"                 => "* ১০০% শিউর হয়ে অর্ডার করুন, অহেতুক অর্ডার করবেন না ।",
    "order_information"     => "অর্ডার ইনফরমেশন",
    "order"                 => "অর্ডার করুন",
    "cart"                  => "কার্টে রাখুন",
    "land_instruction"      => "অর্ডার করতে নিচের ফর্মটি সঠিক তথ্য দিয়ে পূরন করুন"
    );
  return $bangla_text[$index]; 
}

