<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add(Request $request){
        $request->validate([
           'product_id' => 'required',
           'qtybutton' => 'required'
        ]);

        $product = Product::findOrFail($request->product_id);
        $productVariation = ProductVariation::findOrFail(json_decode($request->variation)->id);


        if($request->qtybutton > $productVariation->quantity){
            alert()->error('دقت کنید','تعداد وارد شده صحیح نمی باشد');
            return redirect()->back();
        }

        $rowId = $product->id. '-' . $productVariation->id;

        if(\Cart::get($rowId) === null){
            \Cart::add(array(
                'id' => $rowId,
                'name' => $product->name,
                'price' => $productVariation->is_sale ? $productVariation->sale_price : $productVariation->price,
                'quantity' => $request->qtybutton,
                'attributes' => $productVariation->toArray(),
                'associatedModel' => $product,
            ));
        }else{
            alert()->warning('به سبد خرید مراجه کنید', 'محصول مورد نظر قبلا به لیست شما اضافه گردیده است');
            return redirect()->back();
        }

        alert()->success('موفقیت آمیز', 'محصول مورد نظر به سبد خرید اضافه شد');
        return redirect()->back();
    }

    public function index()
    {
        return view('home.cart.index');
    }

    public function update(Request $request){
        $request->validate([
            'qtybutton' => 'required'
        ]);


        foreach ($request->qtybutton as $rowId => $quantity){

            $item = \Cart::get($rowId);

            if($quantity > $item->attributes->quantity){
                alert()->error('دقت کنید','تعداد محصول وارد شده صحیح نمباشد');
                return redirect()->back();
            }

            \Cart::update($rowId,array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity
                ),
            ));

        }

        alert()->success('موفقیت آمیز', 'محصول مورد نظر با موفقیت ویژایش شد');
        return redirect()->back();
    }


    public function remove($rowId){
        \Cart::remove($rowId);
        alert()->success('موفقیت آمیز', 'محصول مورد نظر حذف شد');
        return redirect()->back();

    }

    public function clear(){
        \Cart::clear();

        alert()->warning('دقت کنید', 'سبد خرید شما پاک شد');
        return redirect()->back();
    }

    public function checkout()
    {
        if (\Cart::isEmpty()) {
            alert()->warning('سبد خرید شما خالی میباشد', 'دقت کنید');
            return redirect()->route('home.index');
        }

        $addresses = UserAddress::where('user_id', auth()->id())->get();
        $provinces = Province::all();

        return view('home.cart.checkout', compact('addresses' , 'provinces'));
    }



}
