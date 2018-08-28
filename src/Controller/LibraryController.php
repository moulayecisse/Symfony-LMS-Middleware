<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LibraryController.
 *
 * @Route("/api/libraries")
 */
class LibraryController extends Controller
{
    /**
     * @Route(
     *     "/count",
     *     name="api_library_count",
     *     defaults={
     *          "#_api_resource_class"=Library::class,
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     */
    public function count(LibraryRepository $libraryRepository)
    {
        $librariesCount = $libraryRepository->count([]);

        return new JsonResponse(['librariesCount' => $librariesCount]);
    }
}
