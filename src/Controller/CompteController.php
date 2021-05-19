<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\User;
use App\Entity\Utilisateur;
use App\Form\ComptePhotoType;
use App\Form\InscriptionType;
use App\Form\PhotoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CompteController extends AbstractController
{ /**
 * @Route("/user/api/login", name="user_login")
 */
    public function login(Request $request): Response
    {
        $email = $request->query->get('email');
        $password = $request->query->get('password');

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($user) {

            if (password_verify($password, $user->getPassword())) {


                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize($user);
                return new JsonResponse($formatted);
            } else {
                //password not found
                return new Response("pass");
            }
        } else {
            //email not found
            return new Response("failed");
        }
    }

    /**
     * @Route("/user/api/signup", name="user_signup")
     */
    public function signUp(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $email = $request->query->get('email');
        $password = $request->query->get('password');
        $firstName = $request->query->get('firstName');
        $lastName = $request->query->get('lastName');

        //test addresse lazm bl @
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return new Response("email invalide");
        }
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return new JsonResponse("compte cree", 200);
        } catch (\Exception $ex) {
            return new Response("exception" . $ex->getMessage());
        }
    }

    /**
     * @Route("/user/api/findemail", name="user_find")
     */
    public function findByEmail(Request $request, NormalizerInterface $Normalizer)
    {

        $email = $request->query->get('email');

        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findBy(array(['email' => $email]));
        $jsonContent = $Normalizer->normalize($user, 'json');

        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/compte", name="compte")
     */
    public function index()
    {

        return $this->render('compte/index.html.twig');



        }



    /**
     * @Route("/compte/photo", name="ajouterphoto")
     */
    public function ajouterPhoto(Request $request): Response
    {

        $form = $this->createForm(PhotoType::class, $this->getUser());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $file = $this->getUser()->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $this->getUser()->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($this->getUser());
            $em->flush();


        }
        return $this->render('compte/photo.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
