<?php
    class Users extends Controller {

        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function register() {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'username' => '',
                'password' => '',
                'confirmPassword' => '',
                'usernameError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
            ];
    
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                $data = [
                    'first_name' => trim($_POST['first_name']),
                    'last_name' => trim($_POST['last_name']),
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'confirmPassword' => trim($_POST['confirmPassword']),
                    'usernameError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => '',
                ];
    
                $nameValidation = "/^[a-zA-Z0-9]*$/";
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
    
                //Validate username on letters/numbers
                if(empty($data['username'])) {
                    $data['usernameError'] = 'Please enter username.';
                }else if(!preg_match($nameValidation, $data['username'])) {
                    $data['usernameError'] = 'Name can only contain letters and numbers.';
                }
    
                // Validate password on length, numeric values,
                if(empty($data['password'])){
                  $data['passwordError'] = 'Please enter password.';
                }
    
                //Validate confirm password
                if(empty($data['confirmPassword'])) {
                    $data['confirmPasswordError'] = 'Please enter password.';
                }else if($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
    
                // Make sure that errors are empty
                if(empty($data['usernameError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                    // Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    //Register user from model function
                    if($this->userModel->register($data)) {
                        //Redirect to the login page
                        header('location: ' . URLROOT . '/users/login');
                    }else {
                        die('Something went wrong.');
                    }
                }
            }
            $this->view('users/register', $data);
        }

        public function login() {
            $data = [
                'title' => 'Login page',
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
    
            //Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'usernameError' => '',
                    'passwordError' => '',
                ];
                //Validate username
                if(empty($data['username'])) {
                    $data['usernameError'] = 'Please enter a username.';
                }
    
                //Validate password
                if(empty($data['password'])) {
                    $data['passwordError'] = 'Please enter a password.';
                }
    
                //Check if all errors are empty
                if(empty($data['usernameError']) && empty($data['passwordError'])) {
                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);
    
                    if($loggedInUser) {
                        $this->createUserSession($loggedInUser);
                    }else {
                        $data['passwordError'] = 'Password or username is incorrect. Please try again.';
                        $this->view('users/login', $data);
                    }
                }   
            }else {
                $data = [
                    'username' => '',
                    'password' => '',
                    'usernameError' => '',
                    'passwordError' => ''
                ];
            }
            $this->view('users/login', $data);
        }
    
        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['full_name'] = $user->first_name." ".$user->last_name;
            header('location:' . URLROOT . '/campaigns');
        }
    
        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            header('location:' . URLROOT . '/users/login');
        }
    }