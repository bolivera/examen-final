<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Cart;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use CodebelHelpers;
use App\Model\Categoria;
use App\Model\Producto;
use App\Model\Ubigeo;

class CheckoutController extends Controller
{
    public $recursos;
    public function __construct()
    {
        $this->recursos = new RecursosController();
    }
    
    public function createOrder( Request $request){
        
        $cont = 0;
        $envio = 0;
        $ListProsuc=[];
        $cart = Cart::getContent();
        $departamento  = Ubigeo::where(['flag' => 'D','coddep' =>$request->departamento])->get();
        $provincia = Ubigeo::where(['flag' => 'P','coddep' =>$request->departamento,'codprov' =>$request->provincia])->get();
        $distrito  = Ubigeo::where(['flag' => 'T','coddep' =>$request->departamento,'codprov' =>$request->provincia, 'coddist' =>$request->distrito])->get();

        
        foreach($cart as $key=>$item){
            $subitem = $item->attributes;
            $color = $subitem->color;
            $talla =$subitem->talla;
            $idProducto = $subitem->idProducto;
            $arrayProduc = array(
                "productLabel" =>$item->name,
                "productRef"=> "Id:$idProducto  Talla:$talla Color:$color",
                "productQty"=>$item->quantity,
                "productAmount"=>$item->price * 100);
            $ListProsuc[$cont] = $arrayProduc;
            $cont++;
        }

        $cartTotal = Cart::getTotal();
        $impuestos = $cartTotal * 18; // IGV EN PERU 18% consulta
        $envio = '';
        if((int)$cartTotal < 300){
            $envio = 8;
            if($request->departamento !== "15"){
                $envio = 15;
            }
            $cartTotal = $cartTotal + $envio;
        }
        
        $cartTotal =  $cartTotal * 100; // se multiplica por 100 ya que iziplay toma el monto minimo del Perú es decir en centimos 
        $costoEnvio = (!empty($envio)) ? $envio * 100 : $envio;
        $fullName = explode(" ", $request->fullname_invoice);
        $lastName = explode(" ", $request->lastName_invoice);

        try{
            $store = array(
                "amount" =>  $cartTotal,
                "currency" => "PEN", 
                "orderId" => "Orden_".CodebelHelpers::unique_code(10),
                "customer" => array(
                    "email" => $request->emailaddress_invoice,

                    "billingDetails" =>array(
                        "firstName" => $fullName[0],   
                        "lastName" => $lastName[0],    
                        "phoneNumber" => $request->phonenumber_invoice,
                        "address" =>$request->street_invoice,    
                        "district" =>$distrito[0]->nmbubigeo,  
                        "city" =>$provincia[0]->nmbubigeo,
                        "state" =>$departamento[0]->nmbubigeo,   
                    ),

                    "shippingDetails" =>array(
                        "firstName" => $fullName[0],   
                        "lastName" => $lastName[0],    
                        "phoneNumber" => $request->phonenumber_invoice,
                        "address" =>$request->street_invoice,    
                        "district" =>$distrito[0]->nmbubigeo,  
                        "city" =>$provincia[0]->nmbubigeo,
                        "state" =>$departamento[0]->nmbubigeo, 
                    ),
                    "shoppingCart"=>array(
                        "shippingAmount" => $costoEnvio, 
                        "taxAmount" => $impuestos, 
                        "cartItemInfo" => $ListProsuc,
                    ),
                ),
            );

            $response = Http::withHeaders([
                'Authorization' => 'Basic ODc0NTk3MjI6dGVzdHBhc3N3b3JkX1MxVTloSmx6WVZDQXI5aEZrbkxDdDBYdk9SZkJ4MWY2RmZkWlRMaTFhQ25FZw==',
            ])->post(config('payment-methods.izypay.api').'V4/Charge/CreatePayment', $store);

            if ($response['status'] !== 'SUCCESS') {
                // /* an error occurs, I throw an exception */
                \Log::debug($response['answer']);
                // $error = $response['answer'];
                // throw new \Exception("error " . $error['errorCode'] . ": " . $error['errorMessage'] );
                $cart = Cart::clear();
                $data['categorias'] = Categoria::where('estado', 1)->get();
                $data['header'] = view('pages.header', $data);
                $data['footer'] = view('pages.footer', $data);
                return view('pages.msjerror', $data);
            }
            
            $data['token'] = $response["answer"]["formToken"];
            $data['categorias'] = Categoria::where('estado', 1)->get();
            $data['header'] = view('pages.header', $data);
            $data['footer'] = view('pages.footer', $data);
            $data['envio'] = ($envio == '') ? '0' : $envio;
            $data['total'] =  $cartTotal/100;
            return view('pages.liquidar', $data);            
            
            
        } catch(\Exception $e){
            $cargo2= $e->getMessage();
            return $cargo2;
        }

    }

    protected function generatePaymentGateway($paymentMethod, Order $order): string
    {
        $method = new \App\PaymentMethods\MercadoPago;
        return $method->setupPaymentAndGetRedirectURL($order);
    }

}