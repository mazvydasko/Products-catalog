<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\ReviewRequest;
use App\Product;
use willvincent\Rateable\Rating;

class FrontController extends Controller
{
    public function index() {

        $products = Product::orderBy('updated_at', 'desc')->get();
        return view('main', ['products' => $products]);
    }

    public function show($id) {

        $product = Product::find($id);
        return view('product.show', ['product' => $product]);
    }

    public function postRating(ReviewRequest $request) {

        $product = Product::find($request->input('id'));
        $rating = new Rating;
        $rating->rating = $request->input('rate');
        $product->ratings()->save($rating);

        $comment = new Comment();
        $comment->user_name = $request->input('user_name');
        $comment->comment_text = $request->input('comment_body');
        $comment->product_id = $request->input('id');
        $comment->rate = $request->input('rate');
        $comment->save();

        session()->flash('alert-success', 'Review added!');
        return redirect()->back();
    }
}
