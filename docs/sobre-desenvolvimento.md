# Sobre o desenvolvimento do projeto

O projeto foi desenvolvido para demonstrar minhas habilidades de modelagem e construção de uma API REST para consumo.


## Modelagem

Optei por criar uma entidade para senha e uma interface para regras de validação da mesma, permitindo assim que as
lógicas de validação possam ser escolhidas e parametrizadas de forma dinâmica, conforme requisito.


## Arquitetura

Escolhi dividir o projeto em camadas, objetivando, principalmente, isolar a lógica de domínio do restante do código 
que cuida da comunicação externa.


## Estrutura de pastas

Defini uma estrutura de pastas que considero, até o momento, simples e preparada para evolução.

- docs (informações sobre o projeto)
- public (ponto de entrada da aplicação)
- routes (contém todas as definições de endpoints)
- src
  - Domain
    - Models
  - Infra
    - Containers
    - Controllers
      - Http
    - Routes
- tests
- vendor (pacotes PHP de terceiros)
