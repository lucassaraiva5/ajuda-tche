<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\CentroDistribuicaoRepository;
use App\Repository\PostoAjudaRepository;
use App\Repository\PostoColetaRepository;
use App\Repository\VoluntarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    const FIRST_INDEX_ARRAY = 0;

    #[Route('/', name: 'index_route', methods: ['GET','POST'])]
    public function defaultRoute(Security $security)
    {
        if($security->getUser()) {
            return $this->redirectToRoute('app_categoria_index');
        }
        return $this->redirectToRoute('app_login');
    }

    #[Route('/login', name: 'app_login', methods: ['GET','POST'])]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/admin', name: 'user_redirect', methods: ['GET'])]
    public function indexRouteAfterLogin(Security $security, PostoAjudaRepository $postoAjudaRepository, VoluntarioRepository $voluntarioRepository) : Response
    {
        $user = $security->getUser();
        $role = $user->getRoles();

        if (!$user instanceof Usuario) {
            throw new \LogicException('User is not an instance of Usuario.');
        }

        if($user->hasRole(Usuario::ROLE_ADMIN)){
            return $this->redirectToRoute("app_produto_necessario_index");
        }

        if($user->hasRole(Usuario::ROLE_ADMIN_POSTO_AJUDA)) {
            $postoAjuda = $postoAjudaRepository->findOneByUsuarioResponsavel($user);
            if(empty($postoAjuda)) {
                return $this->redirectToRoute("user_register_posto_ajuda");
            }
            return $this->redirectToRoute("app_produto_posto_index");
        }

        if($user->hasRole(Usuario::ROLE_VOLUNTARIO)) {
            $voluntario = $voluntarioRepository->findOneByUsuario($user);
            if(empty($voluntario)) {
                return $this->redirectToRoute("user_register_voluntario");
            }
            return $this->redirectToRoute("app_login");
        }

        return $this->redirectToRoute("app_login");

    }
}
