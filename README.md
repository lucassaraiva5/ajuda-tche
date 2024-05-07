# Ajuda Tche

## Requisitos do projeto
- PHP 8.1+ (https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe)
- Docker (https://docs.docker.com/desktop/install/windows-install/)
- Composer (https://getcomposer.org/download/)

## Video de como instalar isso na sua maquina
Como instalar o composer + PHP (Windows) - https://youtu.be/L87PtpSF4gU
Como instalar o docker (Windows) - https://youtu.be/H3yP3jz3dZU

## Como iniciar o projeto


Clone o projeto
```
git clone https://github.com/lucassaraiva5/ajuda-tche
```

Navegue até a pasta onde foi clonado o projeto e execute:

```
composer install
docker-compose up -d
php bin/console doctrine:migrations:migrate
```
