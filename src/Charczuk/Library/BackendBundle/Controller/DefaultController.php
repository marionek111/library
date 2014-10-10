<?php

namespace Charczuk\Library\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/{username}/salt", requirements={"username" = "\w+"})
     */
    public function saltAction($username)
    {
//        $userManager = $this->container->get('fos_user.user_manager');
//
//        $user = $userManager->findUserByUsername($username);
//        if ( is_null($user) )
//        {
//            throw new HttpException(400, "Error User Not Found");
//        }
        return new JsonResponse(array('salt' => "pw4qmcjcp1wog0wcsoosowg8wg4kg8k"));
    }

    /**
     * @Route("/{username}/info", requirements={"username" = "\w+"})
     */
    public function infoAction($username)
    {
//        $userManager = $this->container->get('fos_user.user_manager');
//
//        $user = $userManager->findUserByUsername($username);
//        if ( is_null($user) )
//        {
//            throw new HttpException(400, "Error User Not Found");
//        }
        return new JsonResponse(array('username' => array('salt' => "pw4qmcjcp1wog0wcsoosowg8wg4kg8k")));
    }

}
