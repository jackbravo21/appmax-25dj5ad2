<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Psr7\Message;

class ProductController extends Controller
{

    protected $valor;

    /////////////////////////////////////////////////

    public function show()
    {
        $data = Product::all();
        return response()->json($data);
    }

    public function create(Request $req)
    {
        try 
        {        
            $dados = $req->all();
            Product::create($dados);
    
            $return = ["msg"=>"Produto CADASTRADO com SUCESSO!", "Produto"=>$dados];
            return response()->json($return, 201);
        }

        catch (\Exception $e) 
        {
            return response()->json("ERRO ao SALVAR o produto!", 400);
        }
    }

    public function stock(Request $req)
    {                
        $qtd = $req->qtd;
        $op = $req->op;

        $sku = $req->sku;

        $busca = Product::where("sku", $sku)->first();

        $produto = Product::find($busca->id);

            if($op == "venda")
            {
                $resultado = $produto->qtd - $qtd;
                $this->valor = $resultado;
            }

            else if($op == "compra")
            {
                $resultado = $produto->qtd + $qtd;
                $this->valor = $resultado;
            }

            else
            {
                return response()->json("ERRO! Não foi passada nenhuma operação!", 400);
            }

            try 
            {
                $produto->qtd = $this->valor;
                $produto->update([$produto->qtd]);
                return response()->json($produto, 200);
            } 
            
            catch (\Throwable $e) 
            {
                return response()->json("ERRO ao atualizar o estoque!" . $e, 400);
            }     
    }


        /////////////////////////////////////////////////

        //vou deixar a parte de teste;

        public function teste()
        {
            return response()->json("Funcionou!");
        }
    
        public function testeEcho(Request $req)
        {
            echo $req->id . "<br>";
            echo $req->nome . "<br>";
            echo $req->sku . "<br>";
            echo $req->qtd . "<br>";             
        }
            
        public function testeJson(Request $req)
        {
            $data = $req->all();
            return response()->json($data);
        }

        /////////////////////////////////////////////////

}
