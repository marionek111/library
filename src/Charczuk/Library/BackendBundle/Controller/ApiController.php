<?php

namespace Charczuk\Library\BackendBundle\Controller;

use Charczuk\Library\BackendBundle\Entity\Books;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api")
 */
class ApiController extends AppController
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
        $repositoryBook = $this->getDoctrine()->getRepository('LibraryBackendBundle:Books');
        $bookRows = $repositoryBook->findAll();

        if (!$bookRows) {
            throw $this->createNotFoundException("No books found");
        }

        $arrToEncode = array();
        foreach ($bookRows as $book) {
            $arrToEncode[] = $this->bookToArray($book);
        }

        return new JsonResponse($arrToEncode);
    }

    /**
     * @Route("/addBook")
     */
    public function addBookAction()
    {
        if(! $this->hasParams(array('data'))) throw new \Exception('One or more required parameters not Found');
        $data = $this->getRequest()->request->get('data');

        if ($this->getRequest()->isMethod('POST')) {
            $book = new Books();
            $book->setName($data['name'])
                ->setAuthor($data['author'])
                ->setYearRelease($data['yearRelease'])
                ->setPublisher($data['publisher'])
                ->setDescription($data['description']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

        }

        return new JsonResponse(self::bookToArray($book));
    }

    /**
     * @Route("/editBook/{id}")
     */
    public function editBookAction($id)
    {
        if(! $this->hasParams(array('data'))) throw new \Exception('One or more required parameters not Found');

        $em = $this->getDoctrine()->getManager();
        $bookRow = $em->getRepository('LibraryBackendBundle:Books')->find($id);
        if (!$bookRow) {
            throw $this->createNotFoundException('No book found for id '.$id);
        }

        $data = $this->getRequest()->request->get('data');

        $bookRow->setName($data['name'])
            ->setAuthor($data['author'])
            ->setYearRelease($data['yearRelease'])
            ->setPublisher($data['publisher'])
            ->setDescription($data['description']);
        $em->flush();

        return new JsonResponse(self::bookToArray($bookRow));
    }

    /**
     * @Route("/removeBook/{id}")
     */
    public function removeBookAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $bookRow = $em->getRepository('LibraryBackendBundle:Books')->find($id);
        if (!$bookRow) {
            throw $this->createNotFoundException('No book found for id '.$id);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($bookRow);
        $em->flush();

        return new JsonResponse($bookRow);
    }

    public static function bookToArray($bookRow)
    {
        return array(
            'id' => $bookRow->getId(),
            'name' => $bookRow->getName(),
            'author' => $bookRow->getAuthor(),
            'yearRelease' => $bookRow->getYearRelease(),
            'publisher' => $bookRow->getPublisher(),
            'description' => $bookRow->getDescription()
        );
    }
}
