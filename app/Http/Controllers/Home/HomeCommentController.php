<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeCommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'text' => 'required|min:5|max:7000',
        ]);

        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#comments')->withErrors($validator);
        }

        if (auth()->check()) {
            try {
                DB::beginTransaction();

                Comment::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'text' => $request->text
                ]);


                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                alert()->error('مشکل در ویرایش محصول', $ex->getMessage())->persistent('حله');
                return redirect()->back();
            }

            alert()->success('نظر ارزشمند شما با موفقیت برای این محصول ثبت شد', 'باتشکر');
            return redirect()->back();
        } else {
            alert()->warning('دقت کنید', 'برای ثبت نظر نیاز هست در ابتدا وارد سایت شوید')->persistent('حله');
            return redirect()->back();
        }
    }

    public function usersProfileIndex()
    {

        $comments = Comment::where('user_id', auth()->id())->where('approved' , 1)->get();
        return view('home.users_profile.comments', compact('comments'));
    }
}
