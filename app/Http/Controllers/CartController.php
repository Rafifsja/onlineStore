<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] = "Shopping Cart";
        $viewData["products"] = $request->session()->get('products', []);
        return view('cart.index')->with("viewData", $viewData);
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        $products = $request->session()->get('products', []);
        $products[$id] = [
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "image" => $product->getImage(),
            "quantity" => $quantity,
        ];
        $request->session()->put('products', $products);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }

    public function purchase(Request $request)
    {
        $products = $request->session()->get('products', []);
        $total = 0;
        foreach ($products as $product) {
            $total += $product["price"] * $product["quantity"];
        }

        $order = new Order();
        $order->setTotal($total);
        $order->setUserId(Auth::user()->getId());
        $order->save();

        foreach ($products as $productId => $product) {
            $item = new Item();
            $item->setQuantity($product["quantity"]);
            $item->setPrice($product["price"]);
            $item->setOrderId($order->getId());
            $item->setProductId($productId);
            $item->save();
        }

        $user = Auth::user();
        $user->setBalance($user->getBalance() - $total);
        $user->save();

        $request->session()->forget('products');

        return view('cart.purchase')->with("viewData", [
            "title" => "Purchase - Online Store",
            "subtitle" => "Purchase Complete",
            "order" => $order,
        ]);
    }
}