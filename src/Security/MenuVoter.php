<?php

// src/Security/PostVoter.php
namespace App\Security;

use App\Entity\Usuario;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class MenuVoter extends Voter
{
    const VIEW_MENU_CATEGORIAS = 'VIEW_CATEGORIAS';
    const VIEW_MENU_PRODUTOS = 'VIEW_PRODUTOS';
    const VIEW_MENU_ENTREGAS = 'VIEW_ENTREGAS';
    const VIEW_MENU_MOTORISTAS = 'VIEW_MOTORISTAS';
    const VIEW_MENU_PRODUTOS_NECESSARIO = 'VIEW_PRODUTOS_NECESSARIOS';
    const VIEW_MENU_PRODUTO_POSTO = 'VIEW_PRODUTO_POSTO';
    const VIEW_MENU_POSTO_COLETA = 'VIEW_POSTO_COLETA';
    const VIEW_MENU_CENTRO_DISTRIBUICAO = 'VIEW_CENTRO_DISTRIBUICAO';

    const VIEW_MENU_FUNCAO = 'VIEW_FUNCAO';



    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (in_array($attribute, [self::VIEW_MENU_CATEGORIAS, self::VIEW_MENU_PRODUTOS, self::VIEW_MENU_ENTREGAS, self::VIEW_MENU_MOTORISTAS, self::VIEW_MENU_PRODUTOS_NECESSARIO, self::VIEW_MENU_PRODUTO_POSTO, self::VIEW_MENU_POSTO_COLETA, self::VIEW_MENU_CENTRO_DISTRIBUICAO, self::VIEW_MENU_FUNCAO])) {
            return true;
        }
        return false;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof Usuario) {
            // the user must be logged in; if not, deny access
            return false;
        }

        if ($user->hasRole('ROLE_ADMIN')) {
            return true;
        }

        if ($user->hasRole(Usuario::ROLE_CENTRO_DISTRIBUICAO) && in_array($attribute, [self::VIEW_MENU_CATEGORIAS, self::VIEW_MENU_PRODUTOS, self::VIEW_MENU_PRODUTOS_NECESSARIO, self::VIEW_MENU_CENTRO_DISTRIBUICAO, self::VIEW_MENU_FUNCAO])) {
            return true;
        }

        if ($user->hasRole(Usuario::ROLE_POSTO_COLETA) && in_array($attribute, [self::VIEW_MENU_CATEGORIAS, self::VIEW_MENU_PRODUTOS, self::VIEW_MENU_PRODUTO_POSTO, self::VIEW_MENU_ENTREGAS, self::VIEW_MENU_MOTORISTAS, self::VIEW_MENU_POSTO_COLETA, self::VIEW_MENU_FUNCAO])) {
            return true;
        }

        if ($user->hasRole(Usuario::ROLE_ABRIGO) && in_array($attribute, [self::VIEW_MENU_CATEGORIAS, self::VIEW_MENU_PRODUTOS, self::VIEW_MENU_PRODUTO_POSTO, self::VIEW_MENU_ENTREGAS, self::VIEW_MENU_MOTORISTAS, self::VIEW_MENU_FUNCAO])) {
            return true;
        }

        return false;
    }

   
}