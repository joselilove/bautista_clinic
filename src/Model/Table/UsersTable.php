<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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
                    'lower(name) LIKE' => strtolower("%" . $options['name'] . "%"),
                    'lower(username) LIKE' => strtolower("%" . $options['name'] . "%"),
                    'lower(email) LIKE' => strtolower("%" . $options['name'] . "%")
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 20)
            ->notEmptyString('name')
            ->add(
                'name',
                [
                    'minLength' => [
                        'rule' => ['minLength', 4],
                        'last' => true,
                        'message' => 'Name need to be at least 8 characters long'
                    ],
                    'validChar' => [
                        'rule' => ['custom', "/^[a-zA-Z .'-]*$/i"],
                        'message' => "Alphabetical characters, spaces, colons,dashes,and dot are allowed",
                    ],
                    'notBlank' => [
                        'rule' => 'notBlank',
                        'message' => 'Name can not be empty',
                        'last' => true
                    ],
                ]
            );
        $validator
            ->scalar('username')
            ->maxLength('username', 20)
            ->notEmptyString('username', 'create')
            ->add(
                'username',
                [
                    'unique' => [
                        'rule' => 'validateUnique',
                        'provider' => 'table',
                        'message' => 'Already taken'
                    ],
                    'custom' => [
                        'rule' => ['custom', '/^[a-z0-9-_]*$/i'],
                        'message' => 'Alphabets, numbers, dash and underscore allowed'
                    ],
                    'length' => [
                        'rule' => ['minLength', 8],
                        'message' => 'Username need to be at least 8 characters long',
                    ]
                ]
            );

        $validator
            ->scalar('password')
            ->add(
                'password',
                [
                    'minLength' => [
                        'rule' => ['minLength', 8],
                        'last' => true,
                        'message' => 'Password need to be at least 8 characters long'
                    ],
                    'oneCaps' => [
                        'rule' => function ($value) {
                            $uppercase = 0;
                            $password = $value;
                            preg_match_all("/[A-Z]/", $password, $caps_match);
                            $caps_count = count($caps_match[0]);
                            /** Rutrun boolean */
                            return ($uppercase < $caps_count);
                        },
                        'message' => 'Password must have at least 1 capital letter'
                    ],
                    'oneLower' => [
                        'rule' => function ($value) {
                            $uppercase = 0;
                            $password = $value;
                            preg_match_all("/[a-z]/", $password, $caps_match);
                            $caps_count = count($caps_match[0]);
                            /** Rutrun boolean */
                            return ($uppercase < $caps_count);
                        },
                        'message' => 'Password must have at least 1 small case letter'
                    ],
                    'oneNumber' => [
                        'rule' => function ($value) {
                            $uppercase = 0;
                            $password = $value;
                            preg_match_all("/[0-9]/", $password, $caps_match);
                            $caps_count = count($caps_match[0]);
                            /** Rutrun boolean */
                            return ($uppercase < $caps_count);
                        },
                        'message' => 'Password must have at least 1 number'
                    ]
                ]
            )
            ->notEmptyString('password')
            ->add(
                'confirm_password',
                'custom',
                [
                    'rule' => function ($value, $context) {
                        $data = false;
                        if ($value == $context['data']['password']) {
                            $data = true;
                        }
                        /** Rutrun boolean */
                        return $data;
                    },
                    'message' => 'Password not match'
                ]
            );
        $validator
            ->add(
                'current_password',
                'custom',
                [
                    'rule' => function ($value, $context) {
                        $id = $context['data']['id'];
                        $user = $this->get($id);
                        if ($user) {
                            if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                                return true;
                            }
                        }
                        /** Rutrun boolean */
                        return false;
                    },
                    'message' => 'The old password does not match the current password!',
                ]
            )
            ->notEmpty('current_password');
        $validator
            ->scalar('emp_type')
            ->maxLength('emp_type', 20)
            ->notEmptyString('emp_type');
        $validator
            ->email('email')
            ->notEmptyString('email')
            ->maxLength('address', 255)
            ->add(
                'email',
                [
                    'unique' => [
                        'rule' => 'validateUnique',
                        'provider' => 'table',
                        'message' => 'Already taken'
                    ],
                    'validEmail' => [
                        'rule' => ['custom', '/^[a-z0-9.@_-]*$/i'],
                        'message' => 'Alphanumeric characters, dot, @, - and underscore are allowed',
                    ]
                ]
            );
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
