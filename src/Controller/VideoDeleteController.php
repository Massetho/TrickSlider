<?php
/**
 * @description : Managing Videos.
 * @Author : Quentin Thomasset
 */

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class VideoDeleteController extends Controller
{

    /**
     * @Route("/video/{id}",
     *     name="video_delete",
     *     methods="DELETE")
     */
    public function delete(Request $request, Video $video): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$video->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($video);
            $em->flush();
        }

        return $this->redirectToRoute('trick_show', ['id' => $video->getTrick()->getId()]);
    }
}
