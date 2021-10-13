<?php

namespace App\Http\Controllers\User;

use App\Model\Color;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        return view('user.cart.index', compact('carts', 'total'));
    }

    public function add($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $id_color = $request->id_color;
        $name_color = Color::find($id_color)->name;
        $cartItem = Cart::content()->where('id', $product->id)->where('options.id_color', $id_color)->first();
        $qty = intval($request->qty);
        if ($qty > $product->getQty($id_color)) {
            return back()->with('alert-fail', 'Sản phẩm vượt quá số lượt cho phép!');
        }
        if (!$cartItem) {
            if ($product->getQty($id_color) == 0) {
                return back()->with('alert-fail', 'Sản phẩm đã hết!');
            }
            Cart::add($product, $qty, ['id_color' => $id_color, 'name_color' => $name_color])->associate('App\Model\Product');
        } else {
            Cart::update($cartItem->rowId, $qty)->associate('App\Model\Product');
        }
        return redirect(route('cart.index'))->with('alert-success', 'Cập nhật giỏ hàng thành công!');
    }

    public function update(Request $request) {
        try {
            $data = $request->data ?? [];
            $keyRequest =  array_column($data, 'rowId');
            $keys = Cart::content()->keys();
            
            foreach ($keys as $item) {
                if (!in_array($item, $keyRequest)) {
                    Cart::remove($item);
                }
            } 
    
            foreach($data as $item) {
                $cartItem = Cart::content()->where('rowId', $item['rowId'])->first();
                
                $item['qty'] = intval($item['qty']);
                if ($item['qty'] > $cartItem->model->getQty($cartItem->options->id_color)) {
                    session()->flash('alert-fail', 'Sản phẩm vượt quá số lượt cho phép!');
                    return response()->json(['message' => 'Cập nhật giỏ hàng thất bại!'], 404);
                }
                Cart::update($item['rowId'], $item['qty']);
            }
        } catch(\Throwable $th) {
            session()->flash('alert-fail', 'Cập nhật giỏ hàng thất bại!');
            return response()->json(['message' => $th], 404);
        }
        session()->flash('alert-success', 'Cập nhật giỏ hàng thành công!');
        return response()->json(['message' => 'Cập nhật giỏ hàng thành công!']);
    }
}
