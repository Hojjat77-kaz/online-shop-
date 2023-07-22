<?php

use App\Models\City;
use App\Models\Province;
use Carbon\Carbon;

function generateFileName($name)
{
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $day = Carbon::now()->day;
    $hour = Carbon::now()->hour;
    $minute = Carbon::now()->minute;
    $second = Carbon::now()->second;
    $microsecond = Carbon::now()->microsecond;
    return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' .$name;
}

function convertShamsiToGregorianDate($date)
{
    if($date == null){
        return null;
    }

     $shamsiDateSplit = Verta::parse($date)->datetime();
    return $shamsiDateSplit;
}

function cartTotalSaleAmount()
{
    $cartTotalSaleAmount = 0;
    foreach (\Cart::getContent() as $item) {
        if ($item->attributes->is_sale) {
            $cartTotalSaleAmount += $item->quantity * ($item->attributes->price - $item->attributes->sale_price);
        }
    }

    return $cartTotalSaleAmount;
}

function cartTotalDeliveryAmount()
{
    $cartTotalDeliveryAmount = 0;
    foreach (\Cart::getContent() as $item) {
        $cartTotalDeliveryAmount += $item->associatedModel->delivery_amount;
    }

    return $cartTotalDeliveryAmount;
}

function province_name($provinceId)
{
    return Province::findOrFail($provinceId)->name;
}

function city_name($cityId)
{
    return City::findOrFail($cityId)->name;
}
function cartTotalAmount()
{
    if (session()->has('coupon')) {
        if( session()->get('coupon.amount') > (\Cart::getTotal() + cartTotalDeliveryAmount()) )
        {
            return 0;
        }else{
            return (\Cart::getTotal() + cartTotalDeliveryAmount()) - session()->get('coupon.amount');
        }
    } else {
        return \Cart::getTotal() + cartTotalDeliveryAmount();
    }
}



