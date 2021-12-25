<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Orders;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    //
    public function confirm()
    {
        //
        $orders = Orders::whereNotNull("url_evidence_transfer")
            ->whereNull("is_confirm")
            ->orderBy('created_at', 'DESC')->get();
        return view('admin.orders.confirm', compact('orders'));
    }

    public function confirmShow($id)
    {
        //
        $order = Orders::find($id);
        return view('admin.orders.confirm-show')->with(compact('order'));
    }

    public function confirmApprove(Request $request, $id)
    {
        //
        if ($request->no_resi == null) {
            return redirect()->route('orders.confirm-show', $id)->with('error', 'Receipt number cannot be null');
        }
        Orders::find($id)->update(
            [
                'no_resi' => $request->no_resi,
                'is_confirm' => TRUE,
                'confirm_by' => Auth::user()->id,
            ]
        );
        return redirect()->route('orders.confirm', $id)->with('success', 'Order successfully confirmed');
    }

    public function purchase()
    {
        //
        $orders = Orders::whereNotNull("is_confirm")
            ->orderBy('created_at', 'DESC')->get();
        return view('admin.orders.history', compact('orders'));

    }

    public function purchaseShow($id)
    {
        $order = Orders::find($id);
        return view('admin.orders.detail')->with(compact('order'));
    }
}
