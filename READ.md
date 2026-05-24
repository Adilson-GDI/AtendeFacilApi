
ssh root@31.97.93.136
senha:Fc0aFWf'RPONn'q0k9.w


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