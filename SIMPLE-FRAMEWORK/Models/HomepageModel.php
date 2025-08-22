<?php
    namespace Models;

    class HomepageModel {
        protected $db;

        private function UsersTable() {
            $users = [
                [
                    'id' => 1,
                    'initials' => 'JD',
                    'slug' => 'john_doe',
                    'username' => 'Jhon Doe',
                    'email' => 'john.doe@example.com',
                    'is_active' => true,
                    'roles' => ['admin', 'editor', 'viewer']
                ],
                [
                    'id' => 2,
                    'initials' => 'JS',
                    'slug' => 'jane_smith',
                    'username' => 'Jane Smith',
                    'email' => 'jane.smith@example.com',
                    'is_active' => true,
                    'roles' => ['editor']
                ],
                [
                    'id' => 3,
                    'initials' => 'PJ',
                    'slug' => 'peter_jones',
                    'username' => 'Peter Jones',
                    'email' => 'peter.jones@example.com',
                    'is_active' => false,
                    'roles' => ['viewer']
                ],
                [
                    'id' => 4,
                    'initials' => 'SW',
                    'slug' => 'susan_williams',
                    'username' => 'Susan Williams',
                    'email' => 'susan.williams@example.com',
                    'is_active' => true,
                    'roles' => ['admin']
                ],
                [
                    'id' => 5,
                    'initials' => 'MB',
                    'slug' => 'michael_brown',
                    'username' => 'Michael Brown',
                    'email' => 'michael.brown@example.com',
                    'is_active' => false,
                    'roles' => ['viewer']
                ],
                [
                    'id' => 6,
                    'initials' => 'LT',
                    'slug' => 'lisa_taylor',
                    'username' => 'Lisa Taylor',
                    'email' => 'lisa.taylor@example.com',
                    'is_active' => true,
                    'roles' => ['editor']
                ],
                [
                    'id' => 7,
                    'initials' => 'RM',
                    'slug' => 'robert_miller',
                    'username' => 'Robert Miller',
                    'email' => 'robert.miller@example.com',
                    'is_active' => true,
                    'roles' => ['viewer']
                ],
                [
                    'id' => 8,
                    'initials' => 'MD',
                    'slug' => 'mary_davis',
                    'username' => 'Mary Davis',
                    'email' => 'mary.davis@example.com',
                    'is_active' => false,
                    'roles' => ['admin']
                ],
                [
                    'id' => 9,
                    'initials' => 'DG',
                    'slug' => 'david_garcia',
                    'username' => 'David Garcia',
                    'email' => 'david.garcia@example.com',
                    'is_active' => true,
                    'roles' => ['editor']
                ],
                [
                    'id' => 10,
                    'initials' => 'ER',
                    'slug' => 'emily_rodriguez',
                    'username' => 'Emily Rodriguez',
                    'email' => 'emily.rodriguez@example.com',
                    'is_active' => true,
                    'roles' => ['viewer']
                ]
            ];
            
            return $users;
        }

        public function __construct() {
            $Users = $this->UsersTable();
            $this->db = $Users;
        }

        public function GetAllUsers() {  
            return $this->db; 
        }
    }
?>