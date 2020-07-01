# Sistema Interno de Agendamento de Eventos
Um projeto desenvolvido com _Laravel, Vue, Bootstrap e Jquery_
<br>
Você pode visualizá-lo em http://siaeventos.nbalarmes.com
<br>
Para obter um login de testes entre em contato com **carneirobarbosawellington@gmail.com**

## Logo
<img src="https://github.com/WellingtonCarneiroBarbosa/sia/blob/master/public/dashboard/assets/img/brand/siaLogo.png" alt="SIA Eventos" style="widht: 0.5rem; height: 0.5rem;" >

# Getting Started
1. Primeiro, clone o repositório
```
git clone https://github.com/WellingtonCarneiroBarbosa/sia
```
2. Instale as dependências necessárias (você deve possuir o composer)
```
composer install
```
3. Na pasta do projeto, clone o arquivo **_.env.exemple_** e renomeie para **.env**. Então, atualize com suas variáveis de ambiente. Após, crie um banco de dados com o nome configurado no **_.env_**.
Então, gere a chave da aplicação e publique as alterações
``` 
php artisan key:generate
php artisan config:cache
```
4. Publique as tabelas
```
php artisan migrate
```
5. Gere dados padrões para o banco de dados
```
php artisan db:seed
```
O login padrão para administrador é admin@example.org
<br>
Para usuário é user@example.org 
<br>
Para ambos, a senha é password

6. Inicialize um servidor local
```
php artisan serve
```
Então, visite [http://localhost:8000](http://localhost:8000) e voalá!

