<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Medications Model
 *
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Medication get($primaryKey, $options = [])
 * @method \App\Model\Entity\Medication newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Medication[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Medication|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medication saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Medication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Medication[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Medication findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MedicationsTable extends Table
{
    /**
     * Custom finder
     *
     * @param Query $query
     * @param array $options
     * @return void
     */
    public function findFinder(Query $query, array $options)
    {
        $query->where(
            [
                'OR' => [
                    'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_middle_initial, " ", Patients.pat_lname)) LIKE'=> strtolower("%" . $options['name'] . "%"),
                    'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_middle_initial, ". ", Patients.pat_lname)) LIKE'=> strtolower("%" . $options['name'] . "%"),
                    'lower(CONCAT(Patients.pat_fname, " ", Patients.pat_lname)) LIKE'=> strtolower("%" . $options['name'] . "%"),
                    'lower(Patients.pat_address) LIKE' => strtolower("%" . $options['name'] . "%"),
                    'lower(Patients.pat_occupation) LIKE' => strtolower("%" . $options['name'] . "%"),
                    'lower(Patients.pat_contact) LIKE' => strtolower("%" . $options['name'] . "%"),
                    'lower(Patients.pat_age) LIKE' => strtolower("%" . $options['name'] . "%")
                ]
            ]
        );
        return $query;
    }
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('medications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo(
            'Patients',
            [
                'foreignKey' => 'patient_id',
            ]
        );
        $this->belongsTo(
            'Users',
            [
                'foreignKey' => 'user_id',
            ]
        );
        // $this->belongsTo(
        //     'ScheduleSequence',
        //     [
        //         'Medications.id ' => 'ScheduleSequence.medication_id',
        //         'joinType' => 'INNER'
        //     ]
        // );
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('rec_medication')
            ->maxLength('rec_medication', 255)
            ->allowEmptyString('rec_medication');

        $validator
            ->scalar('rec_diagnosis')
            ->maxLength('rec_diagnosis', 255)
            ->allowEmptyString('rec_diagnosis');

        $validator
            ->scalar('rec_bp')
            ->maxLength('rec_bp', 200)
            ->notEmptyString('rec_bp')
            ->add(
                'bp_first',
                [
                    'verifyFirstMin' => [
                        'rule' => function ($value) {
                            $return = false;
                            if ($value != '') {
                                if ($value >= 70) {
                                    $return = true;
                                } else {
                                    $return = false;
                                }
                            }
                            /** Rutrun boolean */
                            return $return;
                        },
                        'message' => 'Must be greater than 70'
                    ],
                    'verifyFirstMax' => [
                        'rule' => function ($value) {
                            $return = false;
                            if ($value != '') {
                                if ($value <= 190) {
                                    $return = true;
                                } else {
                                    $return = false;
                                }
                            }
                            /** Rutrun boolean */
                            return $return;
                        },
                        'message' => 'Must be less than 190'
                    ]
                ]
            )
            ->add(
                'bp_second',
                [
                    'verifySecondMin' => [
                        'rule' => function ($value) {
                            $return = false;
                            if ($value != '') {
                                if ($value >= 40) {
                                    $return = true;
                                } else {
                                    $return = false;
                                }
                            }
                            /** Rutrun boolean */
                            return $return;
                        },
                        'message' => 'Must be greater than 40'
                    ],
                    'verifySecondMax' => [
                        'rule' => function ($value) {
                            $return = false;
                            if ($value != '') {
                                if ($value <= 100) {
                                    $return = true;
                                } else {
                                    $return = false;
                                }
                            }
                            /** Rutrun boolean */
                            return $return;
                        },
                        'message' => 'Must be less than 100'
                    ]
                ]
            );
        // ^\d{1,3}\/\d{1,3}$

        $validator
            ->scalar('rec_cr')
            ->maxLength('rec_cr', 200)
            ->notEmptyString('rec_cr')
            ->nonNegativeInteger('rec_cr', 'Only Positive numbers are allowed');

        $validator
            ->scalar('rec_wt')
            ->maxLength('rec_wt', 200)
            ->notEmptyString('rec_wt')
            ->nonNegativeInteger('rec_wt', 'Only Positive numbers kg are allowed');

        $validator
            ->scalar('rec_status')
            ->maxLength('rec_status', 200)
            ->allowEmptyString('rec_status');

        $validator
            ->scalar('rec_date')
            ->notEmptyDateTime('rec_date', 'Please insert a date before submitting');

        $validator
            ->scalar('rec_complains')
            ->maxLength('rec_complains', 255)
            ->allowEmptyString('rec_complains');

        $validator
            ->scalar('rec_rr')
            ->maxLength('rec_rr', 200)
            ->notEmptyString('rec_rr')
            ->nonNegativeInteger('rec_rr', 'Only Positive numbers are allowed');

        $validator
            ->integer('rec_qn')
            ->allowEmptyString('rec_qn');

        $validator
            ->integer('is_deleted')
            ->notEmptyString('is_deleted');

        $validator
            ->integer('patient_id')
            ->notEmptyString('patient_id');

        $validator
            ->integer('id')
            ->notEmptyString('id');

        $validator
            ->scalar('full_name')
            ->notEmptyString('full_name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['patient_id'], 'Patients'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
