<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class Post extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    
    public function __construct()
    {
        $this->model = new \App\Models\Post();
    }
    
    public function index()
    {   
        $posts = $this->model->findAll();

        if(empty($posts)) {
            $data = [
                'message' => 'No se encontraron publicaciones',
                'status' => 404
            ];
            return $this->response->setJSON($data, 404);
        }
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
        $post = $this->model->find($id);

        if($post) {
            return $this->response->setJSON($post, 200);
        } else {
            $data = [
                'message' => 'No se encontraron publicaciones',
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
            'user_id' => $json->user_id,
            'imagen' => $json->imagen ?? null,
            'titulo' => $json->titulo,
            'contenido' => $json->contenido,
            'status' => $json->status
        ];

        if (!$this->model->insert($data)) {
            return $this->response->setJSON([
                'message' => 'No se pudo crear el post',
                'status'  => 500
            ], 500);
        }
    
        $post = $this->model->find($this->model->insertID());
    
        return $this->response->setJSON([
            'post'    => $post,
            'message' => 'Post creado exitosamente'
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
        $post = $this->model->find($id);
        if (!$post) {
            $data = [
                'message' => 'No se encontró el post',
                'status'  => 404
            ];
            return $this->response->setJSON($data, 404);
        }

        $json = $this->request->getJSON();

        if ($json) {
            $data = [
                'user_id' => $json->user_id,
                'imagen' => $json->imagen ?? null,
                'titulo' => $json->titulo,
                'contenido' => $json->contenido,
                'status' => $json->status
            ];
        }

        $this->model->update($id, $data);
        $response = [
            'message' => 'Post actualizado exitosamente',
            'post'    => $post,
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
        $post = $this->model->find($id);
        if (!$post) {
            $data = [
                'message' => 'No se encontraron usuarios',
                'status'  => 404
            ];
            return $this->response->setJSON($data, 404);
        }

        $this->model->delete($id);
        return $this->response->setJSON([
            'message' => 'Post eliminado exitosamente',
            'status'  => 200
        ], 200);
    }
}
