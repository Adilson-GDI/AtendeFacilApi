
ssh root@31.97.93.136
senha:Fc0aFWf'RPONn'q0k9.w

ssh-keygen -t ed25519 -C "adilson.gditecnologia@gmail.com"



CREATE USER 'admin'@'%' IDENTIFIED BY 'Lcrc253647mj_';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;


INSERT INTO users (
    name,
    email,
    password,
    created_at,
    updated_at
) VALUES (
    'adilson.pina',
    'adilson.pina@aspti.com.br',
    '$2y$12$B0PD/wzA49Hs7Ihwu/D8xepEAA9HpwBqMWRprJw2T8x2eLYLcmaOu',
    NOW(),
    NOW()
);


composer create-project laravel/laravel .


Para API com autenticação via token, instalar Sanctum
composer require laravel/sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

php artisan migrate

php artisan install:api


php artisan make:model Empresa
php artisan make:model Usuario
php artisan make:model Cliente
php artisan make:model Projeto
php artisan make:model ProjetoAmbiente
php artisan make:model ProjetoBriefing
php artisan make:model ProjetoEtapa
php artisan make:model ProjetoTarefa
php artisan make:model VisitaTecnica
php artisan make:model Fornecedor
php artisan make:model ProjetoFornecedor
php artisan make:model ProjetoFinanceiro
php artisan make:model Arquivo
php artisan make:model ProjetoAnotacao
php artisan make:model ModuloConfig



php artisan make:controller Api/EmpresaController --api
php artisan make:controller Api/AuthController
php artisan make:controller Api/ClienteController --api
php artisan make:controller Api/ProjetoController --api
php artisan make:controller Api/ProjetoAmbienteController --api
php artisan make:controller Api/ProjetoBriefingController --api
php artisan make:controller Api/ProjetoEtapaController --api
php artisan make:controller Api/ProjetoTarefaController --api
php artisan make:controller Api/VisitaTecnicaController --api
php artisan make:controller Api/FornecedorController --api
php artisan make:controller Api/ProjetoFornecedorController --api
php artisan make:controller Api/ProjetoFinanceiroController --api
php artisan make:controller Api/ArquivoController
php artisan make:controller Api/ProjetoAnotacaoController --api
php artisan make:controller Api/DashboardController

php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/EmpresaController --resource
php artisan make:controller Admin/UsuarioController --resource
php artisan make:controller Admin/ClienteController --resource
php artisan make:controller Admin/ProjetoController --resource
php artisan make:controller Admin/FornecedorController --resource
php artisan make:controller Admin/FinanceiroController --resource
php artisan make:controller Admin/ArquivoController --resource

New-Item app\Services\AuthService.php
New-Item app\Services\EmpresaService.php
New-Item app\Services\ClienteService.php
New-Item app\Services\ProjetoService.php
New-Item app\Services\ProjetoAmbienteService.php
New-Item app\Services\ProjetoBriefingService.php
New-Item app\Services\ProjetoEtapaService.php
New-Item app\Services\ProjetoTarefaService.php
New-Item app\Services\VisitaTecnicaService.php
New-Item app\Services\FornecedorService.php
New-Item app\Services\ProjetoFinanceiroService.php
New-Item app\Services\ArquivoService.php
New-Item app\Services\DashboardService.php