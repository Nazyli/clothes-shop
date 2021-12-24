<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\GoodsColor;
use App\Models\GoodsSize;
use App\Models\Orders;
use App\Models\OrdersDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->route('transaction.confirm', $ordersId)->with('error', $e->errorInfo[2]);
        }
    }
    public function confirm($id)
    {
        $order = Orders::find($id);
        return view('user.confirm')->with(compact('order'));

    }

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
            ['total_qty' => GoodsSize::totalQty($goodsColor->goods_id)
        ]);
    }
}
