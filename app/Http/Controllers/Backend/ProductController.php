<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Fabric;
use App\Models\ImageGallery;

use Cart;
use App\Models\Add_to_cart_product;
use Illuminate\Support\Facades\Hash;
class ProductController extends Controller
{
    public function productList(){
        $products = Product::all();
        return view('backend.product.list',compact('products'));
    }

    public function productAdd(){
        return view('backend.product.add');
    }

    public function productStore(Request $request){
        $rules = [
            'code' => 'required',
            'name' => 'required',
            'price' => 'required'
        ];
        $this->validate($request,$rules);
        $data = $request->all();

        if($product = Product::create($data)){
            session()->flash('success','Product added successfully');
            return redirect()->back();
        }else{
            session()->flash('error','Something error in internal system');
            return redirect()->back();
        }
    }



    public function productEdit($id){
        $product = Product::find($id);
        return view('backend.product.edit',compact('product'));
    }

    public function productUpdate(Request $request){
      $rules = [
          'code' => 'required',
          'name' => 'required',
          'price' => 'required'
      ];
        $this->validate($request,$rules);
        $data = $request->all();



        $product = Product::find($request->id);
        if($product->update($data)){
            session()->flash('success','Product updated successfully');
            return redirect()->back();
        }else{
            session()->flash('error','Something error in internal system');
            return redirect()->back();
        }
    }

    public function productDelete($id){
        $product = Product::find($id);
        if($product->delete()){
            session()->flash('success','Product deleted successfully');
            return redirect()->back();
        }else{
            session()->flash('error','Something error in internal system');
            return redirect()->back();
        }
    }

    // offer function
    public function productOfferlist(){
      $products = ProductOffer::all();
      return view('backend.product.Offerlist',compact('products'));
    }

    public function productOfferadd(){
      return view('backend.product.addoffer');
    }

    public function productStoreOffer(Request $request){
        $rules = [
            'offer' => 'required',
        ];
        $this->validate($request,$rules);
        $data = $request->all();

        if($product = ProductOffer::create($data)){
            session()->flash('success','Product Offer added successfully');
            return redirect()->back();
        }else{
            session()->flash('error','Something error in internal system');
            return redirect()->back();
        }
    }

    // basket function
    public function productbasket(){
          $products = Product::all();
          return view('backend.product.basket',compact('products'));
    }

    public function productDetail(Request $request){

        $product = Product::find($request->productid);
        $generate_product_cart_id = Hash::make($product->id);

        Cart::add($product->id, $product->name, $product->price, $request->productquantity, array());


    }
    public function productcheckout(){
      $deliveryCharg=0;
      $discountsCharg="";
      $dis="";
      $items = \Cart::getContent();
      $total = Cart::getTotal();
      foreach ($items as $key => $value) {
        if($value->id == 1 && $value->quantity > 1){
          $dis=$value->price/2;
          $discountsCharg=$total-$dis;
        }
      }

      if( $total < 50 && $total > 0){
        $deliveryCharg="$4.95";
      }
      else if( $total < 90 && $total > 50){
          $deliveryCharg="$2.95";
        }
        else if($total > 90){
          $deliveryCharg="Free Delivery";
          }

      return view('backend.product.AddToCartlist',compact('items','total','deliveryCharg','discountsCharg','dis'));

    }


    public function productRemoveCart($id){
      Cart::remove($id);
      $products = Product::all();
      return redirect()->route('product.checkout');
    }

    public function productUpdateCart($id){
      $product = Cart::get($id);
      return view('backend.product.cartedit',compact('product'));
    }

    public function productUpdateInsertCart(Request $request){
      $id=$request->id;
      $qty=$request->quantity;
       // \Cart::update($id, array('quantity' => $request->quantity,));


       Cart::update($id, ['quantity' => ['relative' => false,
                                   'value' => $qty
                                 ]
            ]);

            return redirect()->route('product.checkout');
    }

}
