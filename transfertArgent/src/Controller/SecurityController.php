<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")

     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if(isset($values->username,$values->password)) {
            $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setNom($values->nom);
            $user->setTel($values->tel);
            $user->setAdresse($values->adresse);
            $user->setRoles($values->roles);
            $errors = $validator->validate($user);
            if(count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password'
        ];
        return new JsonResponse($data, 500);
    }

    /**
     * @Route("/login", name="login", methods={"POST"})
     
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }
        // public function block(Request $request, User $user,  EntityManagerInterface $entityManager,SerializerInterface $serializer, ValidatorInterface $validator)
        // {
        //     $userUpdate=$entityManager->getRepository (User::class)->find($user->getId());
        //     $values = json_decode($request->getContent());
        //     $user->getNom($values->nom);
        //     $user->getTel($values->tel);
        //     $user->getAdresse($values->adresse);

        //     if($user->getStatut()=="BLOQUER")
        //     {
        //         $userUpdate->setStatut("DEBLOQUER");
        //     }else{
        //         $userUpdate->setStatut("BLOQUER");
        //     }
        //     $Statut=$values->Statut;
        //     if($Statut=="DEBLOQUER")
        //     {
        //         $roles=["ROLE_BLOQUE"];
        //     }
        //     else{
        //         $roles=$user->getStatut();
        //     }
        //     $user->setRoles($roles);
        //     $errors=$validator->validate($userUpdate);
        //     if(count($errors)){
        //          $errors = $serializer->serialize($errors,'json');
        //          return new Response($errors,500,[
        //              'Content-Type' => 'application/json'
        //          ]);
        //     }
        //     $entityManager->flush();
        //     $data = [
        //         'status' => 201,
        //         'message'=> 'user where muted'
        //     ];

        // }
}
