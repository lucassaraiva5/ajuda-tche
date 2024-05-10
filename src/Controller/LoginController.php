<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\CentroDistribuicaoRepository;
use App\Repository\PostoColetaRepository;
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
    public function indexRouteAfterLogin(Security $security, PostoColetaRepository $postoColetaRepository, CentroDistribuicaoRepository $centroDistribuicaoRepository)
    {
        $user = $security->getUser();
        $role = $user->getRoles();
        
        switch ($role[self::FIRST_INDEX_ARRAY]) {
            case Usuario::ROLE_POSTO_COLETA:
                $posto = $postoColetaRepository->findOneByUsuario($user);
                if(empty($posto)) {
                    return $this->redirectToRoute("user_register_posto_coleta");
                }else{
                    return $this->redirectToRoute("app_produto_posto_index");
                }
                break;
            
            case Usuario::ROLE_CENTRO_DISTRIBUICAO:
                $centroDistribuicao = $centroDistribuicaoRepository->findOneByUsuario($user);
                if(empty($centroDistribuicao)) {
                    return $this->redirectToRoute("user_register_centro_distribuicao");
                }else {
                    return $this->redirectToRoute("app_produto_necessario_index");
                }
                break;
            
            case Usuario::ROLE_ADMIN:
                # code...
                break;
        }

        return $this->redirectToRoute("user_redirect");

    }
}
