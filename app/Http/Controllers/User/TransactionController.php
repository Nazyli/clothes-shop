<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Goods;
use App\Models\GoodsColor;
use App\Models\GoodsSize;
use App\Models\Orders;
use App\Models\OrdersDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentMethod;


class TransactionController extends Controller
{
    //
    public function reqBuy(Request $request)
    {
        //
        $request->validate([
            'goods_id' => 'required',
            'color' => 'required',
            'size' => 'required',
            'quantity' => 'required',
            'total_price' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $ordersId = 0;
            if ($request->cart) {
                $cart = Cart::create([
                    'user_id' => Auth::user()->id,
                    'goods_id' => $request->goods_id,
                    'goods_color_id' => $request->color,
                    'goods_sizes_id' => $request->size,
                    'qty' => $request->quantity,
                ]);
                DB::commit();
                return redirect()->route('products.detail', $request->goods_id)->with('success', 'Successfully added shopping cart.');
            } else {
                $ordersId = Orders::create([
                    'user_id' => Auth::user()->id,
                    'is_membership' => Auth::user()->is_membership,
                    'total_price' => $request->quantity * $request->total_price,
                    'total_qty' => $request->quantity,
                ])->id;

                $goods = Goods::find($request->goods_id);
                $goodsColor = GoodsColor::find($request->color);
                $goodsSize = GoodsSize::find($request->size);

                $orderDetails = OrdersDetail::create(
                    $this->toOrdersDetails($ordersId, $goods, $goodsColor, $goodsSize, $request->quantity)
                );
                $this->minQty($goodsSize->id, $request->quantity);
                DB::commit();
                return redirect()->route('transaction.confirm', $ordersId)->with('success', 'New Order created successfully.');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('transaction.confirm', $ordersId)->with('error', $e->errorInfo[2]);
        }
    }


    public function cart()
    {
        //
        $carts = Cart::where("user_id", Auth::user()->id)
            ->orderBy('created_at', 'DESC')->get();
        return view('user.transaction.cart', compact('carts'));
    }

    public function cartProcess(Request $request)
    {
        //

        DB::beginTransaction();
        try {
            if($request->total_price <= 0){
                return redirect()->route('transaction.cart')->with('error', 'No items selected.');
            }
            if ($items = $request->items_cart) {
                $ordersId = Orders::create([
                    'user_id' => Auth::user()->id,
                    'is_membership' => Auth::user()->is_membership,
                    'total_price' =>  $request->total_price,
                    'total_qty' => 0,
                ])->id;
                $qty = 0;
                foreach ($items as $item) {
                    $cart = Cart::find($item);
                    $goods = Goods::find($cart->goods_id);
                    $goodsColor = GoodsColor::find($cart->goods_color_id);
                    $goodsSize = GoodsSize::find($cart->goods_sizes_id);
                    $orderDetails = OrdersDetail::create(
                        $this->toOrdersDetails($ordersId, $goods, $goodsColor, $goodsSize, $cart->qty)
                    );

                    $this->minQty($cart->goods_sizes_id, $cart->qty);
                    $qty += $cart->qty;
                    $cart->delete();
                }
                Orders::where("id", $ordersId)->update(array('total_qty' => $qty));
                DB::commit();
                return redirect()->route('transaction.confirm', $ordersId)->with('success', 'New Order created successfully.');
            } else {
                return redirect()->route('transaction.cart')->with('error', 'No items selected.');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('transaction.cart')->with('error', $e->errorInfo[2]);
        }
    }

    public function cartDestroy($id)
    {
        //
            Cart::find($id)->delete();
            return redirect()->route('transaction.cart')->with('success', 'Cart created successfully.');
    }

    public function pending()
    {
        //
        $orders = Orders::whereNull("url_evidence_transfer")
            ->where("user_id", Auth::user()->id)
            ->orderBy('created_at', 'DESC')->get();
        return view('user.transaction.pending', compact('orders'));
    }

    public function waiting()
    {
        //
        $orders = Orders::whereNotNull("url_evidence_transfer")
            ->where("user_id", Auth::user()->id)
            ->whereNull("is_confirm")
            ->orderBy('created_at', 'DESC')->get();
        return view('user.transaction.waiting', compact('orders'));
    }

    public function history()
    {
        //
        $orders = Orders::where("user_id", Auth::user()->id)
            ->whereNotNull("is_confirm")
            ->orderBy('created_at', 'DESC')->get();
        return view('user.transaction.history', compact('orders'));
    }

    public function show($id)
    {
        $order = Orders::find($id);
        return view('user.transaction.detail')->with(compact('order'));
    }

    public function confirm($id)
    {
        $order = Orders::find($id);
        $address = Address::where("user_id", Auth::user()->id)->orderBy("is_main", "DESC")->get();
        $payment = PaymentMethod::all();
        return view('user.transaction.confirm')->with(compact('order'))->with(compact('address'))->with(compact('payment'));
    }

    public function sendOrder(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'zip_code' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'full_address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'payments_id' => 'required',
            'url_evidence_transfer' => ['required', 'mimes:png,jpg,jpeg'],
        ]);

        $image = $request->file('url_evidence_transfer');
        if (isset($image)) {
            $publicPath = "evidence_transfer";
            $imageName = time() . '.' . $image->extension();
            $image->move($publicPath, $imageName);
            $img_url = $publicPath . "/" . $imageName;
        }

        Orders::find($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'zip_code' => $request->zip_code,
            'lat' => $request->lat,
            'long' => $request->long,
            'full_address' => $request->full_address,
            'phone' => $request->phone,
            'email' => $request->email,
            'payments_id' => $request->payments_id,
            'url_evidence_transfer' => $img_url,
        ]);
        return redirect()->route('transaction.waiting')->with('success', 'Order successfully, waiting to be confirmed');
    }

    public function destroy($id)
    {
        //
        DB::beginTransaction();
        try {
            $order = Orders::find($id);
            $orderDetails = OrdersDetail::where('orders_id', $id)->get();
            foreach ($orderDetails as $i) {
                $goods = Goods::find($i->goods_id);
                $goodsColor = GoodsColor::where("goods_id", $goods->id)->where("color", $i->color)->first();
                $goodsSize = GoodsSize::where("goods_color_id", $goodsColor->id)->where("size", $i->size)->first();
                $this->plusQty($goodsSize->id, $i->qty);
                $i->delete();
            }
            $order->delete();
            DB::commit();
            return redirect()->route('transaction.pending')->with('success', 'Pending Transaction created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('transaction.pending')->with('error', $e->errorInfo[2]);
        }
    }

    // Function 


    private function toOrdersDetails($ordersId, $goods, $goodsColor, $goodsSize, $quantity)
    {
        return [
            'orders_id' => $ordersId,
            'goods_id' => $goods->id,
            'goods_name' => $goods->goods_name,
            'color' => $goodsColor->color,
            'additional_color_price' => $goodsColor->additional_price,
            'size' => $goodsSize->size,
            'additional_size_price' => $goodsSize->additional_price,
            'qty' => $quantity,
            'total_price' => ($quantity * ($goods->base_price + $goodsColor->additional_price + $goodsSize->additional_price)),
        ];
    }

    private function minQty($id, $qtyBuy)
    {
        $goodsSize = GoodsSize::find($id);
        $goodsSize->update([
            'qty' => ($goodsSize->qty - $qtyBuy),
        ]);
        $goodsColor = GoodsColor::find($goodsSize->goods_color_id);
        return Goods::where("id", $goodsColor->goods_id)->update(
            [
                'total_qty' => GoodsSize::totalQty($goodsColor->goods_id)
            ]
        );
    }

    private function plusQty($id, $qtyBuy)
    {
        $goodsSize = GoodsSize::find($id);
        $goodsSize->update([
            'qty' => ($goodsSize->qty + $qtyBuy),
        ]);
        $goodsColor = GoodsColor::find($goodsSize->goods_color_id);
        return Goods::where("id", $goodsColor->goods_id)->update(
            [
                'total_qty' => GoodsSize::totalQty($goodsColor->goods_id)
            ]
        );
    }
}
