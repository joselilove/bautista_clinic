<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Medications Controller
 *
 * @property \App\Model\Table\MedicationsTable $Medications
 *
 * @method \App\Model\Entity\Medication[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MedicationsController extends AppController
{
    /**
     * This is used to view and set appointment to the client
     *
     * @return void
     */
    public function appointment()
    {
        if (!($this->getUserSession('emp_type'))) {
            $this->loadModel('Patients');
            $search = '';
            if (isset($_GET['search_name'])) {
                $search = $_GET['search_name'];
            }
            $this->paginate = [
                'limit' => 9,
                'order' => [
                    'Patients.id' => 'desc'
                ],
                'conditions' => [
                    'Patients.is_deleted' => 0,
                    'OR' => [
                        'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_middle_initial, " ", Patients.pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                        'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_middle_initial, ". ", Patients.pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                        'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                        'Patients.pat_address LIKE' => "%" . $search . "%",
                        'Patients.pat_occupation LIKE' => "%" . $search . "%",
                    ]
                ],
            ];
            $appoint = $this->Medications->newEntity();
            if ($this->request->is('post')) {
                $appoint = $this->Medications->patchEntity($appoint, $this->request->getData());
                $appoint->user_id = $this->getUserSession('id');
                $appoint->rec_bp = $this->request->getData('bp_first') . "/" . $this->request->getData('bp_second');
                if ($this->Medications->save($appoint)) {
                    $this->loadModel('ScheduleSequence');
                    $sequence = $this->ScheduleSequence->newEntity();
                    $ordered = [
                        'medication_id' => $appoint->id,
                        'patient_id' => $appoint->patient_id
                    ];
                    $this->Flash->success(__('Success! Patient Reserved'));
                    return $this->redirect(['action' => 'appointment']);
                }
                $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
            }
            $patients = $this->paginate($this->Patients);
        } else {
            $this->Flash->error(__('You are not authorized to access that location!'));
            return $this->redirect(['action' => 'reviewCurrentPatient']);
        }
        $this->set(compact('patients', 'search', 'appoint'));
    }

    /**
     * Identify if it is a schedule page
     *
     * @return void
     */
    public function schedule()
    {
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            $medication = $this->Medications
                ->findById($formData['id'])
                ->first();
            $scheduleSequence = $this->Medications
                ->patchEntity($medication, ['rec_date' => $formData['rec_date']]);
            if ($scheduleSequence->hasErrors()) {
                $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
            } else {
                $this->Medications->save($scheduleSequence);
                $this->Flash->success(__('Patient Schedule updated successfully!'));
                $this->redirect(['action' => 'schedule']);
            }
        }
        $schedulePage = true;
        $this->set(compact('schedulePage'));
    }

    /**
     * Skip the patient schedule
     *
     * @return void
     */
    public function skip()
    {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $formData = $this->request->getData();
        $backward = $formData['backward'];
        $forward = $formData['forward'];
        $user1 = $this->Medications
            ->findById($backward)
            ->first();
        $user2 = $this->Medications
            ->findById($forward)
            ->first();
        $patient_2 = $user2->rec_date;
        $patient_1 = $user1->rec_date;
        $scheduleSequence = $this->Medications
            ->patchEntity($user1, ['rec_date' => date("Y-m-d h:i:s", strtotime($patient_2))]);
        $this->Medications->save($scheduleSequence);

        $scheduleSequence = $this->Medications
            ->patchEntity($user2, ['rec_date' => date("Y-m-d h:i:s", strtotime($patient_1))]);

        $this->Medications->save($scheduleSequence);

        return $this->response
            ->withType("application/json")
            ->withStringBody(json_encode($scheduleSequence));
    }

    /**
     * Shortcut about sequence of schedule of the patient
     *
     * @return void
     */
    public function currentPatient()
    {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $query = $this->Medications->find('all');
        $currentPatient = $query
            ->contain(['Patients'])
            ->where(
                [
                    'Medications.is_deleted' => 0,
                    'Medications.rec_status' => 'ongoing',
                ]
            )
            ->order(['Medications.rec_date' => 'ASC'])
            ->limit(4)
            ->all();
        return $this->response
            ->withType("application/json")
            ->withStringBody(json_encode($currentPatient));
    }

    /**
     * This is used to get the current user information
     *
     * @param [type] $field specific information
     * @return $session
     */
    public function getUserSession($field)
    {
        $session = $this->Auth->user($field);
        /* return a specific field of session */
        return $session;
    }

    /**
     * For removing the appointment of the patient
     *
     * @return $this->response
     */
    public function delete()
    {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $status = ['status' => true];
        if ($this->request->is('post')) {
            $patient = $this->Medications->get($this->request->getData('id'));
            if ($patient == '') {
                $status = ['status' => 'invalid'];
            } else {
                $patient->is_deleted = 1;
                if ($this->Medications->save($patient)) {
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

    /**
     * For viewing and giving medical description for th patient who have appointment
     *
     * @return void
     */
    public function reviewCurrentPatient()
    {
        if ($this->getUserSession('emp_type')) {
            $search = '';
            if (isset($_GET['search_name'])) {
                $search = $_GET['search_name'];
            }
            $query = $this->Medications->find('all');
            $current = $query
                ->contain(['Patients'])
                ->where(
                    [
                        'Medications.is_deleted' => 0,
                        'Medications.rec_status' => 'ongoing',
                    ]
                )
                ->order(['Medications.rec_date' => 'ASC'])
                ->first();
            $this->paginate = [
                'contain' => ['Patients'],
                'limit' => 6,
                'order' => [
                    'Medications.rec_date' => 'ASC'
                ],
                'conditions' => [
                    'Medications.is_deleted' => 0,
                    'Medications.rec_status' => 'ongoing',
                    'OR' => [
                        'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_middle_initial, " ", Patients.pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                        'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_middle_initial, ". ", Patients.pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                        'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_lname)) LIKE' => strtolower("%" . $search . "%")
                    ]
                ],
            ];
            $medication = '';
            if ($this->request->is('post')) {
                $formData = $this->request->getData();
                $medication = $this->Medications
                    ->findById($formData['id'])
                    ->contain(['Patients'])
                    ->where(['Medications.rec_status' => 'ongoing'])
                    ->first();
                if ($medication  == '') {
                    $this->Flash->error(__('Please select patient. Thank you'));
                    return $this->redirect(['action' => 'reviewCurrentPatient']);
                }
                $medication = $this->Medications->patchEntity($medication, $formData);
                $medication->rec_status = 'done';
                if ($this->Medications->save($medication)) {
                    $this->Flash->success(__('Success'));
                    $this->redirect(['action' => 'reviewCurrentPatient']);
                } else {
                    $this->Flash->error(__('Please check the input fields. Please try again'));
                }
            }
            $patients = $this->paginate($this->Medications);
        } else {
            $this->Flash->error(__('You are not authorized to access that location!'));
            $this->redirect(['controller' => 'Patients', 'action' => 'index']);
        }
        $this->set(compact('current', 'patients', 'search', 'medication'));
    }

    /**
     * For viewing all patients with medications record
     *
     * @return void
     */
    public function medicalRecord()
    {
        $search = $this->request->query('search');
        $this->paginate = [
            'contain' => ['Patients'],
            'limit' => 7,
            'order' => [
                'Medications.modified' => 'ASC'
            ],
            'conditions' => [
                'Medications.rec_status' => 'done'
            ],
            'group' => 'patient_id'
        ];
        $patients = $this->paginate(
            $this->Medications
                ->find(
                    'finder',
                    ['name' => $search]
                )
        );
        $this->set(compact('patients', 'search'));
    }

    /**
     * Viewing all medications record of a patient
     *
     * @return void
     */
    public function patientRecord($patient_id = null)
    {
        $this->paginate = [
            'contain' => ['Patients'],
            'limit' => 10,
            'order' => [
                'Medications.modified' => 'ASC'
            ],
            'conditions' => [
                'Medications.rec_status' => 'done',
                'Medications.patient_id' => $patient_id
            ]
        ];
        $patients = $this->paginate(
            $this->Medications
        );
        $search = '';
        $patientInfo = $this->getPatient($patient_id);
        $this->set(compact('patients', 'patientInfo', 'search'));
    }

    /**
     * Get patient name
     *
     * @return void
     */
    public function getPatient($patient_id)
    {
        $this->loadModel('Patients');
        $patient = $this->Patients->findById($patient_id)->first();
        return $patient;
    }

    /**
     * This is for dashboard page or Gantt chart
     *
     * @return void
     */
    public function home()
    {
        $test = true;
        $this->set(compact('test'));
    }

    /**
     * This is for getting information for the chart
     *
     * @param string $year year
     * @return $this->response
     */
    public function getChartData($year = '2019')
    {
        $this->autoRender = false;
        $data[] = ['Month', 'Male', 'Female', 'Joined'];
        for ($month = 1; $month <= 12; $month++) {
            $char = '';
            if ($month <= 9) {
                $char = '0';
            }
            $date = $year . '-' . $char . '' . $month;
            $monthName = $this->getMonthName($month);
            $totalMale = $this->getTotalMaleRecord($date);
            $totalFemale = $this->getTotalFemaleRecord($date);
            $joined = $this->joinedRecord($totalMale, $totalFemale);
            $data[] = [$monthName, $totalMale, $totalFemale, $joined];
        }

        return $this->response
            ->withType("application/json")
            ->withStringBody(json_encode($data));
    }

    /**
     * Getting a month name
     *
     * @param [type] $monthNum int
     * @return $month
     */
    public function getMonthName($monthNum)
    {
        $month = date("F", mktime(0, 0, 0, $monthNum, 10));

        return $month;
    }

    /**
     * Getting the total male per month
     *
     * @param [type] $date date
     * @return $count
     */
    public function getTotalMaleRecord($date)
    {
        $query = $this->Medications->find('all')
            ->contain(
                [
                    'Patients'
                ]
            )
            ->where(
                ['Medications.modified LIKE' => $date . '%'],
                ['Medications.rec_status' => 'done']
            );
        $count = 0;;
        foreach ($query as $row) {
            if ($row->patient->pat_gender == 1) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Getting female total female record
     *
     * @param [type] $date date
     * @return $count
     */
    public function getTotalFemaleRecord($date)
    {
        $query = $this->Medications->find('all')
            ->contain(
                [
                    'Patients'
                ]
            )
            ->where(
                ['Medications.modified LIKE' => $date . '%'],
                ['Medications.rec_status' => 'done']
            );
        $count = 0;;
        foreach ($query as $row) {
            if ($row->patient->pat_gender == 0) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Combining male and female record
     *
     * @param [type] $totalMale male
     * @param [type] $totalFemale female
     * @return $total
     */
    public function joinedRecord($totalMale, $totalFemale)
    {
        $total = $totalMale + $totalFemale;

        return $total;
    }

    /**
     * This is for print medical certificate
     *
     * @param integer $medicationId int
     * @return void
     */
    public function print($medicationId)
    {
        $user = $this->Medications
            ->findById($medicationId)
            ->contain(['Patients'])
            ->first();
        $this->set(compact('user'));
    }

    /**
     * This is for print medical findings of the patients
     *
     * @param integer $medicationId int
     * @return void
     */
    public function printFinding($medicationId)
    {
        $user = $this->Medications
            ->findById($medicationId)
            ->contain(['Patients'])
            ->first();
        $this->set(compact('user'));
    }

    /**
     * Comparing records
     *
     * @return void
     */
    public function compareRecord()
    {
        $search = '';
        if (isset($_GET['search_name'])) {
            $search = $_GET['search_name'];
        }
        $this->paginate = [
            'limit' => 20,
            'order' => [
                'Medications.modified' => 'ASC'
            ],
            'conditions' => [
                'OR' => [
                    'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_middle_initial, " ", Patients.pat_lname)) LIKE' => strtolower("%" . $search . "%"),
                    'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_lname)) LIKE' => strtolower("%" . $search . "%")
                    // 'Patients.pat_fname LIKE' => "%" . $search . "%",
                    // 'Patients.pat_lname LIKE' => "%" . $search . "%"
                ]
            ]
        ];
        $record = $this->paginate(
            $this->Medications
                ->find()
                ->where(['Medications.rec_status' => 'done'])
                ->contain('Patients')
        );
        $this->set(compact('record', 'search'));
    }

    /**
     * Check the order sequence of medications
     *
     * @param integer $patient_id int
     * @param integer $medication_id int
     * @return void
     */
    public function identifyCheckup($patient_id = null, $medication_id = null)
    {
        $medication = $this->Medications
            ->findByPatientId($patient_id)
            ->where(['Medications.rec_status' => 'done'])
            ->all();
        $number = 0;
        foreach ($medication as $row) {
            $number++;
            if ($row['id'] == $medication_id) {
                break;
            }
        }
        $this->set(compact('number'));
    }
}
