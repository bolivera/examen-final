<?php

namespace App\Http\Controllers;

use App\Model\Categoria;
use App\Model\Producto;
use App\Model\ShoppingCart;
use App\Model\ShoppingDetail;
use App\Model\ShoppingProduct;
use Cart;
use Illuminate\Http\Request;
use CodebelHelpers;
// require_once('vendor/autoload.php');

class CartController extends Controller
{

    public $recursos;

    public function __construct()
    {
        $this->recursos = new RecursosController();
    }

    public function addCart(Request $request)
    {
        $userId = $request->session()->getId();
        $product = Producto::where(['id' => $request->id, 'estado' => 1])->first();
        if (empty($product)) {
            return response()->json(['status' => false, 'msg' => "Producto agotado"]);
        }
        // $cart = Cart::getContent()->has($request->id);
        // if ($cart) {
        //     return response()->json(['status' => false, 'msg' => "Ya está en tu carrito este producto"]);
        // }
        $rowId = CodebelHelpers::unique_code(4);
        Cart::add(array(
            'id' => $rowId,
            'name' => $product->titulo,
            'price' => $product->precio,
            'quantity' => $request->unidades,
            'attributes' => array(
                'idProducto' => $product->id,
                'fotos' => $this->recursos->getExplodeImagenes($product->imagenes)[0],
                'url' => $product->slug,
                'color' => $request->color,
                'talla' => $request->talla,
            ),
        ));
        return view('pages.listCartheader');
    }

    public function actualizarCantidadProducto(Request $request)
    {
        $cart = Cart::getContent()->has($request->id);
        if ($cart) {
            Cart::update($request->id, array(
                'quantity' => ($request->status == "sumar") ? 1 : -1,
            ));
            return response()->json(['status' => true, 'msg' => "Producto agotado"]);
        }
    }

    public function remove(Request $request)
    {
        $cart = Cart::getContent()->has($request->id);
        if ($cart) {
            Cart::remove($request->id);
        }
        return response()->json(
            [
                'status' => true,
                'msg' => "¡Se elminó producto correctamente!",
                "total" => Cart::getSubTotal(),
                "cantidad" => Cart::getContent()->count(),
            ]
        );
    }

    public function listaCarrito(Request $request)
    {

        $data['title'] = 'Lista de productos';
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['header'] = view('pages.header', $data);
        $data['footer'] = view('pages.footer', $data);
        return view('pages.ver-productos', $data);
    }

    public function pagarAhora(Request $request)
    {
        $SECRET_API_KEY = config('payment-methods.izypay.secret');
        try {

            $data['title'] = 'Procesar pago';
            $data['categorias'] = Categoria::where('estado', 1)->get();
            $data['departamentos'] = $this->recursos->departamentos();
            $data['header'] = view('pages.header', $data);
            $data['footer'] = view('pages.footer', $data);
            return view('pages.pagar', $data);
        } catch (\Exception $ex) {
            dd($ex);
        }
    }

    public function finalizaPago(Request $request)
    {
        $SECRET_API_KEY = config('payment-methods.izypay.secret');
        //$client = new Lyra\Client();
        $cart = Cart::clear();
        
        $returnIzipay = $request->input('kr-answer');
        $items = json_decode($returnIzipay, true);
        $customer = $items['customer'];
        $orderDetails = $items['orderDetails'];
        $billingDetails = $customer['billingDetails'];
        $extraDetails = $customer['extraDetails'];
        $shoppingCart = $customer['shoppingCart'];
        $transactions = $items['transactions'];
        $transactionDetails = $transactions[0]['transactionDetails']; 
        $cardDetails = $transactionDetails['cardDetails'];

        $data['estadoPago'] = true;
        $data['categorias'] = Categoria::where('estado', 1)->get();
        $data['header'] = view('pages.header', $data);
        $data['footer'] = view('pages.footer', $data);

        try {
            // $claveHash = $request->input('kr-hash');
            //***validacion contra fraudes***
            // if (!$client->checkHash()) {
            //     //something wrong, probably a fraud ....
            //     signature_error($formAnswer['kr-answer']['transactions'][0]['uuid'], $hashKey,
            //                     $client->getLastCalculatedHash(), $_POST['kr-hash']);
            //     throw new Exception("invalid signature");
            // }
            //**********
            $result = $this->recursos->numberShopping($cardDetails['legacyTransId']);
     
            if ($items['orderStatus'] == "PAID" && !$result) {
                $cart = new ShoppingCart;
                $cart->ordenCompra = $cardDetails['legacyTransId'];
                $cart->TotalAmount = $orderDetails['orderTotalAmount'];
                $cart->fullName = $billingDetails['firstName'] . ' ' . $billingDetails['lastName'];
                $cart->distrito = $billingDetails['district'];
                $cart->provincia = $billingDetails['city'];
                $cart->departamento = $billingDetails['state'];
                $cart->email = $customer['email'];
                $cart->phoneNumber = $billingDetails['phoneNumber'];
                $cart->browserUserAgent = $extraDetails['browserUserAgent'];
                $cart->ipAddress = $extraDetails['ipAddress'];
                $cart->save();

                foreach ($shoppingCart['cartItemInfo'] as $items) {

                    $product = new ShoppingProduct;
                    $product->productLabel = $items['productLabel'];
                    $product->productRef = $items['productRef'];
                    $product->productQty = $items['productQty'];
                    $product->productAmount = $items['productAmount'];
                    $product->save();

                    $detail = new ShoppingDetail;
                    $detail->idShoppingCart = $cart->id;
                    $detail->idShoppingProduct = $product->id;
                    $detail->save();
                }
            }else{
                \Log::debug($items);
            }

            $data['estadoPago'] = true;
            return view('pages.factura', $data);
        } catch (\Exception $ex) {
            //dd($ex);
            $data['estadoPago'] = false;
            return view('pages.factura', $data);
        }
    }

    public function checkHash($key = null)
    {
        $supportedHashAlgorithm = array('sha256_hmac');

        /* check if the hash algorithm is supported */
        if (!in_array($_POST['kr-hash-algorithm'], $supportedHashAlgorithm)) {
            throw new LyraException("hash algorithm not supported:" . $_POST['kr-hash-algorithm'] . ". Update your SDK");
        }

        /* on some servers, / can be escaped */
        $krAnswer = str_replace('\/', '/', $_POST['kr-answer']);

        /* if key is not defined, we use kr-hash-key POST parameter to choose it */
        if (is_null($key)) {
            if ($_POST['kr-hash-key'] == "sha256_hmac") {
                $key = $this->_hashKey;
            } elseif ($_POST['kr-hash-key'] == "password") {
                $key = $this->_password;
            } else {
                throw new LyraException("invalid kr-hash-key POST parameter");
            }
        }

        $calculatedHash = hash_hmac('sha256', $krAnswer, $key);
        $this->_lastCalculatedHash = $calculatedHash;

        /* return true if calculated hash and sent hash are the same */
        return ($calculatedHash == $_POST['kr-hash']);
    }

}
