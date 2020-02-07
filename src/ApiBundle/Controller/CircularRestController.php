<<<<<<< OURS
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
    
    public function getTokenAction(Request $request, String $id, $tipo){
        $crypt = new MCrypt();
        $apiToken = new APIToken();
        $em = $this->getDoctrine()->getManager();
        
        $identificadorUnico = $id;
        
        if($identificadorUnico != null){
            $identificadorUnico = $crypt->decrypt($identificadorUnico);
        } else{
            $identificadorUnico = "";
        }
        
        $puroTexto = $crypt->geraChaveAcessoAPI(10);
        
        $apiToken->setPuroTexto($puroTexto);
        $apiToken->setIdentificadorUnico($identificadorUnico);
        $apiToken->setTipo($tipo);
        
        $token = $crypt->encrypt($puroTexto);
        
        $em->persist($apiToken);
        $em->flush();
        
        return new Response($token);
    }
    
    public function getDadosAction(Request $request, $hash, $data, $id) {
        $em = $this->getDoctrine()->getManager();

        $crypto = new MCrypt();
        
        $hashDescriptografado = $crypto->decrypt($crypto->decrypt($hash));
        
        if(null != $em->getRepository('ApiBundle:APIToken')->validaToken($hashDescriptografado)){
            $data = $data == '-' ? '2000-01-01' : $data;

            if($id != 'admin'){
                $usuarios = $em->getRepository('ApiBundle:Usuario')
                        ->listarTodosREST(null, $data, $id);
                $paises = $em->getRepository('ApiBundle:Pais')
                        ->listarTodosREST(null, $data);
                $empresas = $em->getRepository('ApiBundle:Empresa')
                        ->listarTodosREST(null, $data);
                $onibus = $em->getRepository('ApiBundle:Onibus')
                        ->listarTodosREST(null, $data);
                $estados = $em->getRepository('ApiBundle:Estado')
                        ->listarTodosREST(null, $data);
                $cidades = $em->getRepository('ApiBundle:Cidade')
                        ->listarTodosREST(null, $data);
                $bairros = $em->getRepository('ApiBundle:Bairro')
                        ->listarTodosREST(null, $data);
                $paradas = $em->getRepository('ApiBundle:Parada')
                        ->listarTodosREST(null, $data);
                $itinerarios = $em->getRepository('ApiBundle:Itinerario')
                        ->listarTodosREST(null, $data);
                $horarios = $em->getRepository('ApiBundle:Horario')
                        ->listarTodosREST(null, $data);
                $paradasItinerarios = $em->getRepository('ApiBundle:ParadaItinerario')
                        ->listarTodosREST(null, $data);
                $secoesItinerarios = $em->getRepository('ApiBundle:SecaoItinerario')
                        ->listarTodosREST(null, $data);
                $horariosItinerarios = $em->getRepository('ApiBundle:HorarioItinerario')
                        ->listarTodosREST(null, $data);
                $mensagens = $em->getRepository('ApiBundle:Mensagem')
                        ->listarTodosREST(null, $data);
                $parametros = $em->getRepository('ApiBundle:Parametro')
                        ->listarTodosREST(null, $data);
                $pontosInteresse = $em->getRepository('ApiBundle:PontoInteresse')
                        ->listarTodosREST(null, $data);
                
                $paradasSugestao = $em->getRepository('ApiBundle:ParadaSugestao')
                    ->listarTodosREST(null, $data, $id);
                
                $preferencias = $em->getRepository('ApiBundle:UsuarioPreferencia')
                    ->listarTodosREST(null, $data, $id);
                
                $historicos = $em->getRepository('ApiBundle:HistoricoItinerario')
                    ->listarTodosREST(null, $data);
                    
                $poisSugestao = $em->getRepository('ApiBundle:PontoInteresseSugestao')
                    ->listarTodosREST(null, $data, $id);
                
                $acessos = array();
                
                $servicos = $em->getRepository('ApiBundle:Servico')
                    ->listarTodosREST(null, $data, $id);
                
                $viagens = array();
                
                $feriados = $em->getRepository('ApiBundle:Feriado')
                    ->listarTodosREST(null, $data, $id);
            } else{
                $usuarios = $em->getRepository('ApiBundle:Usuario')
                        ->listarTodosRESTAdmin(null, $data);
                $paises = $em->getRepository('ApiBundle:Pais')
                        ->listarTodosRESTAdmin(null, $data);
                $empresas = $em->getRepository('ApiBundle:Empresa')
                        ->listarTodosRESTAdmin(null, $data);
                $onibus = $em->getRepository('ApiBundle:Onibus')
                        ->listarTodosRESTAdmin(null, $data);
                $estados = $em->getRepository('ApiBundle:Estado')
                        ->listarTodosRESTAdmin(null, $data);
                $cidades = $em->getRepository('ApiBundle:Cidade')
                        ->listarTodosRESTAdmin(null, $data);
                $bairros = $em->getRepository('ApiBundle:Bairro')
                        ->listarTodosRESTAdmin(null, $data);
                $paradas = $em->getRepository('ApiBundle:Parada')
                        ->listarTodosRESTAdmin(null, $data);
                $itinerarios = $em->getRepository('ApiBundle:Itinerario')
                        ->listarTodosRESTAdmin(null, $data);
                $horarios = $em->getRepository('ApiBundle:Horario')
                        ->listarTodosRESTAdmin(null, $data);
                $paradasItinerarios = $em->getRepository('ApiBundle:ParadaItinerario')
                        ->listarTodosRESTAdmin(null, $data);
                $secoesItinerarios = $em->getRepository('ApiBundle:SecaoItinerario')
                        ->listarTodosRESTAdmin(null, $data);
                $horariosItinerarios = $em->getRepository('ApiBundle:HorarioItinerario')
                        ->listarTodosRESTAdmin(null, $data);
                $mensagens = $em->getRepository('ApiBundle:Mensagem')
                        ->listarTodosRESTAdmin(null, $data);
                $parametros = $em->getRepository('ApiBundle:Parametro')
                        ->listarTodosRESTAdmin(null, $data);
                $pontosInteresse = $em->getRepository('ApiBundle:PontoInteresse')
                        ->listarTodosRESTAdmin(null, $data);
                
                $paradasSugestao = $em->getRepository('ApiBundle:ParadaSugestao')
                    ->listarTodosRESTAdmin(null, $data);
                
                $preferencias = $em->getRepository('ApiBundle:UsuarioPreferencia')
                    ->listarTodosREST(null, $data, '-1');
                
                $historicos = $em->getRepository('ApiBundle:HistoricoItinerario')
                    ->listarTodosRESTAdmin(null, $data);
                    
                $poisSugestao = $em->getRepository('ApiBundle:PontoInteresseSugestao')
                    ->listarTodosRESTAdmin(null, $data);
                
                $acessos = $em->getRepository('ApiBundle:APIToken')
                    ->listarTodosRESTAdmin(100, $data);
                
                $servicos = $em->getRepository('ApiBundle:Servico')
                    ->listarTodosRESTAdmin(null, $data, $id);
                
                $viagens = $em->getRepository('ApiBundle:ViagemItinerario')
                    ->listarTodosRESTAdmin(null, $data, $id);
                
                $feriados = $em->getRepository('ApiBundle:Feriado')
                    ->listarTodosRESTAdmin(null, $data, $id);
            }
            
//            $log = $em->getRepository('RepSiteBundle:LogEntry')
//                    ->listarTodosREST(null, $data);

            $totalRegistros = count($paises) + count($empresas) + count($onibus) 
                    + count($estados) + count($cidades) + count($bairros)
                    + count($paradas) + count($itinerarios) + count($horarios)
                    + count($paradasItinerarios) + count($secoesItinerarios) + count($horariosItinerarios)
                    + count($mensagens) + count($parametros) + count($pontosInteresse)
                    + count($usuarios) + count($paradasSugestao) + count($preferencias) 
                    + count($historicos)
                    + count($poisSugestao)
                    + count($acessos)
                    + count($servicos)
                    + count($viagens)
                    + count($feriados)
                    ;
            
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "usuarios" => $usuarios,
                        "paises" => $paises, 
                        "empresas" => $empresas,
                        "onibus" => $onibus,
                        "estados" => $estados,
                        "cidades" => $cidades,
                        "bairros" => $bairros,
                        "paradas" => $paradas, 
                        "itinerarios" => $itinerarios,
                        "horarios" => $horarios,
                        "paradas_itinerarios" => $paradasItinerarios,
                        "secoes_itinerarios" => $secoesItinerarios,
                        "horarios_itinerarios" => $horariosItinerarios,
                        "mensagens" => $mensagens, 
                        "parametros" => $parametros,
                        "pontos_interesse" => $pontosInteresse,
                        "paradas_sugestoes" => $paradasSugestao,
                        "preferencias" => $preferencias,
                        "historicos_itinerarios" => $historicos,
                        "pontos_interesse_sugestoes" => $poisSugestao,
                        "acessos" => $acessos,
                        "servicos" => $servicos,
                        "viagens_itinerarios" => $viagens,
                        "feriados" => $feriados
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");
            
            $em->getRepository('ApiBundle:APIToken')->atualizaToken($hashDescriptografado);


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
    
    public function setDadosAction(Request $request, $hash) {
        $em = $this->getDoctrine()->getManager();
        
        //dump($request->request);
        //die(var_dump($request->request));
        
        $crypto = new MCrypt();
        
        $hashDescriptografado = $crypto->decrypt($crypto->decrypt($hash));
        
        if(null != $em->getRepository('ApiBundle:APIToken')->validaToken($hashDescriptografado)){
            
            $json = $request->request->get("dados");
            $dados = json_decode($json, TRUE);
            
            // PAIS
            
            $paises = $dados['paises'];
            
            $total = count($paises);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
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
                $umPais->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $paises[$i]['dataCadastro']));
                $umPais->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $paises[$i]['ultimaAlteracao']));
                
                if(isset($paises[$i]['programadoPara'])){
                    $umPais->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $paises[$i]['programadoPara']));
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
                
                if(isset($empresas[$i]['prefixo'])){
                    $umEmpresa->setPrefixo($empresas[$i]['prefixo']);
                }
                
                if(isset($empresas[$i]['logo'])){
                    $umEmpresa->setLogo($empresas[$i]['logo']);
                }
                
                if(isset($empresas[$i]['email'])){
                    $umEmpresa->setEmail($empresas[$i]['email']);
                }
                
                if(isset($empresas[$i]['telefone'])){
                    $umEmpresa->setTelefone($empresas[$i]['telefone']);
                }
                
                $umEmpresa->setSlug($empresas[$i]['slug']);
                $umEmpresa->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $empresas[$i]['dataCadastro']));
                $umEmpresa->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $empresas[$i]['ultimaAlteracao']));
                
                if(isset($empresas[$i]['programadoPara'])){
                    $umEmpresa->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $empresas[$i]['programadoPara']));
                }
                
                $umEmpresa->setAtivo($empresas[$i]['ativo']);

                $em->persist($umEmpresa);
                
            }
            
            // FIM EMPRESA
            
            // ONIBUS
            
            $onibus = $dados['onibus'];
            
            $total = count($onibus);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umOnibus = null;
                
                $umOnibus = $em->getRepository('ApiBundle:Onibus')
                        ->findOneBy(array('id' => $onibus[$i]['id']));
                
                if($umOnibus == null){
                    $umOnibus = new \ApiBundle\Entity\Onibus();
                    $umOnibus->setId($onibus[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umOnibus));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umOnibus->setId($onibus[$i]['id']);
                
                $umOnibus->setSufixo($onibus[$i]['sufixo']);
                $umOnibus->setPlaca($onibus[$i]['placa']);
                
                if(isset($onibus[$i]['ano'])){
                    $umOnibus->setAno($onibus[$i]['ano']);
                }
                
                if(isset($onibus[$i]['marca'])){
                    $umOnibus->setMarca($onibus[$i]['marca']);
                }
                
                if(isset($onibus[$i]['modelo'])){
                    $umOnibus->setModelo($onibus[$i]['modelo']);
                }
                
                $umOnibus->setAcessivel($onibus[$i]['acessivel']);
                
                if(isset($onibus[$i]['observacao'])){
                    $umOnibus->setObservacao($onibus[$i]['observacao']);
                }
                
                $umaEmpresa = $em->getRepository('ApiBundle:Empresa')
                        ->find($onibus[$i]['empresa']);
                
                $umOnibus->setEmpresa($umaEmpresa);
                
                $umOnibus->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $onibus[$i]['dataCadastro']));
                $umOnibus->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $onibus[$i]['ultimaAlteracao']));
                
                if(isset($onibus[$i]['programadoPara'])){
                    $umOnibus->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $onibus[$i]['programadoPara']));
                }
                
                $umOnibus->setAtivo($onibus[$i]['ativo']);

                $em->persist($umOnibus);
                
            }
            
            // FIM ONIBUS
            
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
                
                $umPais = $em->getRepository('ApiBundle:Pais')
                        ->find($estados[$i]['pais']);
                
                $umEstado->setNome($estados[$i]['nome']);
                $umEstado->setSigla($estados[$i]['sigla']);
                $umEstado->setSlug($estados[$i]['slug']);
                $umEstado->setPais($umPais);
                $umEstado->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $estados[$i]['dataCadastro']));
                $umEstado->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $estados[$i]['ultimaAlteracao']));
                
                if(isset($estados[$i]['programadoPara'])){
                    $umEstado->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $estados[$i]['programadoPara']));
                }
                
                $umEstado->setAtivo($estados[$i]['ativo']);

                //dump($umEstado);
                
                $em->persist($umEstado);
                
            }
            
            // FIM ESTADO
            
            // CIDADE
            
            $cidades = $dados['cidades'];
            
            $total = count($cidades);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umCidade = null;
                
                $umCidade = $em->getRepository('ApiBundle:Cidade')
                        ->findOneBy(array('id' => $cidades[$i]['id']));
                
                if($umCidade == null){
                    $umCidade = new \ApiBundle\Entity\Cidade();
                    $umCidade->setId($cidades[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umCidade));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umCidade->setId($cidades[$i]['id']);
                
                $umEstado = $em->getRepository('ApiBundle:Estado')
                        ->find($cidades[$i]['estado']);
                
                $umCidade->setNome($cidades[$i]['nome']);
                
                if(isset($cidades[$i]['brasao'])){
                    $umCidade->setBrasao($cidades[$i]['brasao']);
                }
                
                $umCidade->setSlug($cidades[$i]['slug']);
                $umCidade->setEstado($umEstado);
                $umCidade->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $cidades[$i]['dataCadastro']));
                $umCidade->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $cidades[$i]['ultimaAlteracao']));
                
                if(isset($cidades[$i]['programadoPara'])){
                    $umCidade->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $cidades[$i]['programadoPara']));
                }
                
                $umCidade->setAtivo($cidades[$i]['ativo']);

                //dump($umEstado);
                
                $em->persist($umCidade);
                
            }
            
            // FIM CIDADE
            
            // BAIRRO
            
            $bairros = $dados['bairros'];
            
            $total = count($bairros);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umBairro = null;
                
                $umBairro = $em->getRepository('ApiBundle:Bairro')
                        ->findOneBy(array('id' => $bairros[$i]['id']));
                
                if($umBairro == null){
                    $umBairro = new \ApiBundle\Entity\Bairro();
                    $umBairro->setId($bairros[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umBairro));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umBairro->setId($bairros[$i]['id']);
                
                $umCidade = $em->getRepository('ApiBundle:Cidade')
                        ->find($bairros[$i]['cidade']);
                
                $umBairro->setNome($bairros[$i]['nome']);
                $umBairro->setSlug($bairros[$i]['slug']);
                $umBairro->setCidade($umCidade);
                $umBairro->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $bairros[$i]['dataCadastro']));
                $umBairro->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $bairros[$i]['ultimaAlteracao']));
                
                if(isset($bairros[$i]['programadoPara'])){
                    $umBairro->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $bairros[$i]['programadoPara']));
                }
                
                $umBairro->setAtivo($bairros[$i]['ativo']);

                //dump($umEstado);
                
                $em->persist($umBairro);
                
            }
            
            // FIM BAIRRO
            
            // PARADA
            
            $paradas = $dados['paradas'];
            
            $total = count($paradas);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umParada = null;
                
                $umParada = $em->getRepository('ApiBundle:Parada')
                        ->findOneBy(array('id' => $paradas[$i]['id']));
                
                if($umParada == null){
                    $umParada = new \ApiBundle\Entity\Parada();
                    $umParada->setId($paradas[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umParada));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umParada->setId($paradas[$i]['id']);
                
                $umBairro = $em->getRepository('ApiBundle:Bairro')
                        ->find($paradas[$i]['bairro']);
                
                $umParada->setNome($paradas[$i]['nome']);
                $umParada->setSlug($paradas[$i]['slug']);
                $umParada->setLatitude($paradas[$i]['latitude']);
                $umParada->setLongitude($paradas[$i]['longitude']);
                 
                if(isset($paradas[$i]['rua'])){
                    $umParada->setRua($paradas[$i]['rua']);
                }
                
                if(isset($paradas[$i]['cep'])){
                    $umParada->setCep($paradas[$i]['cep']);
                }
                
                if(isset($paradas[$i]['sentido'])){
                    $umParada->setSentido($paradas[$i]['sentido']);
                }
                
                if(isset($paradas[$i]['taxaDeEmbarque'])){
                    $umParada->setTaxaDeEmbarque($paradas[$i]['taxaDeEmbarque']);
                }
                
                if(isset($paradas[$i]['imagem'])){
                    $umParada->setImagem($paradas[$i]['imagem']);
                }
                
                if(isset($paradas[$i]['servicos'])){
                    $umParada->setServicos($paradas[$i]['servicos']);
                }
                
                $umParada->setBairro($umBairro);
                $umParada->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $paradas[$i]['dataCadastro']));
                $umParada->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $paradas[$i]['ultimaAlteracao']));
                
                if(isset($paradas[$i]['programadoPara'])){
                    $umParada->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $paradas[$i]['programadoPara']));
                }
                
                $umParada->setAtivo($paradas[$i]['ativo']);
                
                $em->persist($umParada);
                
            }
            
            // FIM PARADA
            
            // ITINERARIO
            
            $itinerarios = $dados['itinerarios'];
            
            $total = count($itinerarios);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umItinerario = null;
                
                $umItinerario = $em->getRepository('ApiBundle:Itinerario')
                        ->findOneBy(array('id' => $itinerarios[$i]['id']));
                
                if($umItinerario == null){
                    $umItinerario = new \ApiBundle\Entity\Itinerario();
                    $umItinerario->setId($itinerarios[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umItinerario));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umItinerario->setId($itinerarios[$i]['id']);
                
                $umEmpresa = $em->getRepository('ApiBundle:Empresa')
                        ->find($itinerarios[$i]['empresa']);
                
                if(isset($itinerarios[$i]['sigla'])){
                    $umItinerario->setSigla($itinerarios[$i]['sigla']);
                }
                
                $umItinerario->setTarifa($itinerarios[$i]['tarifa']);
                
                if(isset($itinerarios[$i]['distancia'])){
                    $umItinerario->setDistancia($itinerarios[$i]['distancia']);
                }
                
                if(isset($itinerarios[$i]['tempo'])){
                    $umItinerario->setTempo(date_create_from_format('d-m-Y H:i:s', $itinerarios[$i]['tempo']));
                }
                
                $umItinerario->setAcessivel($itinerarios[$i]['acessivel']);
                
                if(isset($itinerarios[$i]['observacao'])){
                    $umItinerario->setObservacao($itinerarios[$i]['observacao']);
                }
                
                $umItinerario->setEmpresa($umEmpresa);
                $umItinerario->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $itinerarios[$i]['dataCadastro']));
                $umItinerario->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $itinerarios[$i]['ultimaAlteracao']));
                
                if(isset($itinerarios[$i]['programadoPara'])){
                    $umItinerario->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $itinerarios[$i]['programadoPara']));
                }
                
                if(isset($itinerarios[$i]['mostraRuas'])){
                    $umItinerario->setMostraRuas($itinerarios[$i]['mostraRuas']);
                }
                
                $umItinerario->setAtivo($itinerarios[$i]['ativo']);
                
                $em->persist($umItinerario);
                
            }
            
            // FIM ITINERARIO
            
            // HORARIO
            
            $horarios = $dados['horarios'];
            
            $total = count($horarios);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umHorario = null;
                
                $umHorario = $em->getRepository('ApiBundle:Horario')
                        ->findOneBy(array('id' => $horarios[$i]['id']));
                
                if($umHorario == null){
                    $umHorario = new \ApiBundle\Entity\Horario();
                    $umHorario->setId($horarios[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umHorario));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umHorario->setId($horarios[$i]['id']);
                
                $umHorario->setNome(date_create_from_format('d-m-Y H:i:s', $horarios[$i]['nome']));
                
                $umHorario->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $horarios[$i]['dataCadastro']));
                $umHorario->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $horarios[$i]['ultimaAlteracao']));
                
                if(isset($horarios[$i]['programadoPara'])){
                    $umHorario->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $horarios[$i]['programadoPara']));
                }
                
                $umHorario->setAtivo($horarios[$i]['ativo']);
                
                $em->persist($umHorario);
                
            }
            
            // FIM HORARIO
            
            // PARADA ITINERARIO
            
            $paradasItinerarios = $dados['paradas_itinerarios'];
            
            $total = count($paradasItinerarios);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umParadaItinerario = null;
                
                $umParadaItinerario = $em->getRepository('ApiBundle:ParadaItinerario')
                        ->findOneBy(array('id' => $paradasItinerarios[$i]['id']));
                
                if($umParadaItinerario == null){
                    $umParadaItinerario = new \ApiBundle\Entity\ParadaItinerario();
                    $umParadaItinerario->setId($paradasItinerarios[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umParadaItinerario));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umParadaItinerario->setId($paradasItinerarios[$i]['id']);
                
                $umParada = $em->getRepository('ApiBundle:Parada')
                        ->find($paradasItinerarios[$i]['parada']);
                
                $umItinerario = $em->getRepository('ApiBundle:Itinerario')
                        ->find($paradasItinerarios[$i]['itinerario']);
                
                if(isset($paradasItinerarios[$i]['valorAnterior'])){
                    $umParadaItinerario->setValorAnterior($paradasItinerarios[$i]['valorAnterior']);
                }
                
                if(isset($paradasItinerarios[$i]['valorSeguinte'])){
                    $umParadaItinerario->setValorSeguinte($paradasItinerarios[$i]['valorSeguinte']);
                }
                
                if(isset($paradasItinerarios[$i]['distanciaSeguinte'])){
                    $umParadaItinerario->setDistanciaSeguinte($paradasItinerarios[$i]['distanciaSeguinte']);
                }
                
                if(isset($paradasItinerarios[$i]['tempoSeguinte'])){
                    $umParadaItinerario->setTempoSeguinte(date_create_from_format('d-m-Y H:i:s', $paradasItinerarios[$i]['tempoSeguinte']));
                }
                
                $umParadaItinerario->setParada($umParada);
                
                $umParadaItinerario->setItinerario($umItinerario);
                $umParadaItinerario->setOrdem($paradasItinerarios[$i]['ordem']);
                $umParadaItinerario->setDestaque($paradasItinerarios[$i]['destaque']);
                
                $umParadaItinerario->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $paradasItinerarios[$i]['dataCadastro']));
                $umParadaItinerario->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $paradasItinerarios[$i]['ultimaAlteracao']));
                
                if(isset($paradasItinerarios[$i]['programadoPara'])){
                    $umParadaItinerario->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $paradasItinerarios[$i]['programadoPara']));
                }
                
                $umParadaItinerario->setAtivo($paradasItinerarios[$i]['ativo']);
                
                $em->persist($umParadaItinerario);
                
            }
            
            // FIM PARADA ITINERARIO
            
            // SECAO ITINERARIO
            
            $secoesItinerarios = $dados['secoes_itinerarios'];
            
            $total = count($secoesItinerarios);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umSecaoItinerario = null;
                
                $umSecaoItinerario = $em->getRepository('ApiBundle:SecaoItinerario')
                        ->findOneBy(array('id' => $secoesItinerarios[$i]['id']));
                
                if($umSecaoItinerario == null){
                    $umSecaoItinerario = new \ApiBundle\Entity\SecaoItinerario();
                    $umSecaoItinerario->setId($secoesItinerarios[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umSecaoItinerario));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umSecaoItinerario->setId($secoesItinerarios[$i]['id']);
                
                $umItinerario = $em->getRepository('ApiBundle:Itinerario')
                        ->find($secoesItinerarios[$i]['itinerario']);
                
                if(isset($secoesItinerarios[$i]['paradaInicial'])){
                    $umParadaInicial = $em->getRepository('ApiBundle:Parada')
                        ->find($secoesItinerarios[$i]['paradaInicial']);
                        
                    $umSecaoItinerario->setParadaInicial($umParadaInicial);
                }
                
                if(isset($secoesItinerarios[$i]['paradaFinal'])){
                    $umParadaFinal = $em->getRepository('ApiBundle:Parada')
                        ->find($secoesItinerarios[$i]['paradaFinal']);
                        
                    $umSecaoItinerario->setParadaFinal($umParadaFinal);
                }
                
                $umSecaoItinerario->setItinerario($umItinerario);
                $umSecaoItinerario->setNome($secoesItinerarios[$i]['nome']);
                $umSecaoItinerario->setTarifa($secoesItinerarios[$i]['tarifa']);
                
                $umSecaoItinerario->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $secoesItinerarios[$i]['dataCadastro']));
                $umSecaoItinerario->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $secoesItinerarios[$i]['ultimaAlteracao']));
                
                if(isset($secoesItinerarios[$i]['programadoPara'])){
                    $umSecaoItinerario->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $secoesItinerarios[$i]['programadoPara']));
                }
                
                $umSecaoItinerario->setAtivo($secoesItinerarios[$i]['ativo']);
                
                $em->persist($umSecaoItinerario);
                
            }
            
            // FIM SECAO ITINERARIO
            
            // HORARIO ITINERARIO
            
            $horariosItinerarios = $dados['horarios_itinerarios'];
            
            $total = count($horariosItinerarios);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umHorarioItinerario = null;
                
                $umHorarioItinerario = $em->getRepository('ApiBundle:HorarioItinerario')
                        ->findOneBy(array('id' => $horariosItinerarios[$i]['id']));
                
                if($umHorarioItinerario == null){
                    $umHorarioItinerario = new \ApiBundle\Entity\HorarioItinerario();
                    $umHorarioItinerario->setId($horariosItinerarios[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umHorarioItinerario));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umHorarioItinerario->setId($horariosItinerarios[$i]['id']);
                
                $umHorario = $em->getRepository('ApiBundle:Horario')
                        ->find($horariosItinerarios[$i]['horario']);
                
                $umItinerario = $em->getRepository('ApiBundle:Itinerario')
                        ->find($horariosItinerarios[$i]['itinerario']);
                
                if(isset($horariosItinerarios[$i]['observacao'])){
                    $umHorarioItinerario->setObservacao($horariosItinerarios[$i]['observacao']);
                }
                
                $umHorarioItinerario->setHorario($umHorario);
                $umHorarioItinerario->setItinerario($umItinerario);
                
                $umHorarioItinerario->setDomingo($horariosItinerarios[$i]['domingo']);
                $umHorarioItinerario->setSegunda($horariosItinerarios[$i]['segunda']);
                $umHorarioItinerario->setTerca($horariosItinerarios[$i]['terca']);
                $umHorarioItinerario->setQuarta($horariosItinerarios[$i]['quarta']);
                $umHorarioItinerario->setQuinta($horariosItinerarios[$i]['quinta']);
                $umHorarioItinerario->setSexta($horariosItinerarios[$i]['sexta']);
                $umHorarioItinerario->setSabado($horariosItinerarios[$i]['sabado']);
                
                $umHorarioItinerario->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $horariosItinerarios[$i]['dataCadastro']));
                $umHorarioItinerario->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $horariosItinerarios[$i]['ultimaAlteracao']));
                
                if(isset($horariosItinerarios[$i]['programadoPara'])){
                    $umHorarioItinerario->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $horariosItinerarios[$i]['programadoPara']));
                }
                
                $umHorarioItinerario->setAtivo($horariosItinerarios[$i]['ativo']);
                
                $em->persist($umHorarioItinerario);
                
            }
            
            // FIM HORARIO ITINERARIO
            
            // MENSAGEM
            
            $mensagens = $dados['mensagens'];
            
            $total = count($mensagens);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umMensagem = null;
                
                $umMensagem = $em->getRepository('ApiBundle:Mensagem')
                        ->findOneBy(array('id' => $mensagens[$i]['id']));
                
                if($umMensagem == null){
                    $umMensagem = new \ApiBundle\Entity\Mensagem();
                    $umMensagem->setId($mensagens[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umMensagem));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umMensagem->setId($mensagens[$i]['id']);
                
                $umMensagem->setTitulo($mensagens[$i]['titulo']);
                
                if(isset($mensagens[$i]['resumo'])){
                    $umMensagem->setResumo($mensagens[$i]['resumo']);
                }
                
                if(isset($mensagens[$i]['email'])){
                    $umMensagem->setEmail($mensagens[$i]['email']);
                }
                
                $umMensagem->setDescricao($mensagens[$i]['descricao']);
                
                if(!date_create_from_format('d-m-Y H:i:s', $mensagens[$i]['dataCadastro'])){
                        $umMensagem->setDataCadastro(date_create_from_format('d-m-Y H:i', $mensagens[$i]['dataCadastro']));
                } else{
                      $umMensagem->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $mensagens[$i]['dataCadastro']));  
                }
                
                if(!date_create_from_format('d-m-Y H:i:s', $mensagens[$i]['ultimaAlteracao'])){
                        $umMensagem->setUltimaAlteracao(date_create_from_format('d-m-Y H:i', $mensagens[$i]['ultimaAlteracao']));
                } else{
                      $umMensagem->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $mensagens[$i]['ultimaAlteracao']));  
                }
                
                $umMensagem->setServidor($mensagens[$i]['servidor']);
                
                if(isset($mensagens[$i]['programadoPara'])){
                    $umMensagem->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $mensagens[$i]['programadoPara']));
                }
                
                $umMensagem->setAtivo($mensagens[$i]['ativo']);

                $em->persist($umMensagem);
                
            }
            
            // FIM MENSAGEM
            
            // PARAMETRO
            
            $parametros = $dados['parametros'];
            
            $total = count($parametros);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                //$umMusica = null;
                $umParametro = null;
                
                $umParametro = $em->getRepository('ApiBundle:Parametro')
                        ->findOneBy(array('id' => $parametros[$i]['id']));
                
                if($umParametro == null){
                    $umParametro = new \ApiBundle\Entity\Parametro();
                    $umParametro->setId($parametros[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umParametro));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umParametro->setId($parametros[$i]['id']);
                
                $umParametro->setNome($parametros[$i]['nome']);
                $umParametro->setValor($parametros[$i]['valor']);
                $umParametro->setSlug($parametros[$i]['slug']);
                $umParametro->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $parametros[$i]['dataCadastro']));
                $umParametro->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $parametros[$i]['ultimaAlteracao']));
                
                if(isset($parametros[$i]['programadoPara'])){
                    $umParametro->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $parametros[$i]['programadoPara']));
                }
                
                $umParametro->setAtivo($parametros[$i]['ativo']);

                $em->persist($umParametro);
                
            }
            
            // FIM PARAMETRO
            
            // PONTO INTERESSE
            
            $pontosInteresse = $dados['pontos_interesse'];
            
            $total = count($pontosInteresse);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umPontoInteresse = null;
                
                $umPontoInteresse = $em->getRepository('ApiBundle:PontoInteresse')
                        ->findOneBy(array('id' => $pontosInteresse[$i]['id']));
                
                if($umPontoInteresse == null){
                    $umPontoInteresse = new \ApiBundle\Entity\PontoInteresse();
                    $umPontoInteresse->setId($pontosInteresse[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umPontoInteresse));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umPontoInteresse->setId($pontosInteresse[$i]['id']);
                
                $umPontoInteresse->setNome($pontosInteresse[$i]['nome']);
                $umPontoInteresse->setSlug($pontosInteresse[$i]['slug']);
                $umPontoInteresse->setLatitude(doubleval($pontosInteresse[$i]['latitude']));
                $umPontoInteresse->setLongitude($pontosInteresse[$i]['longitude']);
                
                if(isset($pontosInteresse[$i]['dataInicial'])){
                        $umPontoInteresse->setDataInicial(date_create_from_format('d-m-Y H:i:s', $pontosInteresse[$i]['dataInicial']));
                }
                
                
                if(isset($pontosInteresse[$i]['dataFinal'])){
                        $umPontoInteresse->setDataFinal(date_create_from_format('d-m-Y H:i:s', $pontosInteresse[$i]['dataFinal']));
                }
                
                if(isset($pontosInteresse[$i]['imagem'])){
                    $umPontoInteresse->setImagem($pontosInteresse[$i]['imagem']);
                }
                
                $umPontoInteresse->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $pontosInteresse[$i]['dataCadastro']));
                $umPontoInteresse->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $pontosInteresse[$i]['ultimaAlteracao']));
                
                if(isset($pontosInteresse[$i]['programadoPara'])){
                    $umPontoInteresse->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $pontosInteresse[$i]['programadoPara']));
                }
                
                $umPontoInteresse->setAtivo($pontosInteresse[$i]['ativo']);
                $umPontoInteresse->setPermanente($pontosInteresse[$i]['permanente']);
                
                $umBairro = $em->getRepository('ApiBundle:Bairro')
                        ->find($pontosInteresse[$i]['bairro']);
                
                $umPontoInteresse->setBairro($umBairro);
                
                $em->persist($umPontoInteresse);
                
            }
            
            // FIM PONTO INTERESSE
            
            // USUARIO
            
            $usuarios = $dados['usuarios'];
            
            $total = count($usuarios);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umUsuario = null;
                
                $umUsuario = $em->getRepository('ApiBundle:Usuario')
                        ->findOneBy(array('id' => $usuarios[$i]['id']));
                
                if($umUsuario == null){
                    $umUsuario = new \ApiBundle\Entity\Usuario();
                    $umUsuario->setId($usuarios[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umUsuario));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umUsuario->setId($usuarios[$i]['id']);
                
                $umUsuario->setNome($usuarios[$i]['nome']);
                $umUsuario->setEmail($usuarios[$i]['email']);
                $umUsuario->setUsername($usuarios[$i]['email']);
                $umUsuario->setPassword("");
                
                if(isset($usuarios[$i]['idGoogle'])){
                    $umUsuario->setGoogleID($usuarios[$i]['idGoogle']);
                }
                
                $umUsuario->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $usuarios[$i]['dataCadastro']));
                $umUsuario->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $usuarios[$i]['ultimaAlteracao']));
                
                if(isset($usuarios[$i]['programadoPara'])){
                    $umUsuario->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $usuarios[$i]['programadoPara']));
                }
                
                $umUsuario->setEnabled($usuarios[$i]['ativo']);

                $em->persist($umUsuario);
                
            }
            
            // FIM USUARIO
            
            // PARADA SUGESTAO
            
            $paradasSugestoes = $dados['paradas_sugestoes'];
            
            $total = count($paradasSugestoes);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umParada = null;
                $umParadaVinculada = null;
                
                $umParada = $em->getRepository('ApiBundle:ParadaSugestao')
                        ->findOneBy(array('id' => $paradasSugestoes[$i]['id']));
                
                if($umParada == null){
                    $umParada = new \ApiBundle\Entity\ParadaSugestao();
                    $umParada->setId($paradasSugestoes[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umParada));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umParada->setId($paradasSugestoes[$i]['id']);
                
                $umBairro = $em->getRepository('ApiBundle:Bairro')
                        ->find($paradasSugestoes[$i]['bairro']);
                
                if(isset($paradasSugestoes[$i]['parada'])){
                    $umParadaVinculada = $em->getRepository('ApiBundle:Parada')
                        ->find($paradasSugestoes[$i]['parada']);
                }
                
                $umParada->setNome($paradasSugestoes[$i]['nome']);
                $umParada->setSlug($paradasSugestoes[$i]['slug']);
                $umParada->setLatitude($paradasSugestoes[$i]['latitude']);
                $umParada->setLongitude($paradasSugestoes[$i]['longitude']);
                
                if(isset($paradasSugestoes[$i]['taxaDeEmbarque'])){
                    $umParada->setTaxaDeEmbarque($paradasSugestoes[$i]['taxaDeEmbarque']);
                }
                
                if(isset($paradasSugestoes[$i]['imagem'])){
                    $umParada->setImagem($paradasSugestoes[$i]['imagem']);
                }
                
                if(isset($paradasSugestoes[$i]['usuarioCadastro'])){
                    $umUsuarioCadastro = $em->getRepository('ApiBundle:Usuario')
                        ->findOneBy(array('googleID' => $paradasSugestoes[$i]['usuarioCadastro']));
                    
                    $umParada->setUsuarioCadastro($umUsuarioCadastro);
                }
                
                if(isset($paradasSugestoes[$i]['usuarioUltimaAlteracao'])){
                    $umUsuario = $em->getRepository('ApiBundle:Usuario')
                        ->findOneBy(array('googleID' => $paradasSugestoes[$i]['usuarioUltimaAlteracao']));
                    
                    $umParada->setUsuarioUltimaAlteracao($umUsuario);
                }
                
                $umParada->setBairro($umBairro);
                $umParada->setParada($umParadaVinculada);
                
                if(!date_create_from_format('d-m-Y H:i:s', $paradasSugestoes[$i]['dataCadastro'])){
                        $umParada->setDataCadastro(date_create_from_format('d-m-Y H:i', $paradasSugestoes[$i]['dataCadastro']));
                } else{
                      $umParada->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $paradasSugestoes[$i]['dataCadastro']));  
                }
                
                if(!date_create_from_format('d-m-Y H:i:s', $paradasSugestoes[$i]['ultimaAlteracao'])){
                        $umParada->setUltimaAlteracao(date_create_from_format('d-m-Y H:i', $paradasSugestoes[$i]['ultimaAlteracao']));
                } else{
                      $umParada->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $paradasSugestoes[$i]['ultimaAlteracao']));  
                }
                
                if(isset($paradasSugestoes[$i]['programadoPara'])){
                    $umParada->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $paradasSugestoes[$i]['programadoPara']));
                }
                
                $umParada->setAtivo($paradasSugestoes[$i]['ativo']);
                $umParada->setStatus($paradasSugestoes[$i]['status']);
                
                $em->persist($umParada);
                
            }
            
            // FIM PARADA SUGESTAO
            
            // POI SUGESTAO
            
            $poisSugestoes = $dados['pontos_interesse_sugestoes'];
            
            $total = count($poisSugestoes);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umPoi = null;
                $umPoiVinculado = null;
                
                $umPoi = $em->getRepository('ApiBundle:PontoInteresseSugestao')
                        ->findOneBy(array('id' => $poisSugestoes[$i]['id']));
                
                if($umPoi == null){
                    $umPoi = new \ApiBundle\Entity\PontoInteresseSugestao();
                    $umPoi->setId($poisSugestoes[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umPoi));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umPoi->setId($poisSugestoes[$i]['id']);
                
                $umBairro = $em->getRepository('ApiBundle:Bairro')
                        ->find($poisSugestoes[$i]['bairro']);
                
                if(isset($poisSugestoes[$i]['pontoInteresse'])){
                    $umPoiVinculado = $em->getRepository('ApiBundle:PontoInteresse')
                        ->find($poisSugestoes[$i]['pontoInteresse']);
                }
                
                $umPoi->setNome($poisSugestoes[$i]['nome']);
                $umPoi->setSlug($poisSugestoes[$i]['slug']);
                $umPoi->setLatitude($poisSugestoes[$i]['latitude']);
                $umPoi->setLongitude($poisSugestoes[$i]['longitude']);
                
                if(isset($poisSugestoes[$i]['observacao'])){
                    $umPoi->setObservacao($poisSugestoes[$i]['observacao']);
                }
                
                if(isset($poisSugestoes[$i]['permanente'])){
                    $umPoi->setPermanente($poisSugestoes[$i]['permanente']);
                }
                
                if(isset($poisSugestoes[$i]['descricao'])){
                    $umPoi->setDescricao($poisSugestoes[$i]['descricao']);
                }
                
                if(isset($poisSugestoes[$i]['imagem'])){
                    $umPoi->setImagem($poisSugestoes[$i]['imagem']);
                }
                
                if(isset($poisSugestoes[$i]['usuarioCadastro'])){
                    $umUsuarioCadastro = $em->getRepository('ApiBundle:Usuario')
                        ->findOneBy(array('googleID' => $poisSugestoes[$i]['usuarioCadastro']));
                    
                    $umPoi->setUsuarioCadastro($umUsuarioCadastro);
                }
                
                if(isset($poisSugestoes[$i]['usuarioUltimaAlteracao'])){
                    $umUsuario = $em->getRepository('ApiBundle:Usuario')
                        ->findOneBy(array('googleID' => $poisSugestoes[$i]['usuarioUltimaAlteracao']));
                    
                    $umPoi->setUsuarioUltimaAlteracao($umUsuario);
                }
                
                $umPoi->setBairro($umBairro);
                $umPoi->setPontoInteresse($umPoiVinculado);
                
                if(isset($poisSugestoes[$i]['dataInicial'])){
                        if(!date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['dataInicial'])){
                                $umPoi->setDataInicial(date_create_from_format('d-m-Y H:i', $poisSugestoes[$i]['dataInicial']));
                        } else{
                              $umPoi->setDataInicial(date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['dataInicial']));  
                        }
                }
                
                if(isset($poisSugestoes[$i]['dataFinal'])){
                        if(!date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['dataFinal'])){
                                $umPoi->setDataFinal(date_create_from_format('d-m-Y H:i', $poisSugestoes[$i]['dataFinal']));
                        } else{
                              $umPoi->setDataFinal(date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['dataFinal']));  
                        }
                }
                
                
                if(!date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['dataCadastro'])){
                        $umPoi->setDataCadastro(date_create_from_format('d-m-Y H:i', $poisSugestoes[$i]['dataCadastro']));
                } else{
                      $umPoi->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['dataCadastro']));  
                }
                
                if(!date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['ultimaAlteracao'])){
                        $umPoi->setUltimaAlteracao(date_create_from_format('d-m-Y H:i', $poisSugestoes[$i]['ultimaAlteracao']));
                } else{
                      $umPoi->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['ultimaAlteracao']));  
                }
                
                if(isset($poisSugestoes[$i]['programadoPara'])){
                    $umPoi->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $poisSugestoes[$i]['programadoPara']));
                }
                
                $umPoi->setAtivo($poisSugestoes[$i]['ativo']);
                $umPoi->setStatus($poisSugestoes[$i]['status']);
                
                $em->persist($umPoi);
                
            }
            
            // FIM POI SUGESTAO
            
            // SERVICO
            
            $servicos = $dados['servicos'];
            
            $total = count($servicos);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umServico = null;
                
                $umServico = $em->getRepository('ApiBundle:Servico')
                        ->findOneBy(array('id' => $servicos[$i]['id']));
                
                if($umServico == null){
                    $umServico = new \ApiBundle\Entity\Servico();
                    $umServico->setId($servicos[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umServico));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umServico->setId($servicos[$i]['id']);
                
                $umServico->setNome($servicos[$i]['nome']);
                $umServico->setSlug($servicos[$i]['slug']);
                
                if(isset($servicos[$i]['icone'])){
                    $umServico->setIcone($servicos[$i]['icone']);
                }
                
                $umServico->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $servicos[$i]['dataCadastro']));
                $umServico->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $servicos[$i]['ultimaAlteracao']));
                
                if(isset($servicos[$i]['programadoPara'])){
                    $umServico->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $servicos[$i]['programadoPara']));
                }
                
                $umServico->setAtivo($servicos[$i]['ativo']);
                
                $em->persist($umServico);
                
            }
            
            // FIM SERVICO
            
            // PREFERENCIAS
            
            $preferencias = $dados['usuarios_preferencias'];
            
            $total = count($preferencias);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umPref = null;
                
                $umPref = $em->getRepository('ApiBundle:UsuarioPreferencia')
                        ->findOneBy(array('usuario' => $preferencias[$i]['usuario']));
                
                if($umPref == null){
                    $umPref = new \ApiBundle\Entity\UsuarioPreferencia();
                    $umPref->setId($preferencias[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umPref));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umPref->setId($preferencias[$i]['id']);
                
                $umPref->setUsuario($preferencias[$i]['usuario']);
                $umPref->setPreferencia($preferencias[$i]['preferencia']);
                $umPref->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $preferencias[$i]['dataCadastro']));
                $umPref->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $preferencias[$i]['ultimaAlteracao']));
                
                $umPref->setAtivo($preferencias[$i]['ativo']);

                $em->persist($umPref);

                
                
            }
            
            // FIM PREFERENCIAS
            
            // HISTORICO ITINERARIO
            
            $historicosItinerarios = $dados['historicos_itinerarios'];
            
            $total = count($historicosItinerarios);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umHistoricoItinerario = null;
                
                $umHistoricoItinerario = $em->getRepository('ApiBundle:HistoricoItinerario')
                        ->findOneBy(array('id' => $historicosItinerarios[$i]['id']));
                
                if($umHistoricoItinerario == null){
                    $umHistoricoItinerario = new \ApiBundle\Entity\HistoricoItinerario();
                    $umHistoricoItinerario->setId($historicosItinerarios[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umHistoricoItinerario));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umHistoricoItinerario->setId($historicosItinerarios[$i]['id']);
                
                $umItinerario = $em->getRepository('ApiBundle:Itinerario')
                        ->find($historicosItinerarios[$i]['itinerario']);
                
                $umHistoricoItinerario->setItinerario($umItinerario);
                
                $umHistoricoItinerario->setTarifa($historicosItinerarios[$i]['tarifa']);
                
                $umHistoricoItinerario->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $historicosItinerarios[$i]['dataCadastro']));
                $umHistoricoItinerario->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $historicosItinerarios[$i]['ultimaAlteracao']));
                
                $umHistoricoItinerario->setAtivo($historicosItinerarios[$i]['ativo']);
                
                $em->persist($umHistoricoItinerario);
                
            }
            
            // FIM HISTORICO ITINERARIO
            
            // VIAGEM ITINERARIO
            
            $viagensItinerarios = $dados['viagens_itinerarios'];
            
            $total = count($viagensItinerarios);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umViagemItinerario = null;
                
                $umViagemItinerario = $em->getRepository('ApiBundle:ViagemItinerario')
                        ->findOneBy(array('id' => $viagensItinerarios[$i]['id']));
                
                if($umViagemItinerario == null){
                    $umViagemItinerario = new \ApiBundle\Entity\ViagemItinerario();
                    $umViagemItinerario->setId($viagensItinerarios[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umViagemItinerario));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umViagemItinerario->setId($viagensItinerarios[$i]['id']);
                
                $umItinerario = $em->getRepository('ApiBundle:Itinerario')
                        ->find($viagensItinerarios[$i]['itinerario']);
                
                $umViagemItinerario->setItinerario($umItinerario);
                
                $umViagemItinerario->setTrajeto($viagensItinerarios[$i]['trajeto']);
                
                $umViagemItinerario->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $viagensItinerarios[$i]['dataCadastro']));
                $umViagemItinerario->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $viagensItinerarios[$i]['ultimaAlteracao']));
                
                if(isset($viagensItinerarios[$i]['programadoPara'])){
                    $umViagemItinerario->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $viagensItinerarios[$i]['programadoPara']));
                }
                
                if(isset($viagensItinerarios[$i]['horaInicial'])){
                    $umViagemItinerario->setHoraInicial(date_create_from_format('d-m-Y H:i:s', $viagensItinerarios[$i]['horaInicial']));
                } else{
                    $umViagemItinerario->setHoraInicial(date_create_from_format('d-m-Y H:i:s', '01-01-1900 00:00:00'));
                }
                
                if(isset($viagensItinerarios[$i]['horaFinal'])){
                    $umViagemItinerario->setHoraFinal(date_create_from_format('d-m-Y H:i:s', $viagensItinerarios[$i]['horaFinal']));
                }
                
                $umViagemItinerario->setAtivo($viagensItinerarios[$i]['ativo']);
                
                $em->persist($umViagemItinerario);
                
            }
            
            // FIM VIAGEM ITINERARIO
            
            // FERIADO
            
            $feriados = $dados['feriados'];
            
            $total = count($feriados);
            
            for($i = 0; $i < $total; $i++){
                
                $existe = false;
                $umFeriado = null;
                
                $umFeriado = $em->getRepository('ApiBundle:Feriado')
                        ->findOneBy(array('id' => $feriados[$i]['id']));
                
                if($umFeriado == null){
                    $umFeriado = new \ApiBundle\Entity\Feriado();
                    $umFeriado->setId($feriados[$i]['id']);
                } else{
                    $existe = true;
                }
                
                $metadata = $em->getClassMetaData(get_class($umFeriado));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
                $umFeriado->setId($feriados[$i]['id']);
                
                if(isset($feriados[$i]['cidade'])){
                    $umCidade = $em->getRepository('ApiBundle:Cidade')
                        ->find($feriados[$i]['cidade']);
                    $umFeriado->setCidade($umCidade);
                }
                
                $umFeriado->setNome($feriados[$i]['nome']);
                $umFeriado->setData(date_create_from_format('d-m-Y H:i:s', $feriados[$i]['data'], new \DateTimeZone('America/Sao_Paulo')));
                $umFeriado->setDescricao($feriados[$i]['descricao']);
                $umFeriado->setTipo($feriados[$i]['tipo']);
                $umFeriado->setSlug($feriados[$i]['slug']);
                
                $umFeriado->setDataCadastro(date_create_from_format('d-m-Y H:i:s', $feriados[$i]['dataCadastro']));
                $umFeriado->setUltimaAlteracao(date_create_from_format('d-m-Y H:i:s', $feriados[$i]['ultimaAlteracao']));
                
                if(isset($feriados[$i]['programadoPara'])){
                    $umFeriado->setProgramadoPara(date_create_from_format('d-m-Y H:i:s', $feriados[$i]['programadoPara']));
                }
                
                $umFeriado->setAtivo($feriados[$i]['ativo']);

                //dump($umEstado);
                
                $em->persist($umFeriado);
                
            }
            
            // FIM FERIADO
            
            $em->flush();
            
            return new Response('', 200);
            /*
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => 0, "status" => 200, "mensagem" => "ok"))
                    ),
                200, array('totalRegistros' => 0))->setTemplateVar("u");
            
            return $this->handleView($view);
             */
        } else {
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => 0, "status" => 403, "mensagem" => "Acesso negado."))
                    ),
                403, array('totalRegistros' => 0))->setTemplateVar("u");
            
            return $this->handleView($view);
        }
        
    }
    
    public function setImagemAction(Request $request, $hash) {
        $file = $request->files->get('upload');
        
        if($file){
            if($file->move(__DIR__.'/../../../web/uploads/imagens', $file->getClientOriginalName())){
                return new Response('ok', 200);
            } else{
                return new Response('error', 500);
            }
        } else{
            return new Response('error', 500);
        }
        
    }
    
    public function getImagemAction(Request $request, $nome) {

        $file = __DIR__.'/../../../web/uploads/imagens/'.$nome.'.png';
        
        $response = new \Symfony\Component\HttpFoundation\BinaryFileResponse($file);

        $d = $response->headers->makeDisposition(
                \Symfony\Component\HttpFoundation\ResponseHeaderBag::DISPOSITION_INLINE,
            $nome.".png"
           );

        $response->headers->set('Content-Disposition', $d);
        
        // To generate a file download, you need the mimetype of the file
        $mimeTypeGuesser = new \Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser();

        // Set the mimetype with the guesser or manually
        if($mimeTypeGuesser->isSupported()){
            // Guess the mimetype of the file according to the extension of the file
            $response->headers->set('Content-Type', $mimeTypeGuesser->guess($file));
        }else{
            // Set the mimetype of the file manually, in this case for a text file is text/plain
            $response->headers->set('Content-Type', 'image/png');
        }

        return $response;
        
    }
    
//    public function validaTokenAction() {
//        $em = $this->getDoctrine()->getManager();
//
//        // Get $id_token via HTTPS POST.
//        $CLIENT_ID = "763791909416-aim4u63mdttsktinjqroogqdndlibf7l.apps.googleusercontent.com";
//        $idToken = $this->get('request')->request->get('idToken');
//        
//        $client = new \Google_Client(['client_id' => $CLIENT_ID]);
//        $payload = $client->verifyIdToken($idToken);
//        
//        if ($payload) {
//            $email = $payload['email'];
//            $userid = $payload['sub'];
//            
//            $usuario = $em->getRepository('RepSiteBundle:Usuario')
//                        ->findOneBy(array('email' => $email));
//            
//            if($usuario != null){
//                
//                if($usuario->getGoogleId() == null){
//                    $usuario->setGoogleID($userid);
//                    $em->persist($usuario);
//                    $em->flush();
//                }
//                
//                $view = View::create(
//                    array(
//                        "meta" => array(array("registros" => 0, "status" => 200, "mensagem" => "ok"))
//                    ),
//                    200, array('totalRegistros' => 0))->setTemplateVar("u");
//
//                return $this->handleView($view); 
//                
//            } else {
//                $view = View::create(
//                        array(
//                            "meta" => array(array("registros" => 0, "status" => 403, "mensagem" => "Acesso negado."))
//                        ),
//                    403, array('totalRegistros' => 0))->setTemplateVar("u");
//
//                return $this->handleView($view);
//            }
//            
//        }
//        
//    }
    
    public function validaUsuarioAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        // Get $id_token via HTTPS POST.
        $CLIENT_ID = "301375921468-s9146rmd1ih7vto7ujtqotp1v92rgacr.apps.googleusercontent.com";
        $crypto = new MCrypt();
        
        $idToken = $crypto->decrypt($request->get('idToken'));
        $id = $crypto->decrypt($request->get('id'));
        
        $client = new \Google_Client(['client_id' => $CLIENT_ID]);
        $payload = $client->verifyIdToken($idToken);
        
        if ($payload) {
            $email = $payload['email'];
            $userid = $payload['sub'];
            
            $usuario = $em->getRepository('ApiBundle:Usuario')
                        ->findOneBy(array('googleID' => $userid));
            
            if($usuario != null){
                
                if($usuario->getGoogleID() == null){
                    $usuario->setGoogleID($userid);
                }
                
                $usuario->setLastLogin(new \DateTime());
                
                $em->persist($usuario);
                $em->flush();
                
                $idUsuario = $crypto->encrypt($usuario->getId());
                
                $pref = $em->getRepository('ApiBundle:UsuarioPreferencia')
                        ->listarPreferenciaSemData(null, $usuario->getId());
                
                return new Response($idUsuario.";".$pref[0]['preferencia']);
                
            } else {
                $user = $this->get('fos_user.user_manager')->createUser();
                //I have set all requested data with the user's username
                //modify here with relevant data
                $user->setUsername($payload['given_name']);
                $user->setEmail($payload['given_name'].".none@email.com");
                $user->setPlainPassword($payload['given_name']);
                $user->setDataCadastro(new \DateTime());
                $user->setGoogleID($payload['sub']);
                $user->setGoogleAccessToken($idToken);
                $user->setEnabled(true);
                $user->setLastLogin(new \DateTime());

                $this->get('fos_user.user_manager')->updateUser($user);
                
                $idUsuario = $crypto->encrypt($user->getId());
                
                return new Response($idUsuario);
            }
            
        } else{
            $view = View::create(
                        array(
                            "meta" => array(array("registros" => 0, "status" => 403, "mensagem" => "Acesso negado."))
                        ),
                    403, array('totalRegistros' => 0))->setTemplateVar("u");

                return $this->handleView($view);
        }
        
    }
    
    public function getPreferenciasAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $crypto = new MCrypt();
        
        $idDescriptografado = $crypto->decrypt($id);
        
        $preferencias = $em->getRepository('ApiBundle:UsuarioPreferencia')
                ->listarTodosRESTSemData(null, $idDescriptografado);
        
        $totalRegistros = count($preferencias);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "preferencias" => $preferencias
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }

    public function getEmpresasAction(Request $request, $slug = "") {
        $em = $this->getDoctrine()->getManager();
        
        $empresas = $em->getRepository('ApiBundle:Empresa')
                ->listarTodosRESTSemData(null, $slug);
        
        $totalRegistros = count($empresas);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "empresas" => $empresas
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getCidadesAction(Request $request, $uf = "", $slug = "") {
        $em = $this->getDoctrine()->getManager();
        
        $cidades = $em->getRepository('ApiBundle:Cidade')
                ->listarTodosRESTSemData(null, $uf, $slug);
        
        $totalRegistros = count($cidades);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "cidades" => $cidades
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getBairrosAction(Request $request, $uf = "", $cidade = "", $slug = "") {
        $em = $this->getDoctrine()->getManager();
        
        $bairros = $em->getRepository('ApiBundle:Bairro')
                ->listarTodosRESTSemData(null, $uf, $cidade, $slug);
        
        $totalRegistros = count($bairros);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "bairros" => $bairros
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getParadasAction(Request $request, $uf = "", $cidade = "", $bairro = "", $slug = "") {
        $em = $this->getDoctrine()->getManager();
        
        $paradas = $em->getRepository('ApiBundle:Parada')
                ->listarTodosRESTSemData(null, $uf, $cidade, $bairro, $slug);
        
        $totalRegistros = count($paradas);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "paradas" => $paradas
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getPontosInteresseAction(Request $request, $uf = "", $cidade = "", $bairro = "", $slug = "") {
        $em = $this->getDoctrine()->getManager();
        
        $pois = $em->getRepository('ApiBundle:PontoInteresse')
                ->listarTodosRESTSemData(null, $uf, $cidade, $bairro, $slug);
        
        $totalRegistros = count($pois);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "pontos_interesse" => $pois
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getItinerariosParadaAction(Request $request, $uf = "", $cidade = "", $bairro = "", $slug = "") {
        $em = $this->getDoctrine()->getManager();
        
        $itinerarios = $em->getRepository('ApiBundle:ParadaItinerario')
                ->listarTodosRESTSemData(null, $uf, $cidade, $bairro, $slug);
        
        $totalRegistros = count($itinerarios);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "itinerarios_parada" => $itinerarios
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
        public function getItinerariosParadaPorIdAction(Request $request, $id = "") {
        $em = $this->getDoctrine()->getManager();
        
        $itinerarios = $em->getRepository('ApiBundle:ParadaItinerario')
                ->listarTodosRESTSemDataPorId(null, $id);
        
        $it = array();
        
        foreach($itinerarios as $i){
            $proximoHorario = $this->getProximoHorarioItinerarioTextoAction($request, $i['id'], null);
            $paradas = $this->getParadasItinerarioTextoAction($request, $i['id']);
            $its = array($i, $proximoHorario['horario'], $paradas, $proximoHorario['observacao']);
            array_push($it, $its);
        }
        
        usort($it, function($a, $b){
            return $a[1] > $b[1];
        });
        
        $totalRegistros = count($it);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "itinerarios_parada" => $it
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getHorariosItinerarioAction(Request $request, $itinerario) {
        $em = $this->getDoctrine()->getManager();
        
        $horarios = $em->getRepository('ApiBundle:HorarioItinerario')
                ->listarTodosRESTSemData(null, $itinerario);
        
        $totalRegistros = count($horarios);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "horarios_itinerario" => $horarios
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getProximoHorarioItinerarioAction(Request $request, $itinerario, $hora) {
        $em = $this->getDoctrine()->getManager();
        
        $horarios = $em->getRepository('ApiBundle:HorarioItinerario')
                ->listarProximoHorarioREST(1, $itinerario, $hora);
        
        $totalRegistros = count($horarios);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "horarios_itinerario" => $horarios
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getProximoHorarioItinerarioTextoAction(Request $request, $itinerario, $hora) {
        $em = $this->getDoctrine()->getManager();
        
        $horarios = $em->getRepository('ApiBundle:HorarioItinerario')
                ->listarProximoHorarioREST(1, $itinerario, $hora);
        
        return $horarios[0];
        
    }
    
    public function getHorarioAnteriorItinerarioAction(Request $request, $itinerario, $hora) {
        $em = $this->getDoctrine()->getManager();
        
        $horarios = $em->getRepository('ApiBundle:HorarioItinerario')
                ->listarHorarioAnteriorREST(1, $itinerario, $hora);
        
        $totalRegistros = count($horarios);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "horarios_itinerario" => $horarios
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getPrimeiroHorarioItinerarioAction(Request $request, $itinerario, $dia) {
        $em = $this->getDoctrine()->getManager();
        
        $horarios = $em->getRepository('ApiBundle:HorarioItinerario')
                ->listarPrimeiroHorarioREST(1, $itinerario, $dia);
        
        $totalRegistros = count($horarios);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "horarios_itinerario" => $horarios
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getUltimoHorarioItinerarioAction(Request $request, $itinerario, $dia) {
        $em = $this->getDoctrine()->getManager();
        
        $horarios = $em->getRepository('ApiBundle:HorarioItinerario')
                ->listarUltimoHorarioREST(1, $itinerario, $dia);
        
        $totalRegistros = count($horarios);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "horarios_itinerario" => $horarios
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getHorarioSeguinteItinerarioAction(Request $request, $itinerario, $hora) {
        $em = $this->getDoctrine()->getManager();
        
        $horarios = $em->getRepository('ApiBundle:HorarioItinerario')
                ->listarHorarioSeguinteREST(1, $itinerario, $hora);
        
        $totalRegistros = count($horarios);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "horarios_itinerario" => $horarios
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getParadasItinerarioAction(Request $request, $itinerario) {
        $em = $this->getDoctrine()->getManager();
        
        $paradas = $em->getRepository('ApiBundle:ParadaItinerario')
                ->listarTodasParadasRESTSemDataComCidadeEBairro(null, $itinerario);
        
        $totalRegistros = count($paradas);
        
            $view = View::create(
                    array(
                        "meta" => array(array("registros" => $totalRegistros, "status" => 200, "mensagem" => "ok")),
                        "paradas" => $paradas
                    ), 200, array('totalRegistros' => $totalRegistros))->setTemplateVar("u");


            return $this->handleView($view);
        
    }
    
    public function getParadasItinerarioTextoAction(Request $request, $itinerario) {
        $em = $this->getDoctrine()->getManager();
        
        $paradas = $em->getRepository('ApiBundle:ParadaItinerario')
                ->listarTodasParadasRESTSemDataComCidadeEBairro(null, $itinerario);
        
        return $paradas;
        
    }
    
}
