<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ApiBundle\Controller;

use ApiBundle\Entity\APIToken;
use ApiBundle\Entity\MCrypt;
use ApiBundle\Entity\Pais;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of RepRestController
 *
 * @author Almir
 */
class CircularRestController extends FOSRestController {
    
    public function getTokenAction(){
        $crypt = new MCrypt();
        $apiToken = new APIToken();
        $em = $this->getDoctrine()->getManager();
        
        $request = $this->requestStack->getCurrentRequest();
        
        $identificadorUnico = $request->get("id");
        
        if($identificadorUnico != null){
            $identificadorUnico = $crypt->decrypt($identificadorUnico);
        } else{
            $identificadorUnico = "";
        }
        
        $puroTexto = $crypt->geraChaveAcessoAPI(10);
        
        $apiToken->setPuroTexto($puroTexto);
        $apiToken->setIdentificadorUnico($identificadorUnico);
        
        $token = $crypt->encrypt($puroTexto);
        
        $em->persist($apiToken);
        $em->flush();
        
        return new Response($token);
    }
    
    public function getDadosAction(Request $request, $hash, $data) {
        $em = $this->getDoctrine()->getManager();

        $crypto = new MCrypt();
        
        $hashDescriptografado = $crypto->decrypt($crypto->decrypt($hash));
        
        if(null != $em->getRepository('RepSiteBundle:APIToken')->validaToken($hashDescriptografado)){
            $data = $data == '-' ? '2000-01-01' : $data;

            $artistas = $em->getRepository('RepSiteBundle:Artista')
                    ->listarTodosREST(null, $data);
            $tiposEvento = $em->getRepository('RepSiteBundle:TipoEvento')
                    ->listarTodosREST(null, $data);
            $musicas = $em->getRepository('RepSiteBundle:Musica')
                    ->listarTodosREST(null, $data);
            $eventos = $em->getRepository('RepSiteBundle:Evento')
                    ->listarTodosREST(null, $data);
            $musicasEventos = $em->getRepository('RepSiteBundle:MusicaEvento')
                    ->listarTodosREST(null, $data);
            $comentariosEventos = $em->getRepository('RepSiteBundle:ComentarioEvento')
                    ->listarTodosREST(null, $data);
            
//            $log = $em->getRepository('RepSiteBundle:LogEntry')
//                    ->listarTodosREST(null, $data);

            $totalRegistros = count($artistas) + count($tiposEvento) + count($musicas) 
                    + count($eventos) + count($musicasEventos) + count($comentariosEventos);
            
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "artistas" => $artistas, 
                        "tipos_eventos" => $tiposEvento,
                        "musicas" => $musicas,
                        "eventos" => $eventos,
                        "musicas_eventos" => $musicasEventos,
                        "comentarios_eventos" => $comentariosEventos//,
                        //"log" => $log
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");
            
            $em->getRepository('RepSiteBundle:APIToken')->atualizaToken($hashDescriptografado);


            return $this->handleView($view);            
        } else {
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => 0, "status" => 403, "mensagem" => "Acesso negado."))
                    ),
                403, array('totalRegistros' => 0))->setTemplateVar("u");
            
            return $this->handleView($view);
        }
        
    }
    
    public function setDadosAction(Request $request, $hash, $data) {
        $em = $this->getDoctrine()->getManager();
        
        //dump($request->request);
        //die(var_dump($request->request));
        
        //$crypto = new MCrypt();
        
        //$hashDescriptografado = $crypto->decrypt($crypto->decrypt($hash));
        
        if(null == null/* $em->getRepository('ApiBundle:APIToken')->validaToken($hashDescriptografado)*/){
            
            $json = $request->request->get("dados");
            $dados = json_decode($json, TRUE);
            
            //die(var_dump($dados['musicas']));
            
            $paises = $dados['paises'];
            
            $total = count($paises);
            //die(var_dump($total));
            
            //$processadas = array();
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                //$umMusica = null;
                $umPais = null;
                
                $umPais = $em->getRepository('ApiBundle:Pais')
                        ->findOneBy(array('id' => $paises[$i]['id']));
                
                if($umPais == null){
                    $umPais = new Pais();
                    $umPais->setId($paises[$i]['id']);
                    //$umMusica->setDataCadastro($musicas[$i]['data_cadastro']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umPais));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umPais->setId($paises[$i]['id']);
                
                $umPais->setNome($paises[$i]['nome']);
                $umPais->setSigla($paises[$i]['sigla']);
                $umPais->setSlug($paises[$i]['slug']);
                $umPais->setDataCadastro(date_create_from_format('d-m-Y H:i', $paises[$i]['dataCadastro']));
                $umPais->setUltimaAlteracao(date_create_from_format('d-m-Y H:i', $paises[$i]['ultimaAlteracao']));
                
                if(isset($paises[$i]['programadoPara'])){
                    $umPais->setProgramadoPara(date_create_from_format('d-m-Y H:i', $paises[$i]['programadoPara']));
                }
                
                $umPais->setAtivo($paises[$i]['ativo']);

                $em->persist($umPais);
                
            }
            /*
            // MUSICAS
            
            $musicas = $dados['musicas'];
            $total = count($musicas);
            //$processadas = array();
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                //$umMusica = null;
                $umMusica = null;
                
                $umMusica = $em->getRepository('RepSiteBundle:Musica')
                        ->findOneBy(array('id' => $musicas[$i]['id']));
                
                if($umMusica == null){
                    $umMusica = new Musica();
                    $umMusica->setId($musicas[$i]['id']);
                    //$umMusica->setDataCadastro($musicas[$i]['data_cadastro']);
                } else{
                    $existe = true;
                }
                
                $umMusica->setId($musicas[$i]['id']);
                $umMusica->setNome($musicas[$i]['nome']);
                $umMusica->setTom($musicas[$i]['tom']);
                
                $umArtista = new Artista();
                $umArtista = $em->getRepository('RepSiteBundle:Artista')
                        ->findOneBy(array('id' => $musicas[$i]['artista']));
                
                $umMusica->setArtista($umArtista);
                $umMusica->setStatus($musicas[$i]['status']);
                $umMusica->setSlug(NULL);

                $em->persist($umMusica);
                
                if(!$existe){
                    $metadata = $em->getClassMetaData(get_class($umMusica));
                    $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                    $metadata->setIdGenerator(new AssignedGenerator());
                    $umMusica->setId($musicas[$i]['id']);
                }
            }
            
            // ARTISTAS
            
            $artistas = $dados['artistas'];
            $total = count($artistas);
            //$processadas = array();
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umArtista = null;
                
                $umArtista = $em->getRepository('RepSiteBundle:Artista')
                        ->findOneBy(array('id' => $artistas[$i]['id']));
                
                if($umArtista == null){
                    $umArtista = new Artista();
                    $umArtista->setId($artistas[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $umArtista->setNome($artistas[$i]['nome']);
                $umArtista->setStatus($artistas[$i]['status']);
                $umArtista->setSlug(NULL);
                //$umArtista->setDataCadastro($artistas[$i]['data_cadastro']);

                //die(var_dump($umArtista));
                
                $em->persist($umArtista);
                
                if(!$existe){
                    $metadata = $em->getClassMetaData(get_class($umArtista));
                    $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                    $metadata->setIdGenerator(new AssignedGenerator());
                    $umArtista->setId($artistas[$i]['id']);
                }
                
            }
            
            // EVENTOS
            
            $eventos = $dados['eventos'];
            $total = count($eventos);
            //$processadas = array();
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umEvento = null;
                
                $umEvento = $em->getRepository('RepSiteBundle:Evento')
                        ->findOneBy(array('id' => $eventos[$i]['id']));
                
                if($umEvento == null){
                    $umEvento = new Evento();
                    $umEvento->setId($eventos[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $umEvento->setNome($eventos[$i]['nome']);
                $umEvento->setStatus($eventos[$i]['status']);
                $umEvento->setData(date_create_from_format('Y-m-d\TH:i:sO', $eventos[$i]['data']));
                $umEvento->setSlug(NULL);
                
                $umTipoEvento = new \Rep\SiteBundle\Entity\TipoEvento();
                $umTipoEvento = $em->getRepository('RepSiteBundle:TipoEvento')
                        ->findOneBy(array('id' => $eventos[$i]['tipo_evento']));
                
                $umEvento->setTipoEvento($umTipoEvento);
                
                $em->persist($umEvento);
                
                if(!$existe){
                    $metadata = $em->getClassMetaData(get_class($umEvento));
                    $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                    $metadata->setIdGenerator(new AssignedGenerator());
                    $umEvento->setId($eventos[$i]['id']);
                }
                
            }
            
            // MUSICAS EVENTOS
            
            $musicasEventos = $dados['musicas_eventos'];
            $total = count($musicasEventos);
            //$processadas = array();
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umMusicaEvento = null;
                
                $umMusicaEvento = $em->getRepository('RepSiteBundle:MusicaEvento')
                        ->findOneBy(array('id' => $musicasEventos[$i]['id']));
                
                if($umMusicaEvento == null){
                    $umMusicaEvento = new \Rep\SiteBundle\Entity\MusicaEvento();
                    $umMusicaEvento->setId($musicasEventos[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $umMusicaEvento->setOrdem($musicasEventos[$i]['ordem']);
                $umMusicaEvento->setStatus($musicasEventos[$i]['status']);
                
                $umMusica = new \Rep\SiteBundle\Entity\Musica();
                $umMusica = $em->getRepository('RepSiteBundle:Musica')
                        ->findOneBy(array('id' => $musicasEventos[$i]['musica']));
                
                $umMusicaEvento->setMusica($umMusica);
                
                $umEvento = new \Rep\SiteBundle\Entity\Evento();
                $umEvento = $em->getRepository('RepSiteBundle:Evento')
                        ->findOneBy(array('id' => $musicasEventos[$i]['evento']));
                
                $umMusicaEvento->setEvento($umEvento);
                
                $em->persist($umMusicaEvento);
                
                if(!$existe){
                    $metadata = $em->getClassMetaData(get_class($umMusicaEvento));
                    $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                    $metadata->setIdGenerator(new AssignedGenerator());
                    $umMusicaEvento->setId($musicasEventos[$i]['id']);
                }
                
            }
            */
            $em->flush();
            
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => 0, "status" => 200, "mensagem" => "ok"))
                    ),
                200, array('totalRegistros' => 0))->setTemplateVar("u");
            
            return $this->handleView($view);           
        } else {
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => 0, "status" => 403, "mensagem" => "Acesso negado."))
                    ),
                403, array('totalRegistros' => 0))->setTemplateVar("u");
            
            return $this->handleView($view);
        }
        
    }
    
    public function validaTokenAction() {
        $em = $this->getDoctrine()->getManager();

        // Get $id_token via HTTPS POST.
        $CLIENT_ID = "763791909416-aim4u63mdttsktinjqroogqdndlibf7l.apps.googleusercontent.com";
        $idToken = $this->get('request')->request->get('idToken');
        
        $client = new \Google_Client(['client_id' => $CLIENT_ID]);
        $payload = $client->verifyIdToken($idToken);
        
        if ($payload) {
            $email = $payload['email'];
            $userid = $payload['sub'];
            
            $usuario = $em->getRepository('RepSiteBundle:Usuario')
                        ->findOneBy(array('email' => $email));
            
            if($usuario != null){
                
                if($usuario->getGoogleId() == null){
                    $usuario->setGoogleID($userid);
                    $em->persist($usuario);
                    $em->flush();
                }
                
                $view = View::create(
                    array(
                        "meta" => array(array("registros" => 0, "status" => 200, "mensagem" => "ok"))
                    ),
                    200, array('totalRegistros' => 0))->setTemplateVar("u");

                return $this->handleView($view); 
                
            } else {
                $view = View::create(
                        array(
                            "meta" => array(array("registros" => 0, "status" => 403, "mensagem" => "Acesso negado."))
                        ),
                    403, array('totalRegistros' => 0))->setTemplateVar("u");

                return $this->handleView($view);
            }
            
        }
        
    }
}
