#!/bin/bash

# Para de executar o script se algum comando falhar
set -e

# Instala dependências do Composer
echo "Instalando dependências do Composer..."
composer install

# Verifica se o comando anterior foi bem-sucedido
if [ $? -ne 0 ]; then
    echo "Falha ao instalar as dependências do Composer."
    exit 1
fi

echo "Dependências instaladas com sucesso."

# Executa migrações do Doctrine
echo "Executando migrações do Doctrine..."
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:migrations:migrate --no-interaction

# Verifica se o comando anterior foi bem-sucedido
if [ $? -ne 0 ]; then
    echo "Falha ao executar as migrações do Doctrine."
    exit 1
fi

echo "Migrações executadas com sucesso."