
Sistema de gerenciamento de remédios em uma farmácia, com autenticação e permissões por tipo de usuário.





✅ Passos para reinstalar e testar o projeto Laravel

1. Instalar dependências PHP (via Composer)

composer install

2. Instalar dependências do frontend (caso use Vite/JS/CSS)

Se estiver usando Laravel Breeze com frontend (Vite, Tailwind etc):

npm install && npm run dev

3. Copiar .env e configurar

Se não tiver o .env, copie o exemplo:

cp .env.example .env

Edite o .env e configure o banco de dados:

DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

4. Gerar a chave da aplicação

php artisan key:generate

5. Rodar as migrations (e seeders, se houver)

php artisan migrate --seed

Use --seed somente se tiver um seeder configurado para criar os usuários e remédios automaticamente.

6. Iniciar o servidor local

php artisan serve





**caso nada disso de certo ai**
** método de instalação do projeto**


Tecnologias utilizadas: Laravel, Breeze

---

1. Preparação do Ambiente

composer create-project laravel/laravel farmacia

2. Gere a chave do aplicativo:

php artisan key:generate

3. Configure o .env com os detalhes do banco de dados:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=farmacia
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

4. Inicie o servidor:

php artisan serve

5. Configuração do Banco de Dados

Criação das Tabelas

Execute o comando para criar as migrações:

php artisan make:migration create_remedios_table
php artisan make:migration create_users_table
php artisan make:migration add_tipo_to_users_table

Edite os arquivos de migração na pasta database/migrations:(so copiar os codigos dos arquivos ja existentes)

Execute as migrações:

php artisan migrate

---

6. Configuração do Sistema de Autenticação

Instale o Breeze para autenticação(dentro da pasta do Projeto):

composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate

---

4. Rotas

Edite o arquivo routes/web.php para definir as rotas básicas:(so copiar os codigos dos arquivos ja existentes)

---

5. Controladores

Crie os controladores necessários:

php artisan make:controller AdminController
php artisan make:controller FuncionarioController
php artisan make:controller RemedioController

---

6. Views

Crie as views para o cliente e funcionário:

Página inicial (resources/views/home.blade.php):

Gerenciamento do adm (resources/views/admgerenciar.blade.php):

Gerenciamento do Funcionário (resources/views/gerenciar.blade.php):

---

7. o css esta pagina public 
(public\css\style.css) 

Finalizando


