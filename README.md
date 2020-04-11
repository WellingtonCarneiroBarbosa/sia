# Sistema de Gerenciamento de Eventos
Um projeto desenvolvido com _Laravel, Vue, Bootstrap e Jquery_
Você pode visualizá-lo em http://siaeventos.nbalarmes.com
Para obter um login de testes entre em contato com **carneirobarbosawellington@gmail.com**

# Getting Started
1. Primeiro, clone o repositório
```
git clone https://github.com/WellingtonCarneiroBarbosa/sistema-de-gerenciamento-de-eventos.git
```
2. Instale o pacote do composer e do npm
```
composer install
npm install
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
5. Compile o CSS e o JS
```
npm run dev
```
6. Inicialize um servidor local
```
php artisan serve
```
Então, visite [http://localhost:8000](http://localhost:8000) e voalá!

