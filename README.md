<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

# ProjectHelpDesk 🛟

**ProjectHelpDesk** é um esboço de um sistema simples de help desk, criado com o framework Yii2. O objetivo deste projeto é servir como base para futuras melhorias e funcionalidades, demonstrando conceitos fundamentais de organização, relacionamento entre modelos e exibição de dados.

## ⚙️ Tecnologias Utilizadas

- [Yii2 Framework](https://www.yiiframework.com/)
- PHP 8.x
- MySQL
- HTML/CSS (Bootstrap integrado pelo Yii)
- XAMPP (ambiente local de desenvolvimento)

## 📁 Estrutura do Projeto

Este projeto segue a estrutura avançada do Yii2, com separação clara entre frontend, backend e common:

advanced/
├── backend/ # Painel administrativo (CRUD dos chamados)
├── common/ # Modelos compartilhados e configurações
├── console/ # Scripts de console
├── frontend/ # (não utilizado no momento)
├── migrations/ # Migrations do banco de dados


## 📌 Funcionalidades até o momento

- Cadastro de projetos (chamados)
- Visualização detalhada dos chamados
- Upload e exibição de imagens relacionadas ao chamado (simulado)
- Campos como nome, descrição, stack tecnológica e data de início

## 🧱 Estrutura do Model Principal

O model `Project` contém campos como:

- `id`
- `name`
- `description`
- `tech_stack`
- `start_date`
- Relacionamento com imagens (`hasMany`)

## 🔧 Instalação e Uso

1. Clone o repositório:

bash
`git clone https://github.com/seu-usuario/ProjectHelpDesk.git`

2. Configure seu ambiente local com o XAMPP ou outro servidor Apache/MySQL.

3. Importe o banco de dados (caso haja um arquivo .sql incluído).

4. Instale as dependências via Composer:
    `composer install`

5. Ajuste o arquivo common/config/main-local.php com suas credenciais do banco de dados.

6. Acesse pelo navegador:
   `http://localhost/advanced/backend/web`

🚧 Status do Projeto
Este projeto ainda está em desenvolvimento e não está completo. Ele serve como esboço inicial para estudo, testes e estruturação de futuras funcionalidades.

🤝 Contribuições
Contribuições são bem-vindas! Sinta-se à vontade para abrir issues, enviar pull requests ou sugerir melhorias.


