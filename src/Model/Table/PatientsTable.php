<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patients Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Patient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Patient newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Patient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Patient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Patient findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PatientsTable extends Table
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
                    'lower(CONCAT(pat_fname, " ", pat_middle_initial, " ", pat_lname)) LIKE'=> strtolower("%" . $options['name'] . "%"),
                    'lower(CONCAT(pat_fname, " ", pat_middle_initial, ". ", pat_lname)) LIKE'=> strtolower("%" . $options['name'] . "%"),
                    'lower(CONCAT(pat_fname, " ", pat_lname)) LIKE'=> strtolower("%" . $options['name'] . "%"),
                    'lower(pat_address) LIKE' => strtolower("%" . $options['name'] . "%"),
                    'lower(pat_occupation) LIKE' => strtolower("%" . $options['name'] . "%"),
                    'lower(pat_contact) LIKE' => strtolower("%" . $options['name'] . "%"),
                    'lower(pat_age) LIKE' => strtolower("%" . $options['name'] . "%")
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

        $this->setTable('patients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany(
            'Medications',
            [
                'id' => 'patient_id'
            ]
        );
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
            ->scalar('pat_middle_initial')
            ->maxLength('pat_middle_initial', 1)
            ->notEmptyString('pat_middle_initial')
            ->add(
                'pat_middle_initial',
                [
                    'minLength' => [
                        'rule' => ['minLength', 1],
                        'last' => true,
                        'message' => 'Middle Initial 1 character only'
                    ],
                    'validChar' => [
                        'rule' => ['custom', "/^[A-Z.]*$/i"],
                        'message' => "Capital alphabetical characters ,and dot only",
                    ],
                    'oneCap' => [
                        'rule' => function ($value) {
                            $uppercase = 0;
                            $password = $value;
                            preg_match_all("/[A-Z]/", $password, $caps_match);
                            $caps_count = count($caps_match[0]);
                            /** Rutrun boolean */
                            return ($uppercase < $caps_count);
                        },
                        'message' => 'Middle Initial must a Capital Letter[ex: T.]'
                    ],
                ]
            );

        $validator
            ->integer('pat_age')
            ->notEmptyString('pat_age')
            ->add(
                'pat_age',
                [
                    'verifyAge' => [
                        'rule' => function ($value) {
                            $return = false;
                            if ($value != '') {
                                if ($value > 0 && $value < 120) {
                                    $return = true;
                                } else {
                                    $return = false;
                                }
                            }
                            /** Rutrun boolean */
                            return $return;
                        },
                        'message' => 'Age must be greater than 0 and less than 120'
                    ]
                ]
            );
        $validator
            ->scalar('pat_address')
            ->maxLength('pat_address', 100)
            ->notEmptyString('pat_address')
            ->add(
                'pat_address',
                [
                    'minLength' => [
                        'rule' => ['minLength', 8],
                        'last' => true,
                        'message' => 'Address need to be at least 8 characters long'
                    ],
                    'validAddress' => [
                        'rule' => ['custom', '/^[a-z0-9 .]*$/i'],
                        'message' => 'Alphanumeric characters with spaces and dot only',
                    ],
                    'notBlank' => [
                        'rule' => 'notBlank',
                        'message' => 'Address can not be empty',
                        'last' => true
                    ],
                ]
            );

        $validator
            ->scalar('pat_gender')
            ->maxLength('pat_gender', 1)
            ->notEmptyString('pat_gender');

        $validator
            ->scalar('pat_occupation')
            ->maxLength('pat_occupation', 30)
            ->notEmptyString('pat_occupation')
            ->add(
                'pat_occupation',
                [
                    'minLength' => [
                        'rule' => ['minLength', 6],
                        'last' => true,
                        'message' => 'Occupation need to be at least 6 characters long'
                    ],
                    'validChar' => [
                        'rule' => ['custom', "/^[a-zA-Z .'-]*$/i"],
                        'message' => "Alphabetical characters, spaces, colons,dashes,and dot are allowed",
                    ]
                ]
            );

        $validator
            ->scalar('pat_contact')
            ->maxLength('pat_contact', 11, 'Invalid phone number [ex; 09352609206]')
            ->notEmptyString('pat_contact')
            ->add(
                'pat_contact',
                [
                    'minLength' => [
                        'rule' => ['minLength', 11],
                        'last' => true,
                        'message' => 'Invalid phone number [ex; 09352609206]'
                    ],
                    'number' => [
                        'rule' => 'numeric',
                        'message' => "Number only",
                    ]
                ]
            );


        // $validator
        //     ->date('pat_birthdate')
        //     ->notEmptyDate('pat_birthdate');

        $validator
            ->scalar('pat_fname')
            ->maxLength('pat_fname', 100)
            ->notEmptyString('pat_fname')
            ->add(
                'pat_fname',
                [
                    'minLength' => [
                        'rule' => ['minLength', 2],
                        'last' => true,
                        'message' => 'Firstname need to be at least 2 characters long'
                    ],
                    'validChar' => [
                        'rule' => ['custom', "/^[a-zA-Z .'-]*$/i"],
                        'message' => "Alphabetical characters, spaces, colons,dashes,and dot are allowed",
                    ]
                ]
            );

        $validator
            ->scalar('pat_lname')
            ->maxLength('pat_lname', 100)
            ->notEmptyString('pat_lname')
            ->add(
                'pat_lname',
                [
                    'minLength' => [
                        'rule' => ['minLength', 2],
                        'last' => true,
                        'message' => 'Lastname need to be at least 2 characters long'
                    ],
                    'validChar' => [
                        'rule' => ['custom', "/^[a-zA-Z .'-]*$/i"],
                        'message' => "Alphabetical characters, spaces, colons,dashes,and dot are allowed",
                    ]
                ]
            );

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id', null, 'create');
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
