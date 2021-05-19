<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager =$entityManager;
    }


    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $notification = null;
        $user= new User();
        $form=$this->createForm(InscriptionType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

            $user = $form->getData();
            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());
            if(!$search_email){
                $password = $encoder->encodePassword($user,$user->getPassword());


                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $mail = new Mail();
                $content ="Bonjour".$user->getFirstname()."<br/>Bienvenue sur Tuneasy.<br></br>";
                $mail->send($user->getEmail(),$user->getFirstname(),'Activation Mail',$content);
                $notification="Votre inscription s'est correctement déroulée. Vous pouvez dès à présent vous connecter à votre compte.";
            }else {
                $notification=" Oups l'email que vous avez renseigné existe déja!!";

            }






        }

        return $this->render('inscription/index.html.twig',
            ['form' => $form->createView(),
            'notification'=>$notification
        ]

        );
    }
}