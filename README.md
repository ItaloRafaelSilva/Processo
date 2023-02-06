# Processo
Desafio seletivo
<h1 align="center" style="font-size: 35px;">Gerenciamento De Cliente / Processo Seletivo</h1>

 Para esse processo foi solicitado que desenvolvesse um Gerenciador De Clientes que fosse acessado através de uma tela de login e senha.

 Ao acessar o sistema, a página "Home" teria que ter algumas funções como Listar,Incluir,Editar e Excluir. 

Cada usuário deverá conter as seguintes informações: Nome, Data de Nascimento, CPF, RG, Telefone, etc... 
Também a possibilidade de apenas um usuário ter um logradouro ou inúmeros logradouros. 

Foi solicitado alguns requisitos Técnicos como:

- A aplicação deverá ser desenvolvida em PHP, sem utilização de framework (Laravel,Code Igniter,etc).

- Banco de Dados: MySql.

- Front-End: Livre escolha.

- Resumo do projeto.    

Nesse projeto utilizei as seguintes ferramentas:

- Firgma: Para criação do organograma.

- VSCode: Editor de código.
 
- Front-End: HTML, CSS, Bootstrap e JavaScript.

- Back-End: PHP, API e Banco de Dados MySqli

- Servidor: XAMPP


Para começar esse projeto estruturei o mesmo em um organograma, colocando o seus setores, funcionalidade e ações. Utilizei proteções contra SqlInjector e
realize algum processo indevido, será notificado com uma mensagem de erro na tela.

Após uma visão do projeto, comecei com a pagina inicial bem simples.

Página Inicial: Antes de ir para a tela de Login é necessário criar uma conta no botão "Cadastra-se".

https://github.com/ItaloRafaelSilva/Curso-DevClub/blob/main/Processo%20Seletivo/tela%20inicial.png

Página de Cadastro: Para essa tela, iniciei o meu servidor com o XAMPP e criei o Banco De Dados nele eu fiz a primeira tabela "usuarios".
Ela é necessária para armazenar os dados do usuário e assim podendo usar as credenciais registradas para fazer o login.

Banco de Dados / tabela usuarios.

Tela de Cadastro.

Usuario Cadastrado no BD.

Ao realizar o cadastro com sucesso, será redirecionado para a tela de login automaticamente, assim podendo logar com a suas credencias. Vale ressaltar caso esqueça
do seus dados não ira conseguir logar.

Observação: Não tem hierarquia de e-mail, ao acessar podera editar, excluir,incluir,etc...

Tela de Login.


Tela Home.

Na tela "HOME" vera todos os usuarios vinculado ao sistema caso tenha e também algumas funções como excluir, editar, incluir e visualizar.

Filtro de usuario na tela Home.

Pode editar as informações do usuario.
Editar usuario.

Pode adicionar novos usuarios dentro da pagina home.
Incluir usuario dentro da pagina Home.

Ira excluir o usuario junto com o seus respectivos endereços.
Excluir usuario.

Nessa pagina podera ver todos os endereços vinculado ao cliente.
Visualizar.


Para adicionar endereco, utilizei uma API para fazer a busca pro CEP reais.
Adicionar Endereço.

tabela de endeços no BD / vinculei o ID da tabela usuario com o usuario_ID atráves da chave estrangeira e restritiva.




