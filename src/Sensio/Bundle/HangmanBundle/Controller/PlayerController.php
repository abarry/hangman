<?php

namespace Sensio\Bundle\HangmanBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\HangmanBundle\Entity\Player;
use Sensio\Bundle\HangmanBundle\Form\PlayerType;

/**
 *
 *
 */
class PlayerController extends Controller
{
    /**
     *
     * @Route("/registration", name="registration")
     * @Template()
     */
    public function registrationAction(Request $request)
    {
        $player = new Player();
        $form = $this->createForm(new PlayerType(), $player);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($player);
                $em->flush();

                return $this->redirect($this->generateUrl('hangman_game'));
            }
        }

        return array('form' => $form->createView());
    }

    /**
     *
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
        );
    }

}
