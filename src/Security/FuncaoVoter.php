<?php

namespace App\Security;

use App\Entity\Usuario;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class FuncaoVoter extends Voter
{
    const CAN_ADD = 'FUNCAO_ADD';
    const CAN_EDIT = 'FUNCAO_EDIT';
    const CAN_DELETE = 'FUNCAO_DELETE';


    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (in_array($attribute, [self::CAN_EDIT, self::CAN_DELETE, self::CAN_ADD])) {
            return true;
        }

        return false;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof Usuario) {
            return false;
        }

        if ($user->hasRole('ROLE_ADMIN')) {
            return true;
        }

        if ($user->hasRole(Usuario::ROLE_ADMIN_POSTO_AJUDA)) {
            return true;
        }

        return false;
    }

   
}