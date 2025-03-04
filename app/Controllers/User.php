<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    // protected $modelName = 'App\Models\UsuarioModel';
    // protected $format = 'json';
    
    public function __construct()
    {
        $this->model = new \App\Models\User();
    }
    
    public function index()
    {   
        $users = $this->model->findAll();

        if(empty($users)) {
            $data = [
                'message' => 'No se encontraron usuarios',
                'status' => 404
            ];
            return $this->response->setJSON($data, 404);
        }
            
        // return $this->response->setJSON($users, 200);
        return $this->respond($this->model->findAll());
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $user = $this->model->find($id);

        if($user) {
            return $this->response->setJSON($user, 200);
        } else {
            $data = [
                'message' => 'No se encontraron usuarios',
                'status' => 404
            ];
            return $this->response->setJSON($data, 404);
        }
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $json = $this->request->getJSON();
        
        $data = [
            'imagen' => $json->imagen ?? null,
            'nombre' => $json->nombre,
            'apellidos' => $json->apellidos,
            'email' => $json->email,
            'password' => $json->password,
            'telefono' => $json->telefono,
            'reset_token' => $json->reset_token ?? null,
            'reset_token_expiration' => $json->reset_token_expiration ?? null,
            'status' => $json->status
        ];

        if (!$this->model->insert($data)) {
            return $this->response->setJSON([
                'message' => 'No se pudo crear el usuario',
                'status'  => 500
            ], 500);
        }
    
        $user = $this->model->find($this->model->insertID());
    
        return $this->response->setJSON([
            'user'    => $user,
            'message' => 'Usuario creado exitosamente'
        ], 201);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            $data = [
                'message' => 'No se encontró el usuario',
                'status'  => 404
            ];
            return $this->response->setJSON($data, 404);
        }

        $json = $this->request->getJSON();

        if ($json) {
            $data = [
                'imagen' => $json->imagen ?? null,
                'nombre' => $json->nombre,
                'apellidos' => $json->apellidos,
                'email' => $json->email,
                'password' => $json->password,
                'telefono' => $json->telefono,
                'reset_token' => $json->reset_token ?? null,
                'reset_token_expiration' => $json->reset_token_expiration ?? null,
                'status' => $json->status
            ];
        }

        $this->model->update($id, $data);
        $response = [
            'message' => 'Usuario actualizado exitosamente',
            'user'    => $user,
            'status'  => 200
        ];
        return $this->response->setJSON($response);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            $data = [
                'message' => 'No se encontraron usuarios',
                'status'  => 404
            ];
            return $this->response->setJSON($data, 404);
        }

        $this->model->delete($id);
        return $this->response->setJSON([
            'message' => 'Usuario eliminado exitosamente',
            'status'  => 200
        ], 200);
    }
}
