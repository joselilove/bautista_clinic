<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

use function Psy\debug;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
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

    /**
     * Check ig the user already login
     *
     * @return true
     */
    public function checkIfAlreadyLogin()
    {
        if ($this->Auth->user()) {
            $this->redirect(['controller' => 'patients', 'action' => 'index']);
            return true;
        }
    }


    /**
     * Login the Users
     *
     * @return void
     */
    public function login()
    {
        if (!($this->checkIfAlreadyLogin())) {
            if ($this->request->is('post')) {
                $user = $this->Auth->identify();
                if ($user) {
                    if ($user['activated'] == 1) {
                        $this->Auth->setUser($user);
                        $name = $this->getUserSession('name');
                        $this->Flash->success(__('Welcome ' . $name));
                        if ($this->getUserSession('emp_type')) {
                            $this->redirect(
                                [
                                    'controller' => 'Medications',
                                    'action' => 'home'
                                ]
                            );
                        } else {
                            $this->redirect(['controller' => 'Medications', 'action' => 'home']);
                        }
                    } else {
                        $this->Flash->error('Please activate your account first.');
                        $this->redirect($this->Auth->logout());
                    }
                } else {
                    $this->Flash->error('Login credentials are incorrect!');
                }
            }
        }
    }

    /**
     * Register Users
     *
     * @return void
     */
    public function register()
    {
        $this->checkIfAlreadyLogin();
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Thank you for registering'));
                $this->redirect(['action' => 'login']);
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Recover account
     *
     * @return void
     */
    public function recover()
    {
        $this->checkIfAlreadyLogin();
        if ($this->request->is('post')) {
            $emailAddress = $this->request->getData('email');
            $user = $this->Users->findByEmail($emailAddress)->first();
            if ($user == null) {
                $this->Flash->error(__('Email not exist'));
            } else {
                $newPassword = uniqid();
                $user->password = $newPassword;
                $this->Users->save($user);
                try {
                    $email = new Email('default');
                    $email->transport('mail');
                    $email
                        ->emailFormat('html')
                        ->from(['joselin.portfolio.system@gmail.com' => 'Baustista Clinic'])
                        ->to($emailAddress)
                        ->subject('New password')
                        ->send('Your new password is <b>' . $newPassword . '</b>');
                    $this->Flash->success(__('Your new password has been sent into your email'));
                    $this->redirect(['action' => 'login']);
                } catch (\Throwable $th) {
                    die('Email not sent');
                }
            }
        }
    }

    /**
     * Logout the Users
     *
     * @return void
     */
    public function logout()
    {
        $this->Flash->success('Thank you, Come visit us again.');
        $this->redirect($this->Auth->logout());
    }

    /**
     * Get user session
     *
     * @param [type] $field -> user table field
     * @return $session
     */
    public function getUserSession($field)
    {
        $session = $this->Auth->user($field);
        /* return a specific field of session */
        return $session;
    }

    /**
     * Change password
     *
     * @return void
     */
    public function changePassword()
    {
        $password = $this->Users->newEntity();
        $userSession = $this->getUserSession('id');
        if ($this->request->is('post')) {
            $dataSend = $this->request->getData();
            $user = $this->Users
                ->findById($userSession)
                ->first();
            $formData = [
                'current_password' => $dataSend['current_password'],
                'id' => $userSession,
                'password' => $dataSend['password'],
                'confirm_password' => $dataSend['confirm_password']
            ];
            $password = $this->Users->patchEntity($password, $formData);
            if (!($password->hasErrors())) {
                $user->password = $dataSend['password'];
                if ($this->Users->save($user)) {
                    $this->Auth->setUser($user);
                    $this->Flash->success(__('Your account password has been updated successfully!'));
                    $this->redirect(['action' => 'changePassword']);
                } else {
                    $this->Flash->error(__('Please check the errors of the inputted fields!'));
                }
            } else {
                $this->Flash->error(__('Please check the errors of the inputted fields!'));
            }
        }
        $this->set(compact('password'));
    }

    /**
     * Update user account
     *
     * @return void
     */
    public function updateUserInfo()
    {
        $userSession = $this->getUserSession('id');
        $userUsed = $this->Users->get($userSession);
        $imgNameWillBeUse = uniqid();
        $formData = $this->request->getData();
        if ($this->request->is('post')) {
            $userUsed = $this->Users->patchEntity($userUsed, $formData);
            if ($userUsed->isDirty()) {
                if ($this->Users->save($userUsed)) {
                    $this->Auth->setUser($userUsed);
                    $this->Flash->success(__('Your account has been updated successfully!'));
                }
            }
            if ($userUsed->hasErrors()) {
                $this->Flash->error(__('Please check the inputted fields!'));
            }
        }
        $this->set(compact('userUsed'));
    }

    /**
     * This will show all users
     *
     * @return void
     */
    public function activate()
    {
        $search = $this->request->query('search');
        $this->paginate = [
            'limit' => 10,
            'conditions' => [
                'Users.id !=' => $this->getUserSession('id')
            ]
        ];
        $users = $this->paginate(
            $this->Users->find(
                'finder',
                ['name' => $search]
            )
        );
        $this->set(compact('users', 'search'));
    }

    /**
     * Activate the account
     *
     * @param [type] $user_id
     * @return void
     */
    public function activateAccount($user_id = null)
    {
        $user = $this->Users
            ->findById($user_id)
            ->where(['id !=' => $this->getUserSession('id')])
            ->first();
        if ($user != null) {
            $user->activated = 1;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The account has been activated successfully!'));
                return $this->redirect(['action' => 'activate']);
            }
        } else {
            $this->Flash->error(__('Please try again!'));
            return $this->redirect(['action' => 'activate']);
        }
    }

    /**
     * Deactivate the account
     *
     * @param [type] $user_id
     * @return void
     */
    public function deactivateAccount($user_id = null)
    {
        $user = $this->Users
            ->findById($user_id)
            ->where(['id !=' => $this->getUserSession('id')])
            ->first();
        if ($user != null) {
            $user->activated = 0;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The account has been deactivated successfully!'));
                return $this->redirect(['action' => 'activate']);
            }
        } else {
            $this->Flash->error(__('Please try again!'));
            return $this->redirect(['action' => 'activate']);
        }
    }
}
