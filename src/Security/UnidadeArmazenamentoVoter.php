<?php

namespace App\Security;

use App\Entity\Usuario;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UnidadeArmazenamentoVoter extends Voter
{
    const CAN_ADD = 'UNIDADE_ARMAZENAMENTO_ADD';
    const CAN_EDIT = 'UNIDADE_ARMAZENAMENTO_EDIT';
    const CAN_DELETE = 'UNIDADE_ARMAZENAMENTO_DELETE';


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
            // the user must be logged in; if not, deny access
            return false;
        }

        if ($user->hasRole('ROLE_ADMIN')) {
            return true;
        }

        return false;
    }

   
}