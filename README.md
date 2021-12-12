## Projeto API REST baseado em operacoes de adicionar produtos, realizando operacao de estoque (adicionando e removendo / Compra e venda), com o historico dessas operacoes;

## Laravel Framework 8.75.0;

---

# Recursos necessarios:
- Conhecimento em Laravel < 8.75;
- PHP 7.3;
- Apache;
- Mysql;
- Composer;
- *Obs.: Utilizado apache friends 7.3;

# Instalacao das dependencias:
- Navegar ate a pasta do projeto;
- Composer install;
- php artisan key:generate;
- setar o banco de dados no arquivo .env;
- php artisan migrate;
- php artisan serve;

---

# Sobre o projeto;

## EndPoins:

\GET:    http://localhost:8000/api/produtos/listar
\GET:    http://localhost:8000/api/produtos/history
\POST:   http://localhost:8000/api/produtos/cadastrar
\POST:   http://localhost:8000/api/produtos/movimentacao

### No endPoint **"/listar"**, exibe todos os produtos em formato Json;

### No endPoint **"/history"**, exibe todo o historico de movimentacoes em formato Json;

### No endPoint para cadastro de produtos **"/cadastrar"**, deve ser enviando da seguinte maneira como exemplo:
\POST:   http://localhost:8000/api/produtos/cadastrar 
\{ 
	\"nome": "produto", 
	\"sku": "8kn3uo94p1", 
	\"qtd": "12" 
\} 
\
### Produto SKU deve ser unico, sem valores repetidos no banco de dados ou ira retornar um erro;

## Na movimentacao de produtos **"/movimentacao"** deve ser enviado da seguinte maneira como exemplo:
### A opcao de "op", aceita somente as palavras **"compra"** (compra de material +) ou **"venda"** (venda de material -); 
\POST:   http://localhost:8000/api/produtos/movimentacao 
\{ 
	\"sku": "8kn3uo94p1", 
	\"op": "venda", 
	\"qtd": "10" 
\} 
\  
ou: 
\{ 
	\"sku": "8kn3uo94p1", 
	\"op": "compra", 
	\"qtd": "30" 
\} 
\
### As funcoes do controllador acessam os models atraves dos fillable, portanto nao eh necessario a instancia das classes, apenas utilizar o Elouquente;

---

## Caso queira testar a passagem de dados, de diferentes maneiras e diferentes saidas, utilize os endPoints de teste baixo: 
\ 
GET:    http://localhost:8000/api/produtos/teste
\ 
POST:   http://localhost:8000/api/produtos/testeecho 
\
POST:   http://localhost:8000/api/produtos/testejson 
\

## Deve ser passado os dados de teste em Json padrao: 
\
\{ 
	\"nome": "produto", 
	\"sku": "8k3hf8k4", 
	\"qtd": "12" 
\} 
