<?php

namespace App\Controller;

use App\Entity\CentroDistribuicao;
use App\Entity\PostoColeta;
use App\Entity\Usuario;
use App\Form\CentroDistribuicaoType;
use App\Form\PostoColetaType;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    const TYPE_POSTO_COLETA = 1;
    const TYPE_CENTRO_DISTRIBUICAO = 2;

    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserAuthenticatorInterface $userAuthenticator, FormLoginAuthenticator $formAuthenticator): Response
    {
        $user = new Usuario();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            if($form->get('type')->getData() !== self::TYPE_POSTO_COLETA && $form->get('type')->getData() !== self::TYPE_CENTRO_DISTRIBUICAO)
            {
                $this->addFlash('error', 'Tipo inválido');
                return $this->redirectToRoute('app_register');
            }

            switch ($form->get('type')->getData()) {
                case self::TYPE_POSTO_COLETA:
                    $user->setRoles([Usuario::ROLE_POSTO_COLETA]);
                case self::TYPE_CENTRO_DISTRIBUICAO:
                    $user->setRoles([Usuario::ROLE_CENTRO_DISTRIBUICAO]);
                    break;
            }

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('suporte@ajudatche.com', 'Suporte'))
                    ->to($user->getEmail())
                    ->subject('Verifique seu e-mail')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $formAuthenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Seu e-mail foi verificado com sucesso!');

        return $this->redirectToRoute('index_route');
    }


    
    #[Route('/admin/register/centro-distribuicao', name: 'user_register_centro_distribuicao')]
    public function registerCentroDistribuicao(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $this->denyAccessUnlessGranted(Usuario::ROLE_CENTRO_DISTRIBUICAO);
        $user = $security->getUser();

        $centroDistribuicao = new CentroDistribuicao();
        $form = $this->createForm(CentroDistribuicaoType::class, $centroDistribuicao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centroDistribuicao->setUsuario($user);
            $entityManager->persist($centroDistribuicao);
            $entityManager->flush();

            return $this->redirectToRoute('app_posto_coleta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centro_distribuicao/new-user.html.twig', [
            'centro_distribuicao' => $centroDistribuicao,
            'form' => $form,
        ]);

    }

    #[Route('/admin/register/posto-coleta', name: 'user_register_posto_coleta')]
    public function registerPostoColeta(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $this->denyAccessUnlessGranted(Usuario::ROLE_POSTO_COLETA);

        $user = $security->getUser();

        $postoColeta = new PostoColeta();
        $form = $this->createForm(PostoColetaType::class, $postoColeta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postoColeta->setUsuario($user);
            $entityManager->persist($postoColeta);
            $entityManager->flush();

            return $this->redirectToRoute('app_posto_coleta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posto_coleta/new-user.html.twig', [
            'posto_coletum' => $postoColeta,
            'form' => $form,
        ]);
    }

}
