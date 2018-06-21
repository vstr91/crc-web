<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ApiBundle\Controller;

use ApiBundle\Entity\APIToken;
use ApiBundle\Entity\Estado;
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
            
            // PAIS
            
            $paises = $dados['paises'];
            
            $total = count($paises);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                //$umMusica = null;
                $umPais = null;
                
                $umPais = $em->getRepository('ApiBundle:Pais')
                        ->findOneBy(array('id' => $paises[$i]['id']));
                
                if($umPais == null){
                    $umPais = new Pais();
                    $umPais->setId($paises[$i]['id']);
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
            
            // FIM PAIS
            
            // EMPRESA
            
            $empresas = $dados['empresas'];
            
            $total = count($empresas);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umEmpresa = null;
                
                $umEmpresa = $em->getRepository('ApiBundle:Empresa')
                        ->findOneBy(array('id' => $empresas[$i]['id']));
                
                if($umEmpresa == null){
                    $umEmpresa = new \ApiBundle\Entity\Empresa();
                    $umEmpresa->setId($empresas[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umEmpresa));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umEmpresa->setId($empresas[$i]['id']);
                
                $umEmpresa->setNome($empresas[$i]['nome']);
                
                if(isset($empresas[$i]['logo'])){
                    $umEmpresa->setLogo($empresas[$i]['logo']);
                }
                
                if(isset($empresas[$i]['email'])){
                    $umEmpresa->setEmail($empresas[$i]['email']);
                }
                
                if(isset($empresas[$i]['logo'])){
                    $umEmpresa->setTelefone($empresas[$i]['telefone']);
                }
                
                $umEmpresa->setSlug($empresas[$i]['slug']);
                $umEmpresa->setDataCadastro(date_create_from_format('d-m-Y H:i', $empresas[$i]['dataCadastro']));
                $umEmpresa->setUltimaAlteracao(date_create_from_format('d-m-Y H:i', $empresas[$i]['ultimaAlteracao']));
                
                if(isset($empresas[$i]['programadoPara'])){
                    $umEmpresa->setProgramadoPara(date_create_from_format('d-m-Y H:i', $empresas[$i]['programadoPara']));
                }
                
                $umEmpresa->setAtivo($empresas[$i]['ativo']);

                $em->persist($umEmpresa);
                
            }
            
            // FIM EMPRESA
            
            // ESTADO
            
            $estados = $dados['estados'];
            
            $total = count($estados);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umEstado = null;
                
                $umEstado = $em->getRepository('ApiBundle:Estado')
                        ->findOneBy(array('id' => $estados[$i]['id']));
                
                if($umEstado == null){
                    $umEstado = new Estado();
                    $umEstado->setId($estados[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umEstado));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umEstado->setId($estados[$i]['id']);
                
                $umPais = $em->getRepository('ApiBundle:Estado')
                        ->findOneBy(array('id' => $estados[$i]['pais']));
                
                $umEstado->setNome($estados[$i]['nome']);
                $umEstado->setSigla($estados[$i]['sigla']);
                $umEstado->setSlug($estados[$i]['slug']);
                $umEstado->setPais($umPais);
                $umEstado->setDataCadastro(date_create_from_format('d-m-Y H:i', $estados[$i]['dataCadastro']));
                $umEstado->setUltimaAlteracao(date_create_from_format('d-m-Y H:i', $estados[$i]['ultimaAlteracao']));
                
                if(isset($estados[$i]['programadoPara'])){
                    $umEstado->setProgramadoPara(date_create_from_format('d-m-Y H:i', $estados[$i]['programadoPara']));
                }
                
                $umEstado->setAtivo($estados[$i]['ativo']);

                $em->persist($umEstado);
                
            }
            
            // FIM ESTADO
            
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
