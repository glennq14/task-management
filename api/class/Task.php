<?php
namespace App\Class;

use App\Class\Db;

class Task
{
    protected $db;
    protected $model = 'tasks';
    protected $level = [
        1 => 'Critical',
        2 => 'Major',
        3 => 'Minor'
    ];

    protected $status = [
        'todo' => 'Todo',
        'inprogress' => 'In Progress',
        'done' => 'Done'
    ];
    
    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * Start the task request
     */
    public function start()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $id  = null;
        if ( isset($uri[3]) && is_numeric($uri[3]) ) {
            $id = (int) $uri[3];
        }

        switch ( $requestMethod ) {
            case 'GET':
                if ( $id ) {
                    $data = $this->db->select($this->model, $id);
                } else {
                    $order = ['level' => 'ASC', 'name' => 'ASC'];
                    $data = $this->db->select($this->model, 0, [], $order);
                }

                $response = [
                    'status' => 'success',
                    'data' => $data
                ];
                header_json_encode($response);
                break;
            case 'POST':
                if ( $this->db->insert($this->model, $_POST) ) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Task has been successfully saved.'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Task is not saved.'
                    ];
                }
                header_json_encode($response);
                break;
            case 'PUT':
                if ( $id ) {
                    $data = get_put_form_data();
                    if ( $this->db->update($this->model, $id, $data) ) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Task has been successfully updated.'
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'message' => 'Task can\'t be updated.'
                        ];
                    }
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Task cannot be update without id.'
                    ];
                }
                
                header_json_encode($response);
                break;
            case 'DELETE':
                if ( $id ) {
                    if ( $this->db->delete($this->model, $id) ) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Task has been successfully deleted.'
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'message' => 'Task can\'t be deleted.'
                        ];
                    }
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Task cannot be deleted without id.'
                    ];
                }
                header_json_encode($response);
                break;
        }
    }
}