<?php

// src/Security/PostVoter.php
namespace App\Security;

use App\Entity\CentroDistribuicao;
use App\Entity\PostoColeta;
use App\Entity\Usuario;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CentroDistribuicaoVoter extends Voter
{
    const CAN_EDIT = 'CENTRO_DISTRIBUICAO_EDIT';
    const CAN_DELETE = 'CENTRO_DISTRIBUICAO_DELETE';



    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (in_array($attribute, [self::CAN_EDIT, self::CAN_DELETE])) {
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

        if ($user->hasRole(Usuario::ROLE_CENTRO_DISTRIBUICAO)) {
            if($subject instanceof CentroDistribuicao) {
                if($subject->getUsuario() && $subject->getUsuario()->getId() === $user->getId()) {
                    return true;
                }
            }
        }

        return false;
    }

   
}