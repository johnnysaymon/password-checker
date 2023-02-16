# API

Documentação dos endpoints:

## Verificar


### Requisição

Method: POST<br/>
URL: /verify<br/>
Body:
```json
{
    "password": "ExemploDeSenha!123&",
    "rules": [
        {"rule": "minSize","value": 4},
        {"rule": "minSpecialChars","value": 2},
        {"rule": "noRepeted","value": 0},
        {"rule": "minDigit","value": 4}
    ]
}
```

### Resposta

#### Sucesso

Status: 200<br>
Content-Type: application/json<br>
Body Example:
```json
{
    "verify": true,
    "noMatch": []
}
```

#### Erro

Status: 422<br>
Content-Type: application/json<br>
Body Example:
```json
{
    "verify": false,
    "noMatch": ["noRepeted"]
}
```