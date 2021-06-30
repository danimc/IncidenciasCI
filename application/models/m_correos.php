<?php 

class m_correos extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function correo_ticket_cerrado($folio, $fecha, $hora)
	{
	//	$usr = $this->m_ticket->seguimiento_ticket($folio);
		$ticket = $this->m_ticket->seguimiento_ticket($folio);
		$horario = $hora;
		$saludo = '';

		if($horario <= '11:59:59'){
			$saludo = 'Buenos días';
		}
		elseif ($horario <= '19:59:59') {
			$saludo = 'Buenas tardes';
		}
		elseif ($horario <= '23:59:59') {
			$saludo = 'Buenas noches';
		}
		$datos['hora_enviado'] = $hora;
		$datos['ticket'] = $ticket;
		$datos['saludo'] = $saludo;

		//$this->load->view('_head');
		$msg = $this->load->view('correos/c_cerrarTicket', $datos, true);

		$this->load->library('email');
		$this->email->from('incidenciasoag@gmail.com', 'incidenciasOAG');
		$this->email->to($ticket->correo);
		$this->email->cc('incidenciasoag@gmail.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject('Incidente Resuleto | incidenciasOAG');
		$this->email->message($msg);
		$this->email->set_mailtype('html');
		$this->email->send();

	}


	function correo($folio=1338, $hora="19:59:59")
	{
	//	$usr = $this->m_ticket->seguimiento_ticket($folio);
		$ticket = $this->m_ticket->seguimiento_ticket($folio);
		$horario = $hora;
		$saludo = '';

		if($horario <= '11:59:59'){
			$saludo = 'Buenos días';
		}
		elseif ($horario <= '19:59:59') {
			$saludo = 'Buenas tardes';
		}
		elseif ($horario <= '23:59:59') {
			$saludo = 'Buenas noches';
		}
		$datos['hora_enviado'] = $hora;
		$datos['ticket'] = $ticket;
		$datos['saludo'] = $saludo;

		//$this->load->view('_head');
		$msg = $this->load->view('correos/c_cerrarTicket', $datos, true);

		$this->load->library('email');
		$this->email->from('incidenciasoag@gmail.com', 'HelpDesk OAG');
		$this->email->to('daniel_k310a@hotmail.com');
		$this->email->cc('incidenciasoag@gmail.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject('Incidente Resuleto | incidenciasOAG');
		$this->email->message($msg);
		$this->email->set_mailtype('html');
		$this->email->send();

		echo $this->email->print_debugger();

	}
}