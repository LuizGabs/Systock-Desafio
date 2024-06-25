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

Instalar algumas dependências do projeto
```sh
npm install
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as demais dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Realizar as migrações para o banco de dados
```sh
php artisan migrate
```

Acessar o projeto
[http://localhost:8080](http://localhost:8080)
