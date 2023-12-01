# cliente-feliz-v2
 
### Instalando o projeto

Considerando que o PHP 7.2.5 e o Composer estão devidamente instalados na máquina, siga os passos:

Clone o projeto em uma pasta
```
git clone https://github.com/andreycmartins/cliente-feliz-v2.git
```
Entre na pasta do projeto
```
cd cliente-feliz-v2/
```
Crie os arquivos .env
```
cp .env.example .env
```

Abra o arquivo .env em algum editor de texto e configure corretamente as variáveis que se iniciam com DB (relacionadas à conexão do seu banco de dados) e as variáveis que se iniciam com MAIL (relacionadas ao envio/recebimento de emails) entro do .env.

instale o composer na pasta do projeto
```
composer install
```
Crie a chave do laravel
```
php artisan key:generate
```
Crie as tabelas do banco de dados
```
php artisan migrate
```
Inicie o servidor com o projeto
```
php artisan serve
```
Desta forma, o projeto estará rodando no host padrão, que é 127.0.0.1 e a porta 8000

---

### Configurando o domnínio cliente-sonavoip.local

<h3>Windows:</h3>

Abra o bloco de notas ou qualquer editor de texto como administrador<br>
No editor de texto, abra o arquivo de hosts localizado em
```
C:\Windows\System32\drivers\etc\hosts
```
Adicione uma linha no final do arquivo com o seguinte formato: 
```
127.0.0.1  cliente-sonavoip.local
```
Salve o arquivo<br>
<h3>MacOS e Linux:</h3>

Abra o Terminal<br>
Execute o seguinte comando para abrir o arquivo de hosts: 
```
sudo nano /etc/hosts
```
Insira a senha de administrador quando solicitado<br>
Adicione uma linha no final do arquivo com o seguinte formato: 
```
127.0.0.1  cliente-sonavoip.local
```
Salve o arquivo<br>
Pressione Ctrl + X para sair do editor nano<br>

Desta forma, o projeto estará pronto para ser iniciado com o ```php artisan serve``` e ser acessado pelo ```cliente-sonavoip.local```