<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Teste fullstack Paytour - Laravel

Teste desenvolvido com Laravel.
Foi utilizado Breeze para autenticação e Tailwind para o CSS.

Para rodar o sistema, faça o clone do repositório, copie o .env.example e altere as informações necessárias.  
Foi utilizado como padrão o Postgresql com a database "paytour", mas fica à critério.

Depois de configurado o .env do projeto, rode os comandos:  
`composer install`  
`npm run dev` para rodar o tailwind  
`php artisan migrate --seed` será necessário para preencher a tabela de escolaridade

Para rodar os testes:  
`php artisan test`

Foi mantido os testes padrões do sistema assim como os de autenticação gerados automaticamente pelo Breeze.

## Mailer

Para o envio de email funcionar corretamente, deve-se preencher as variáveis do env com as próprias informações.  
Para o teste foi utilizado o serviço do [Google](https://support.google.com/mail/answer/185833?hl=en).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
