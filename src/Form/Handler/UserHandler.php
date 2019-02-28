<?php

namespace App\Form\Handler;

use App\Entity\Users;
use App\Model\Users as UserModel;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Description of userHandler
 *
 * @author julien
 */
class UserHandler {
    
    /*
     * @var ObjectManager
     */
    private $objectManager;
    
    /*
     * @var LoggerInterface
     */
    private $loggerInterface;
    
    
    public function __construct(ObjectManager $objectManager, LoggerInterface $loggerInterface)
    {
        $this->objectManager = $objectManager;
        $this->loggerInterface = $loggerInterface;
    }
    
    public function handle(FormInterface $form, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            /*
             * @var UserModel $userModel
             */
            $userModel = $form->getData();
            
            /*
             * @var Users $users
             */
            $users = new Users();
            $users->setUsername($userModel->username);
            $users->setEmail($userModel->email);
            $users->setPassword($userModel->password);
            $users->setRoles(['ROLE_USER']);
            
            $passEncoded = $encoder->encodePassword($users, $userModel->password);
            $users->setPassword($passEncoded);
            
            try {
                $this->objectManager->persist($users);
            } catch (ORMException $e) {
                $this->loggerInterface->error($e->getMessage());
                $form->addError(new FormError("Erreur pendant l'enregistrement."));
                return false;
            }
            
            $this->objectManager->flush();
            
            return true;
            }
        return false;
    }
    
}
