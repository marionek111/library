<?php

namespace Charczuk\Library\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/hello")
     */
    public function helloAction()
    {
        return new JsonResponse(array('world' => 'world'));
    }

    /**
     * @Route("/books")
     */
    public function booksAction()
    {
        $arrToEncode = array(array(
            'id'=>1,
            'name'=>"Dynamo",
            'author'=>"Dynamo",
            'yearRelease'=>2012,
            'publisher'=>"WSIP",
            'description'=>"Nauka Magii i sztuczek magicznych"
        ), array(
            'id'=>2,
            'name'=>"Java EE",
            'author'=>"Jendrock Evans",
            'yearRelease'=>2005,
            'publisher'=>"Helion",
            'description'=>"Podstawy programowania obiektowego w języku JAVA EE"
        ), array(
            'id'=>3,
            'name'=>"Cyfrowa Twierdza",
            'author'=>"Dan Brown",
            'yearRelease'=>1997,
            'publisher'=>"Pióro",
            'description'=>"Opowiesć o superkomputerze który potrafi złamać karzdy szyfr który natrafił na ściane nie do przebicia"
        ));
        return new JsonResponse($arrToEncode);
    }
}
