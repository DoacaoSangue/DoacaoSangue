Primeiramente a pasta do projeto (DoacaoSangue) deve estar dentro dentro do diretório onde o XAMPP está instalado, e dentro da pasta htdocs.
Por exemplo: "C:\xampp\htdocs\DoacaoSangue" para o meu projeto.
Logo após executar o XAMPP e iniciar tanto o MySQL quanto o Apache, acessar o projeto por meio do navegador com o seguinte endereço: "localhost/DoacaoSangue/".
(O banco de dados precisa primeiramente ser criado como "doacao_sangue" no phpmyadmin e então ser importado da pasta "data" do projeto).
Todos os usuários são cadastrados por padrão como usuários comuns, para criar o primeiro administrador, caso o banco de dados esteja vazio, deve-se preencher a tela de cadastro e modificar no banco de dados o valor do campo "tipo_usuario" de 0 para 1.

As funcionalidades do aplicativo são:

Tela com opção de acesso ou cadastro de usuário.

Caso o usuário seja um usuário comum, ao logar ele pode tanto pode solicitar doação como ofertar doação de sangue e também pode verificar as doações que pertencem a ele.

Caso o usuário seja um administrador, ele pode cadastrar, alterar, buscar ou excluir um local de doação e também pode cadastrar, alterar ou excluir uma doação.

O aplicativo conta com validações para e-mail, senha (mínimo 8 caracteres, sendo 1 maiúscula, 1 minúscula, 1 caractere especial e 1 número como requisitos obrigatórios) a senha é criptografada no banco. Validação para formato de número de telefone e máscara. Também conta com verificações que possibilitam visualizar procedimentos viáveis, onde há compatibilidade entre o doador e o receptor.
