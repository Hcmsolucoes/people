<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
 

/**
* Metodo que configura numero de registro por pagina
*/
function qntpaginacao()
{
       return 5;
}

/**
* Metodo que cria link de paginacao
*/
function createPaginate( $_modulo, $_total )
{	
       $ci = &get_instance();
       $ci->load->library('pagination');

       $config['base_url']    = base_url($_modulo.'/listar/');
       $config['total_rows']  = $_total;
       $config['per_page']    = qntpaginacao();
       $config["uri_segment"] = 3;
       $config['first_link']  = 'Primeiro';
       $config['last_link']   = 'Último';
       $config['next_link']   = 'Próximo';
       $config['prev_link']   = 'Anterior';

       $ci->pagination->initialize($config);
       return $ci->pagination->create_links();
}