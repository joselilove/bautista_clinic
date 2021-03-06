<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 *
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientsController extends AppController
{
    /**
     * This function limit the user accessibility
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(
            [
                'login',
                'logout',
                'register',
                'recover'
            ]
        );
    }

    public function index()
    {
        $search = $this->request->query('search');
        $this->paginate = [
            'limit' => 7,
            'order' => [
                'pat_fname' => 'asc'
            ],
            'conditions' => [
                'is_deleted' => 0,
                'OR' => [
                    'lower(CONCAT(pat_fname, " ", pat_middle_initial, " ", pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                    'lower(CONCAT(pat_fname, " ", pat_middle_initial, ". ", pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                    'lower(CONCAT(pat_fname, " ", pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                    'pat_address LIKE' => "%" . $search . "%",
                    'pat_occupation LIKE' => "%" . $search . "%",
                ]
            ],
        ];
        $patients = $this->paginate(
            $this->Patients
                ->find(
                    'finder',
                    ['name' => $search]
                )
        );
        $this->set(compact('patients', 'search'));
    }

    public function create()
    {
        $patient = $this->Patients->newEntity();
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            $patient = $this->Patients->patchEntity($patient, $formData);
            $patient->user_id = $this->getUserSession('id');
            if ($patient->hasErrors()) {
                $this->Flash->error(__('The patient could not be saved. Please, try again.'));
            }
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));
                $this->redirect(['action' => 'create']);
            }
        }
        $this->set(compact('patient'));
    }

    public function getUserSession($field)
    {
        $session = $this->Auth->user($field);
        /* return a specific field of session */
        return $session;
    }

    public function edit($id = null)
    {
        $patient = $this->Patients->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($patient->isDirty()) {
                if ($this->Patients->save($patient)) {
                    $this->Flash->success(__('The patient has been saved.'));
                    return $this->redirect(['action' => 'edit', $id]);
                }
            }
            if ($patient->hasErrors()) {
                $this->Flash->error(__('The patient could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('patient'));
    }

    public function delete()
    {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $status = ['status' => true];
        if ($this->request->is('post')) {
            $patient = $this->Patients->get($this->request->getData('id'));
            if ($patient == '') {
                $status = ['status' => 'invalid'];
            } else {
                $patient->is_deleted = 1;
                if ($this->Patients->save($patient)) {
                    $status = ['status' => true];
                } else {
                    $status = ['status' => false];
                }
            }
            /** Return boolean status and string */
            return $this->response
                ->withType("application/json")
                ->withStringBody(json_encode($status));
        }
    }

    public function showTobeShare($patientId = null)
    {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $post = $this->Patients
            ->findById($patientId)
            ->where(
                [
                    'is_deleted' => 0,
                ]
            )
            ->first();
        /** Return JSON data */
        return $this->response
            ->withType("application/json")
            ->withStringBody(json_encode($post));
    }
}
