<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\History;
use GuzzleHttp\Psr7\Message;

class ProductController extends Controller
{
    protected $valor;    
    protected $nome;
    protected $sku;
    protected $op;
    protected $qtd;
    
    /////////////////////////////////////////////////

    public function show()
    {
        $data = Product::all();
        return response()->json($data);
    }

    public function history()
    {
        $data = History::all();
        return response()->json($data);
    }

    public function create(Request $req)
    {
        try 
        {        
            $dados = $req->all();

            $history["nome"] = $req->nome;
            $history["sku"] = $req->sku;
            $history["operacao"] = "Cadastro";
            $history["quantidade"] = $req->qtd;
            $history["totalestoque"] = $req->qtd;
            
            Product::create($dados);
            History::create($history);

            $return = ["msg"=>"Produto CADASTRADO com SUCESSO!", "Produto"=>$dados];
            return response()->json($return, 201);
        }

        catch (\Exception $e) 
        {
            return response()->json("ERRO ao CADASTRAR o produto!", 400);
        }
    }

    public function store(Request $req)
    {                
        $qtd        = $req->qtd;
        $op         = $req->op;
        $sku        = $req->sku;

        $produto      = Product::where("sku", $sku)->first();
        //$busca    = Product::find($produto->id);

        $this->id   = $produto["id"];
        $this->nome = $produto["nome"];
        $this->sku  = $produto["sku"];
        $this->op   = $op;
        $this->qtd  = $qtd;
        
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
                $produto->qtd       = $this->valor;
                $produto->update([$produto->qtd]);
                
                $history["nome"]            = $this->nome;
                $history["sku"]             = $this->sku;
                $history["operacao"]        = ucfirst($this->op);
                $history["quantidade"]      = $this->qtd;
                $history["totalestoque"]    = $this->valor;
                History::create($history);   

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
