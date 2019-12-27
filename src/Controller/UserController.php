<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        //create form
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        //populate object with form data

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //modify object in order to save it
            $user->setRole('ROLE_USER');
            $user->setCreatedAt(new \Datetime('now'));
            // var_dump($date_now);
            // die;

            //encode paswword
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            // var_dump($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('tasks');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
