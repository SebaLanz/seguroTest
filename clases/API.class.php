<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class API {
	
	private $clienteApi;

	public function __construct(){
		$this->clienteApi = new Client();
	}

	////////////// USUARIOS
	public function login($usuario, $password){
	 	try{			
			$headers = ['Content-Type' => 'application/json'];
			$body = '{
						"usuario": "'.$usuario.'",
						"pass": "'.$password.'"
					}';
			$request = new Request('POST', API_URL.'/login', $headers, $body);
			$res = $this->clienteApi->sendAsync($request)->wait();
			$logindata = json_decode($res->getBody(true)->getContents());
			//var_dump($logindata);
			$_SESSION['TISA_TOKEN'] = $logindata->data->token;
			$_SESSION['TISA_USERNAME'] = $usuario;			
			return $logindata->data->login_status;
		}catch (RequestException $e){			
            	$this->StatusCodeHandling("",$e);         
		}

	 }

	public function getUsuariosAll(){
	 	try{			
			$headers = [
			  'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
			];			
			$request = new Request('GET', API_URL.'/usuario/all', $headers);
			$res = $this->clienteApi->sendAsync($request)->wait();
			$respuesta = json_decode($res->getBody(true)->getContents());			
			return $respuesta->data;			
		}catch (RequestException $e){			
            	$this->StatusCodeHandling("/usuario/all",$e);         
		}

	 }

	 public function getUsuarioImgPerfil($id_usuario){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/usuario/img/'.$id_usuario, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/usuario/img",$e);         
	   }

	}
	 
	 public function getUsuarioById($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/usuario/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/usuario/id",$e);         
	   }

	}

	// Obtengo el ID del usuario logeado
	public function getIdByUsuario($usuario){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/usuario/id/'.$usuario, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/usuario/id/sdsd.$usuario",$e);         
	   }

	}
	
	public function crearUsuario($jsonUsuario){
		try{            
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];          
		   $request = new Request('POST', API_URL.'/usuario', $headers, $jsonUsuario);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());            
		   return $respuesta->status_msg;           
	   }catch (RequestException $e){            
			   $this->StatusCodeHandling("/usuario/",$e);         
	   }
	
	}
	public function actualizarUsuario($usuario,$email){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   //$request = new Request('PUT', API_URL.'/usuario/', $headers, $jsonUsuario); asi no encuentra la ruta		
		   $request = new Request('PUT', API_URL.'/usuario/'.$usuario.'/'.$email, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
		//$this->StatusCodeHandling("/usuario/",$e); asi se rompe 
			   $this->StatusCodeHandling("/usuario/".$usuario.$email,$e);         
	   }

	}

	public function desactivarUsuario($usuario){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   //$request = new Request('PUT', API_URL.'/usuario/', $headers, $jsonUsuario); asi no encuentra la ruta		
		   $request = new Request('PUT', API_URL.'/usuario/desactivar/'.$usuario, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
		//$this->StatusCodeHandling("/usuario/",$e); asi se rompe 
			   $this->StatusCodeHandling("/usuario/",$e);         
	   }

	}
	public function activarUsuario($usuario){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   //$request = new Request('PUT', API_URL.'/usuario/', $headers, $jsonUsuario); asi no encuentra la ruta		
		   $request = new Request('PUT', API_URL.'/usuario/activar/'.$usuario, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
		//$this->StatusCodeHandling("/usuario/",$e); asi se rompe 
			   $this->StatusCodeHandling("/usuario/",$e);         
	   }

	}
	 
	 
	 
	 
	 
	 ////////////// FIN USUARIOS
	 ////////////// clienteS
	 //Me traigo todos los clientes relacionados al ID del usuario que se encuentra en la TABLA cliente
	 public function getClientesAll($id_usuario){
	 	try{			
			$headers = [
			  'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
			];			
			$request = new Request('GET', API_URL.'/cliente/all/'.$id_usuario, $headers);
			$res = $this->clienteApi->sendAsync($request)->wait();
			$respuesta = json_decode($res->getBody(true)->getContents());			
			return $respuesta->data;			
		}catch (RequestException $e){			
            	$this->StatusCodeHandling("/cliente/all",$e);         
		}

	 }

	 //select by id de la tabla cliente
	public function getClienteById($id_cliente){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/cliente/'.$id_cliente, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/cliente/id",$e);         
	   }

	}

	//select all con filtro, TODOS LOS Clientes RELACIONADOS AL USUARIO LOGEADO.
	public function getAllByUserLog($id_usuario){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/cliente/all/'.$id_usuario, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/cliente/all/id",$e);         
	   }

	}

	public function crearCliente($jsonCliente){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		   
		   $request = new Request('POST', API_URL.'/cliente', $headers, $jsonCliente);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/cliente/",$e);         
	   }
	}
	
	
	public function actualizarCliente($jsonCliente){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/cliente', $headers, $jsonCliente);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/cliente/",$e);         
	   }

	}
	
	public function borrarCliente($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']			 
		   ];			
		   $request = new Request('DELETE', API_URL.'/cliente/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/cliente/",$e);         
	   }
	}

	public function desactivarCliente($id_cliente){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   $request = new Request('PUT', API_URL.'/cliente/desactivar/'.$id_cliente, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/cliente/",$e);         
	   }

	}
	public function activarCliente($id_cliente){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   $request = new Request('PUT', API_URL.'/cliente/activar/'.$id_cliente, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/cliente/",$e);         
	   }

	}

////////////// FIN Cliente

		////////////// MISCELANEAS
	public function getProvincias(){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/misc/provincia/all', $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/cliente/id",$e);         
	   }

	}

	public function getRubrosAll(){
		 	try{			
				$headers = [
				  'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
				];			
				$request = new Request('GET', API_URL.'/rubro/all', $headers);
				$res = $this->clienteApi->sendAsync($request)->wait();
				$respuesta = json_decode($res->getBody(true)->getContents());			
				return $respuesta->data;			
			}catch (RequestException $e){			
	            	$this->StatusCodeHandling("/rubro/all",$e);         
			}

		 }

	public function getRubroById($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/rubro/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/rubro/id",$e);         
	   }

	}

	public function crearrubro($jsonrubro){
			try{			
			   $headers = [
				 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
				 'Content-Type' => 'application/json'
			   ];		   
			   $request = new Request('POST', API_URL.'/rubro', $headers, $jsonrubro);
			   $res = $this->clienteApi->sendAsync($request)->wait();
			   $respuesta = json_decode($res->getBody(true)->getContents());			
			   return $respuesta->status_msg;			
		   }catch (RequestException $e){			
				   $this->StatusCodeHandling("/rubro/",$e);         
		   }
		}

	public function actualizarrubro($jsonrubro){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/rubro', $headers, $jsonrubro);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/rubro/",$e);         
	   }

	}

		public function activarrubro($jsonrubro){
			try{			
			   $headers = [
				 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
				 'Content-Type' => 'application/json'
			   ];		
			   $request = new Request('PUT', API_URL.'/rubro/activar/'.$jsonrubro, $headers);
			   $res = $this->clienteApi->sendAsync($request)->wait();
			   $respuesta = json_decode($res->getBody(true)->getContents());			
			   return $respuesta->status_msg;			
		   }catch (RequestException $e){			
				   $this->StatusCodeHandling("/rubro/",$e);         
		   }

		}

		public function desactivarrubro($jsonrubro){
        try{            
           $headers = [
             'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
             'Content-Type' => 'application/json'
           ];    
           $request = new Request('PUT', API_URL.'/rubro/desactivar/'.$jsonrubro, $headers);
           $res = $this->clienteApi->sendAsync($request)->wait();
           $respuesta = json_decode($res->getBody(true)->getContents());            
           return $respuesta->status_msg;           
       }catch (RequestException $e){            
               $this->StatusCodeHandling("/rubro/",$e);         

       }

    }
	////////////// FIN MISCELANEAS
	 // arma las excepciones por errores de http status
	 public function StatusCodeHandling($endPoint,$e){	 		
			$response = json_decode($e->getResponse()->getBody(true)->getContents());
			//var_dump($response);
			if(isset($response->status_msg)){
				throw new Exception(" API $endPoint : ".$response->status_msg); 
			}else{
				if($e->getResponse()->getStatusCode()==404){
					throw new Exception(" API $endPoint : No se encuentra la ruta "); 
				}else{
					throw new Exception(" API $endPoint : ".$e->getMessage()); 
				}
				
			}
	 }

	 ///////////PROVEEDORES
	 public function getProveedoresAll(){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/proveedor/all', $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/proveedor/all",$e);         
	   }

	}

	public function getProveedorById($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/proveedor/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/proveedor/id",$e);         
	   }

	}

	public function crearProveedor($jsonProveedor){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		   
		   $request = new Request('POST', API_URL.'/proveedor', $headers, $jsonProveedor);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/proveedor/",$e);         
	   }

	}

	public function actualizarProveedor($jsonProveedor){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/proveedor', $headers, $jsonProveedor);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/proveedor/",$e);         
	   }

	}

	public function borrarProveedor($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']			 
		   ];			
		   $request = new Request('DELETE', API_URL.'/proveedor/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/proveedor/",$e);         
	   }
	}

	public function desactivarProveedor($proveedor){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		
		   $request = new Request('PUT', API_URL.'/proveedor/desactivar/'.$proveedor, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/proveedor/",$e);         
	   }

	}

	public function activarProveedor($proveedor){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		
		   $request = new Request('PUT', API_URL.'/proveedor/activar/'.$proveedor, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/proveedor/",$e);         
	   }

	}


	

// AUTOMOVIL


	public function crearAutomovil($jsonAutomovil){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		   
		   $request = new Request('POST', API_URL.'/automovil/crear', $headers, $jsonAutomovil);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/automovil/crear",$e);         
	   }

	}
	public function actualizarAutomovil($jsonAutomovil){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/automovil/actualizar', $headers, $jsonAutomovil);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/automovil/",$e);         
	   }

	}


	//obtener  todos los automoviles
		public function getAutomovilesAll($id_usuario){
			try{			
			$headers = [
				'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
			];			
			$request = new Request('GET', API_URL.'/automovil/all/'.$id_usuario, $headers);
			$res = $this->clienteApi->sendAsync($request)->wait();
			$respuesta = json_decode($res->getBody(true)->getContents());			
			return $respuesta->data;			
		}catch (RequestException $e){			
				$this->StatusCodeHandling("/automovil/all",$e);         
		}
	}

	//obtener automovil por id
	public function getAutomovilById($id){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/automovil/id/'.$id, $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/automovil/id",$e);         
		}
	}

	//obtener automovil por patente
	public function getByPatente($patente){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/automovil/'.$patente, $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/automovil/patente",$e);         
		}
	}

	//desactivar automovil
	public function desactivarAutomovil($patente){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   $request = new Request('PUT', API_URL.'/automovil/desactivar/'.$patente, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/automovil/",$e);         
	   }
	}
	//activo automovil
	public function activarAutomovil($patente){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   $request = new Request('PUT', API_URL.'/automovil/activar/'.$patente, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/automovil/",$e);         
	   }
	}

	//obtengo auto/moto,camion, etc
	public function getTipoAutomovil(){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/misc/automovil/all', $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/automovil/all",$e);         
	   }
	}

	//obtengo ferrari,ford,chevrotl, etc
	public function getMarca(){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/misc/marca/all', $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/marca/all",$e);         
	   }
	}
	//obtengo el Detalle Completo de los vehículos que están relacionados a los clientes y al usuario logeado.
	// Sería, obtengo el vehículo de un cliente que tiene el usuario logeado.
	public function getClientesDelUsuario($usuario){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/automovil/'.$usuario, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/usuario/",$e);         
	   }
	}

	// TABLA TIPO_PLAN

	//obtener  todos los Planes
	public function getPlanAll(){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/plan/all', $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/plan/all",$e);         
	}
}

	//obtener Planes por id
	public function getPlanById($id){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/plan/'.$id, $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/plan/id",$e);         
		}
	}

	//desactivar Planes
	public function desactivarPlan($id_tipo_plan){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   $request = new Request('PUT', API_URL.'/plan/desactivar/'.$id_tipo_plan, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/plan/",$e);         
	   }
	}
	//activo Planes
	public function activarPlan($id_tipo_plan){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   $request = new Request('PUT', API_URL.'/plan/activar/'.$id_tipo_plan, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/plan/",$e);         
	   }
	}

	public function crearPlan($jsonPlan){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		   
		   $request = new Request('POST', API_URL.'/plan', $headers, $jsonPlan);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/plan",$e);         
	   }

	}

	public function actualizarPlan($jsonPlan){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/plan/actualizar', $headers, $jsonPlan);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/plan/actualizar",$e);         
	   }

	}

	// TABLA PLAN_PAGO || FORM PAGOS.PHP

		public function getPagoAll(){
			try{			
			$headers = [
				'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
			];			
			$request = new Request('GET', API_URL.'/plan_pago/all', $headers);
			$res = $this->clienteApi->sendAsync($request)->wait();
			$respuesta = json_decode($res->getBody(true)->getContents());			
			return $respuesta->data;			
		}catch (RequestException $e){			
				$this->StatusCodeHandling("/plan_pago/all",$e);         
		}
	}

	//obtener Planes por id
	public function getPagoById($id){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/plan_pago/'.$id, $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/plan_pago/id",$e);         
		}
	}

	public function crearPago($jsonPago){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		   
		   $request = new Request('POST', API_URL.'/plan_pago', $headers, $jsonPago);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/plan_pago",$e);         
	   }

	}

	//TABLA MEDIOS DE PAGO

	
	public function getMediosDePagoAll(){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/medio_pago/all', $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/medio_pago/all",$e);         
	}
}

	//obtener MEDIOS DE PAGO por id
	public function getMedioDePagoById($id){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/medio_pago/'.$id, $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/medio_pago/id",$e);         
		}
	}

	//desactivar Planes
	public function desactivarPago($id_medio_pago){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   $request = new Request('PUT', API_URL.'/medio_pago/desactivar/'.$id_medio_pago, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/medio_pago/",$e);         
	   }
	}
	//activo Planes
	public function activarPago($id_medio_pago){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   $request = new Request('PUT', API_URL.'/medio_pago/activar/'.$id_medio_pago, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/medio_pago/",$e);         
	   }
	}

	public function crearMedioDePago($jsonPago){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		   
		   $request = new Request('POST', API_URL.'/medio_pago', $headers, $jsonPago);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/medio_pago",$e);         
	   }

	}

	public function actualizarPago($jsonPago){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/medio_pago/actualizar', $headers, $jsonPago);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/medio_pago/actualizar",$e);         
	   }

	}


	//USUARIOPERFIL

	//ME trae el permiso y la imagen del usuario logeado
	public function getUsuarioPerfilAll($id_usuario){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/usuarioPerfil/all/'.$id_usuario, $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/usuarioPerfil/all",$e);         
		}
	}

	//Me traigo los datos personales del usuario logeado
	public function getUsuarioPerfilDatosAll($id_usuario){
		try{			
		$headers = [
			'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		];			
		$request = new Request('GET', API_URL.'/usuarioPerfil/allPerfil/'.$id_usuario, $headers);
		$res = $this->clienteApi->sendAsync($request)->wait();
		$respuesta = json_decode($res->getBody(true)->getContents());			
		return $respuesta->data;			
	}catch (RequestException $e){			
			$this->StatusCodeHandling("/usuarioPerfil/allPerfil",$e);         
		}
	}

	public function actualizarUsuarioPerfil($jsonUsuarioPerfil){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/usuarioPerfil/actualizar', $headers, $jsonUsuarioPerfil);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/usuarioPerfil/actualizar",$e);         
	   }

	}

	public function actualizarUsuarioImg($jsonUsuarioPerfil){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/usuarioPerfil/actualizar/img', $headers, $jsonUsuarioPerfil);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/usuarioPerfil/actualizar/img",$e);         
	   }

	}

}
?>