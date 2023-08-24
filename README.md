# Teste - Desenvolvedor Full Stack | Laravel + Vue | Pleno

Neste projeto, foi desenvolvida uma aplicação de encurtamento de links, similar ao serviço conhecido como [bit.ly](https://laravel.com/docs/10.x/sail){:target="_blank"}. O desafio envolveu a criação de um frontend utilizando Vue.js, um backend com Laravel e a utilização de um banco de dados relacional (MySQL/MariaDB). O foco foi garantir a utilização das melhores práticas de programação, design patterns e construção de um código limpo e bem estruturado.

## Guia de Instalação

Este guia descreve os passos necessários para instalar e configurar a aplicação, que utiliza o [Laravel Sail](https://laravel.com/docs/10.x/sail){:target="_blank"} para o backend e Vue.js 3 com Vite para o frontend. Certifique-se de seguir cada etapa cuidadosamente para garantir uma instalação bem-sucedida.

Caso esteja no Windows acesse a [documentação](https://laravel.com/docs/10.x/installation#getting-started-on-windows){:target="_blank"} do Laravel para mais informações.

## Pré-requisitos

Antes de começar, certifique-se de ter o seguinte instalado no seu sistema:

- [Docker](https://www.docker.com/get-started){:target="_blank"}
- [Git](https://git-scm.com/){:target="_blank"}
- [Composer](https://getcomposer.org/){:target="_blank"}
- [Node.js](https://nodejs.org/){:target="_blank"}

# Passos de Instalação

### 1. Clone Repositório

Clone o repositório da aplicação a partir do repositório Git:

```sh
git clone https://github.com/VandoJunqueira/Teste_Desenvolvedor_Full_Stack_Laravel.git
```

### 2. Instalar as Dependências do Backend

Navegue até o diretório da aplicação clonada e instale as dependências do backend usando o Composer:

```sh
cd Teste_Desenvolvedor_Full_Stack_Laravel
composer install
```

### 3. Configurar o Arquivo .env

Duplique o arquivo .env.example e renomeie-o para .env.

```sh
cp .env.example .env
```

### 4. Iniciar o Laravel Sail

Se tiver no windows acessa o terminar do Linux com o comando `wsl`

```sh
./vendor/bin/sail up -d
```

No entanto, em vez de digitar repetidamente `vendor/bin/sail` para executar comandos do Sail, você pode configurar um alias de shell que permita executar os comandos do Sail com mais facilidade:

```sh
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Depois que o alias do shell tiver sido configurado, você poderá executar comandos Sail simplesmente digitando `sail`. O restante dos exemplos desta documentação assumirá que você configurou este alias:

```sh
sail up -d
```

### 5. Executar migração

```sh
sail artisan migrate
```

### 6. Executar o seeder para popular a tabela

```sh
sail artisan db:seed
```

### 7. Instalar as Dependências do Frontend

```sh
sail npm install
```

### 8. Compilar o Frontend

```sh
sail npm run build
```

### 9. Acessar a Aplicação

Abra o seu navegador e acesse [http://localhost](http://localhost){:target="_blank"} para visualizar a aplicação em funcionamento.
