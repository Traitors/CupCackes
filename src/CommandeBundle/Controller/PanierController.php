<?php

namespace CommandeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class PanierController extends Controller
{
    public function PanierAction()
    {
        return $this->render('CommandeBundle:Default:panier/layout/panier.html.twig');
    }
    public function ajoutAction($id){


            $request = $this->get('request');
            $session = $this->get('session');

            if (!$session->has('panier')) $session->set('panier',array());
            $panier = $session->get('panier');

            if (array_key_exists($id, $panier)) {
                if ($this->get('request')->query->get('qte') != null) $panier[$id] = $this->get('request')->query->get('qte');
                $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
            } else {
                if ($this->get('request')->query->get('qte') != null)
                    $panier[$id] = $this->get('request')->query->get('qte');
                else
                    $panier[$id] = 1;

                $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
            }

            $session->set('panier',$panier);


            return $this->redirect($this->generateUrl('panier'));
        }




}
