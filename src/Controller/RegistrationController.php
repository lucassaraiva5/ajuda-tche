<?php

namespace App\Controller;

use App\Entity\CentroDistribuicao;
use App\Entity\PostoAjuda;
use App\Entity\PostoColeta;
use App\Entity\Usuario;
use App\Entity\Voluntario;
use App\Form\CentroDistribuicaoType;
use App\Form\PostoAjudaType;
use App\Form\PostoColetaType;
use App\Form\RegistrationFormType;
use App\Form\VoluntarioType;
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
    const TYPE_POSTO_COLETA_OU_CD = 1;
    const TYPE_VOLUNTARIO = 2;

    const POSTO_AJUDA_TIPO_ROLE = [
        'Posto de Coleta' => Usuario::ROLE_POSTO_COLETA,
        'Centro de Distribuição' => Usuario::ROLE_CENTRO_DISTRIBUICAO,
        'Abrigo' => Usuario::ROLE_ABRIGO,
    ];

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

            if($form->get('type')->getData() !== self::TYPE_POSTO_COLETA_OU_CD &&
                $form->get('type')->getData() !== self::TYPE_VOLUNTARIO)
            {
                $this->addFlash('error', 'Tipo inválido');
                return $this->redirectToRoute('app_register');
            }

            switch ($form->get('type')->getData()) {
                case self::TYPE_POSTO_COLETA_OU_CD:
                    $user->setRoles([Usuario::ROLE_ADMIN_POSTO_AJUDA]);
                    break;
                case self::TYPE_VOLUNTARIO:
                    $user->setRoles([Usuario::ROLE_VOLUNTARIO]);
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

        $this->addFlash('success', 'Seu e-mail foi verificado com sucesso!');

        return $this->redirectToRoute('index_route');
    }


    
    #[Route('/admin/register/posto-ajuda', name: 'user_register_posto_ajuda')]
    public function registerPostoAjuda(Request $request, EntityManagerInterface $entityManager, Security $security, UserAuthenticatorInterface $userAuthenticator, FormLoginAuthenticator $formAuthenticator): Response
    {
        $this->denyAccessUnlessGranted(Usuario::ROLE_ADMIN_POSTO_AJUDA);
        $user = $security->getUser();

        $postoAjuda = new PostoAjuda();
        $form = $this->createForm(PostoAjudaType::class, $postoAjuda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postoAjuda->setUsuarioResponsavel($user);

            $tipoPostoAjudaArray = $postoAjuda->getTipoPostoAjuda();
            $user->setPostoAjuda($postoAjuda);
            foreach($tipoPostoAjudaArray as $tipoPostoAjuda){
                $role = self::POSTO_AJUDA_TIPO_ROLE[$tipoPostoAjuda->getDescricao()];
                $user->addRole($role);
            }

            $entityManager->persist($postoAjuda);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $user,
                $formAuthenticator,
                $request
            );
        }

        return $this->render('posto_ajuda/new-user.html.twig', [
            'posto_ajuda' => $postoAjuda,
            'form' => $form,
        ]);

    }

    #[Route('/admin/register/voluntario', name: 'user_register_voluntario')]
    public function registerVoluntario(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $this->denyAccessUnlessGranted(Usuario::ROLE_VOLUNTARIO);

        $user = $security->getUser();

        $voluntario = new Voluntario();
        $form = $this->createForm(VoluntarioType::class, $voluntario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voluntario->setUsuario($user);
            $entityManager->persist($voluntario);
            $entityManager->flush();

            return $this->redirectToRoute('app_posto_coleta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voluntario/new-user.html.twig', [
            'voluntario' => $voluntario,
            'form' => $form,
        ]);
    }

}
