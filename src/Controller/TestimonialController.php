<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27.
 */

namespace App\Controller\API;

use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestimonialController.
 *
 * @Route("/api/testimonials")
 */
class TestimonialController extends Controller
{
    /**
     * @Route(
     *     "/count",
     *     name="api_testimonial_count",
     *     defaults={
     *          "#_api_resource_class"=Testimonial::class,
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     *
     * @param TestimonialRepository $testimonialRepository
     *
     * @return JsonResponse
     */
    public function count(TestimonialRepository $testimonialRepository)
    {
        $testimonialsCount = $testimonialRepository->count([]);

        return new JsonResponse(['testimonialsCount' => $testimonialsCount]);
    }
}
