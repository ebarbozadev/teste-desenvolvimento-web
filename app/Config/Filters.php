<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'     => \CodeIgniter\Filters\CSRF::class,
        'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'auth'     => \App\Filters\AuthFilter::class,  // Adicione esta linha
    ];

    public array $globals = [
        'before' => [
            // 'auth', // Descomente esta linha se desejar que todas as rotas usem o filtro de autenticação
        ],
        'after'  => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}
