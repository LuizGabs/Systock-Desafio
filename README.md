## Bem vindo ao meu projeto para avaliação na Systock. Utilizei as tecnologias solicitadas, Docker e o NPM. Para executar o projeto, você deve ter o Docker, o Node (NPM) instalados em seu computador.

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/LuizGabs/Systock-Desafio.git
```
Entre no diretório "Systock-Desafio":

```sh
cd Systock-Desafio/
```

Crie o Arquivo .env
```sh
cp .env.example .env
```


Suba os containers do projeto
```sh
docker-compose up -d
```

Instalar algumas dependências do projeto
```sh
npm install
```

Acessar o container
```sh
docker-compose exec app bash
```


Instalar as demais dependências do projeto
```sh
composer install
```

Realizar as migrações para o banco de dados
```sh
php artisan migrate
```

Sair do container

```sh
exit
```

Executar o servidor local
```sh
npm run dev
```

Acessar o projeto
[http://localhost:8080](http://localhost:8080)

## Observação: pelo projeto estar rodando inteiramente no Docker, as ações demoram um pouco para serem concluídas, após clicar em um botão, ou acessar alguma página, aguarde um instante para obter a resposta. Todas as operações CRUD estão sendo feitas e para ter acesso ao Dashboard, é necessário se cadastrar no sistema. Basta clicar no botão "Cadastre-se", efetuar o cadastro, e você terá acesso ao Dashboard. Como o Laravel fornece a criação de usuários fake, é possível gerar vários usuários, para fins de visualização das operações CRUD, ou criar usuários manualmente. Para o laravel gerar usuários fake, siga os passos abaixo:

Acesse o container
```sh
docker-compose exec app bash
```

Acesse o Tinker
```sh
php artisan tinker
```

Gere os usuários
```sh
 \App\Models\User::factory()->create();
 ```

 Ou para gerar uma quantidade X de usuários, execute:
 ```sh
  \App\Models\User::factory()->count(X)->create();
``` 

No lugar do X, insira a quantidade desejada.