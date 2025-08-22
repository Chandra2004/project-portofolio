<?php
    namespace Controllers;

    require_once __DIR__ . '/../Models/HomepageModel.php';

    use Models\HomepageModel;

    class HomepageController extends Controller {
        private $HomepageModel;

        public function __construct() {
            parent::__construct();
            $this->HomepageModel = new HomepageModel();
        }

        public function Index() {

            return $this->View('homepage', [
                'title' => 'Welcome Home',
                'username' => 'Chandra Tri Antomo'
            ]);
        }
        
        public function Users() {
            $getAllUsers = $this->HomepageModel->GetAllUsers();
    
            return $this->View('users', [
                'title' => 'Users Management',
                'getAllUsers' => $getAllUsers
            ]);
        }

        public function Detail($username, $id) {
            $getAllUsers = $this->HomepageModel->GetAllUsers();
            foreach($getAllUsers as $user) {
                if((strtolower($user['slug']) === strtolower($username)) && $id == $user['id']) {
                    return $this->View('detail', [
                        'user' => $user
                    ]);
                }
            }
            http_response_code(404);
        }
    }
?>