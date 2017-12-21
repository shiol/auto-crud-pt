# Criador Automático de CRUDs

### Apenas indique o banco de dados e a tabela no db_connect.php e ele cria seu CRUD com PDO, Bootstrap e Paginação.

### Em dois Idiomas
Português - https://github.com/ribafs/auto-crud-pt

Inglês - https://github.com/ribafs/auto-crud-en

### Requisitos:
- Apache2
- PHP 5.5.9+
- MySQL 5.5+ ou PostgreSQL 8+

## Download
https://github.com/ribafs/auto-crud

## Instalação
Descompacte o pacote baixado e copie o diretório auto-crud para seu diretório web (renomeie a vontade).
Supondo que tenha mudado o nome para clientes.

## Instalando via composer
- Criar um diretório via terminal
- Acessar o diretório criado e executar:

composer require ribafs/auto-crud-pt

## Configuração

Edite o arquivo db_connnect.php e ajuste para as informações do seu banco de dados
Lembre também de indicar a tabela a ser usada.
Pode testar com os scripts existentes para mysql e para postgresql: clientes_my.sql e clientes_pg.sql na pasta scripts

Chame em seu navegador com
http://localhost/clientes

Ao abrir no navegador verá o grid com o CRUD como abaixo:

<img src="imagens/grid.png">

No grid acima verá a listagem dos registros existentes com paginação, edição, exclusão e adição de um novo registro.

Para inserir um novo registro clique no botão à esquerda Novo Registro

<img src="imagens/insert.png">

Para atualizar um dos registros clique no ícone Editar à esquerda e verá a tela:

<img src="imagens/update.png">

Para remover um registro apenas clique no link Excluir à direita do Editar e confirme na tela:

<img src="imagens/delete.png">

## Funcionamento

Após configurar o banco e a tabela e chamar pelo navegador ele trata cada um dos campos da tabela de forma particular usando para isso informações de metadados do SGBD.

## Customizações

O código com a paginação está no arquivo libs/ps_pagination.php.

## Releases

- 1.0 - Versão inicial
- 1.1 - Nesta versão os arquivos foram todos renomeados para nomes em português
      - Melhorados e traduzidos os comentários
      - Simplificação do código removendo código desnecessário
      - Criadas duas funções para substituir trechos de código que se repetiam. Inseri seu include na conexao.php para facilitar

## AVISO
O principal objetivo deste pequeno software é o de facilitar a vida de quem não programa e nem está pensando em aprender e também o de facilitar para quem programa mas apenas quer criar algo rápido, como uma agenda ou um cadastro simples.

## Licença

MIT

Agradecimento ao site
https://www.codeofaninja.com/2011/06/paginating-your-data-with-ajax-and.html

Sem ele a paginação não seria tão elegante e eficiente.
