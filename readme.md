# Processo seletivo Super Lógica - PHP

Este repositório foi criado para o processo seletivo da vaga de PHP da empresa Super Lógica
## Instalação

Apesar deste projeto já incluir a pasta vendor para facilitar a instalação, o avaliador pode escolher instalar todas as dependências do zero através do composer executando na pasta raiz do projeto.

```bash
sudo composer update
```

```bash
sudo composer install
```

## Como usar

```
1) Todos os exercícios seguem a nomenclatura -> exec + Número do exercício
- Exemplo: exec1.php ; exec2.php ...
2) No exercício 2, é possível ativar o modo debug direto do browser
alterando a variável debugMode false para debugMode true na função console
3) É possível testar código de testes digitando na pasta raiz:
vendor/bin/phpunit
```

## Agradecimentos e observações
Agradeço toda a equipe da Super Lógica por esta experiência, e espero ter a oportunidade de falarmos sobre o código, do motivo de não usar o DBUnit e outros assuntos.

