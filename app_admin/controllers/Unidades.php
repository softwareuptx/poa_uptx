<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Unidades
 *
 * Modulo CRUD para Unidades 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Unidades extends CI_Controller
{
    /**
     * Muestra el listado de unidades
     *
     * @return void
     */
    public function index()
    {
        $data['unidades'] = $this->munidades->listar();
        $data['instituciones'] = $this->minstituciones->listar();
        $this->load->view('unidades/listar',$data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Agrega un registro nuevo
     *
     * @return void
     */
    public function agregar()
    {
        // Validaciones de Formulario
        $this->form_validation->set_rules('institucion', 'Nombre de la institución', 'required|callback_validarinstitucion');
        $this->form_validation->set_rules('unidad', 'Nombre de la Unidad', 'required');
        $this->form_validation->set_rules('persona', 'Nombre del responsable', 'required|callback_validarpersona');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            $personas = $this->input->post('persona');

            $persona = $this->mpersonas->obtener($personas);

            //Preparamos la información para insertar en la tabla usuarios
            $data_persona = array(
                'u_refsii'      => $persona->idpersonas,
                'u_institucion' => $this->input->post('institucion',TRUE),
                'u_nombre'      => $persona->nombre,
                'u_appaterno'   => $persona->apellidopat,
                'u_apmaterno'   => $persona->apellidomat,
                'u_password'    => $persona->password,
                'u_create'      => date('Y:m:d')
                );

            //Agregamos la información en la tabla usuarios
            $idpersona = $this->mpersonas->agregar($data_persona);

            //Preparamos la información para insertar
            $data_unidades = array(
                'uni_institucion' => $this->input->post('institucion',TRUE),
                'uni_nombre'      => $this->input->post('unidad',TRUE),
                'uni_responsable' => $idpersona,
                'uni_create'      => date('Y:m:d')
                );

            $this->munidades->agregar($data_unidades);
            $this->alerts->success('unidades');
        }

        $data['personas']        = $this->mpersonas->listar();

        $data['instituciones']   = $this->minstituciones->listar();
        
        $this->load->view('unidades/agregar',$data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Edita un registro
     *
     * @param   Int
     * @return  void
     */
    public function editar($id=NULL)
    {
        //Validamos id
        if(!$id)
            $this->alerts->_403();
        //Validos la informacion
        if($this->munidades->validar($id))
            $this->alerts->danger('unidades',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('institucion', 'Nombre de la institución', 'required|callback_validarinstitucion');
        $this->form_validation->set_rules('unidad', 'Nombre de la Unidad', 'required');
        $this->form_validation->set_rules('persona', 'Nombre del responsable', 'required|callback_validarpersona');

        if( $this->form_validation->run() && $this->input->post() )
        {   

            $personas = $this->input->post('persona');

            $persona = $this->mpersonas->obtener($personas);

            //Preparamos la información para insertar en la tabla usuarios
            $data_persona = array(
                'u_refsii'      => $persona->idpersonas,
                'u_institucion' => $this->input->post('institucion',TRUE),
                'u_nombre'      => $persona->nombre,
                'u_appaterno'   => $persona->apellidopat,
                'u_apmaterno'   => $persona->apellidomat,
                'u_password'    => $persona->password,
                'u_create'      => date('Y:m:d')
                );

            //Agregamos la información en la tabla usuarios
            $idpersona = $this->mpersonas->agregar($data_persona);

            //Preparamos la información para insertar
            $data_unidad = array(
                'uni_institucion' => $this->input->post('institucion',TRUE),
                'uni_nombre'      => $this->input->post('unidad',TRUE),
                'uni_responsable' => $idpersona,
                'uni_update'      => date('Y:m:d')
                );

            $this->munidades->editar($id, $data_unidad);
            $this->alerts->success('unidades');
        }

        $data['personas']        = $this->mpersonas->listar();

        $data['instituciones']   = $this->minstituciones->listar();

        $data['unidad']        = $this->munidades->obtener($id);

        $this->load->view('unidades/editar',$data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Elimina un registro
     *
     * @param   Int
     * @return  Void
     */
    public function eliminar($id=NULL)
    {
        //Validamos id
        if(!$id)
            $this->alerts->_403();
        //Validos la informacion
        if($this->munidades->validar($id))
            $this->alerts->danger('unidades',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->munidades->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('unidades');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('unidades',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('unidades',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
    /**
     * Valida la institución
     *
     * @param   Int
     * @return  boolean
     */
    public function validarinstitucion($id)
    {
        if($this->minstituciones->validar($id))
        {
            $this->form_validation->set_message('validarinstitucion', 'Seleccione una institución valida por favor');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
    /**
     * Valida la persona
     *
     * @param   Int
     * @return  boolean
     */
    public function validarpersona($id)
    {
        if($this->mpersonas->validar($id))
        {
            $this->form_validation->set_message('validarpersona', 'Seleccione un usuario valido por favor');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Unidades.php 
 * Ubicacion: ./app_admin/controllers/Unidades.php
 */