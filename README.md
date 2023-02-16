# Password Checker

Checa a força das senhas com base em parâmetros configuraveis.


## Ambiente

O projeto foi preparado para ser executado utilizando-se de contâiners Docker,
portanto as instruções abaixo consideram que já possui o 
[Docker Engine](https://docs.docker.com/engine/install/) e o 
[Docker Compose](https://docs.docker.com/compose/install/) instalado.


## Configuração

Fazendo uma cópia do arquivo `.env.example` para `.env` é possível configurar a 
porta que o projeto irá rodar, assim como o local onde o Composer poderá armazenar
o cache e o usuário a ser utilizando dentro dos contâiners.

Baixe os pacotes necessários executando o comando abaixo:

```shell
docker compose run --rm composer install
```


## Execução do projeto

Execute o comando abaixo:
```shell
docker compose up web
```

## Execução dos testes

Execute o comando abaixo:
```shell
docker compose run --rm tests
```


## Mais informações

- [API](docs/api.md)
- [Sobre o desenvolvimento do projeto](docs/sobre-desenvolvimento.md)
