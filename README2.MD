Oke 👍, kita buatkan **contoh full pengaplikasian ORM di TheFramework** mulai dari **Model** sampai **Controller**, mencakup semua fitur:

* **Create**
* **Read**
* **Update**
* **Delete**
* **Search**
* **Filter**
* **Pagination**
* **Limit**

---

## 📌 1. Model → `UserModel.php`

```php
<?php
namespace TheFramework\Models;

use TheFramework\App\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'uid';

    /**
     * Create user baru
     */
    public function createUser(array $data) {
        return $this->insert($data);
    }

    /**
     * Ambil semua user
     */
    public function getAllUsers() {
        return $this->all();
    }

    /**
     * Ambil user berdasarkan UID
     */
    public function getUserByUid(string $uid) {
        return $this->find($uid);
    }

    /**
     * Update user berdasarkan UID
     */
    public function updateUser(array $data, string $uid) {
        return $this->update($data, $uid);
    }

    /**
     * Hapus user
     */
    public function deleteUser(string $uid) {
        return $this->delete($uid);
    }

    /**
     * Search user by name or email
     */
    public function searchUsers(string $keyword) {
        return $this->query()
                    ->search(['name','email'], $keyword)
                    ->get();
    }

    /**
     * Filter user is_active = 1
     */
    public function activeUsers() {
        return $this->query()
                    ->filter('is_active', 1)
                    ->get();
    }

    /**
     * Pagination contoh
     */
    public function paginateUsers(int $perPage = 10, int $page = 1) {
        return $this->paginate($perPage, $page);
    }

    /**
     * Limit contoh
     */
    public function limitedUsers(int $limit, int $offset = 0) {
        return $this->query()
                    ->limit($limit, $offset)
                    ->get();
    }
}
```

---

## 📌 2. Controller → `UserController.php`

```php
<?php
namespace TheFramework\Http\Controllers;

use TheFramework\Models\UserModel;
use TheFramework\Helpers\Helper;

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * CREATE
     */
    public function store() {
        if (Helper::is_post() && Helper::is_csrf()) {
            $data = [
                'uid' => Helper::uuid(20),
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'is_active' => 1,
            ];
            $this->userModel->createUser($data);
            return Helper::redirect('/users', 'success', 'User created', 3);
        }
    }

    /**
     * READ - all
     */
    public function index() {
        $users = $this->userModel->getAllUsers();
        return Helper::view('users/index', compact('users'));
    }

    /**
     * READ - detail
     */
    public function show($uid) {
        $user = $this->userModel->getUserByUid($uid);
        return Helper::view('users/show', compact('user'));
    }

    /**
     * UPDATE
     */
    public function update($uid) {
        if (Helper::is_post() && Helper::is_csrf()) {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
            ];
            $this->userModel->updateUser($data, $uid);
            return Helper::redirect("/users/show/{$uid}", 'success', 'User updated', 3);
        }
    }

    /**
     * DELETE
     */
    public function destroy($uid) {
        $this->userModel->deleteUser($uid);
        return Helper::redirect('/users', 'success', 'User deleted', 3);
    }

    /**
     * SEARCH
     */
    public function search() {
        $keyword = $_GET['q'] ?? '';
        $users = $this->userModel->searchUsers($keyword);
        return Helper::view('users/search', compact('users','keyword'));
    }

    /**
     * FILTER
     */
    public function active() {
        $users = $this->userModel->activeUsers();
        return Helper::view('users/active', compact('users'));
    }

    /**
     * PAGINATION
     */
    public function paginate() {
        $page = $_GET['page'] ?? 1;
        $users = $this->userModel->paginateUsers(10, (int)$page);
        return Helper::view('users/paginate', compact('users'));
    }

    /**
     * LIMIT
     */
    public function limit() {
        $users = $this->userModel->limitedUsers(5, 0);
        return Helper::view('users/limit', compact('users'));
    }
}
```

---

## 📌 3. Contoh Routing

```php
Router::add('GET', '/users', UserController::class, 'index');
Router::add('GET', '/users/show/([0-9a-zA-Z-]+)', UserController::class, 'show');
Router::add('POST', '/users/store', UserController::class, 'store');
Router::add('POST', '/users/update/([0-9a-zA-Z-]+)', UserController::class, 'update');
Router::add('GET', '/users/delete/([0-9a-zA-Z-]+)', UserController::class, 'destroy');
Router::add('GET', '/users/search', UserController::class, 'search');
Router::add('GET', '/users/active', UserController::class, 'active');
Router::add('GET', '/users/paginate', UserController::class, 'paginate');
Router::add('GET', '/users/limit', UserController::class, 'limit');
```

---

✨ Jadi, dengan struktur ini, ORM kamu sudah siap dipakai untuk:

* `Create` → `store()`
* `Read` → `index()`, `show()`
* `Update` → `update()`
* `Delete` → `destroy()`
* `Search` → `search()`
* `Filter` → `active()`
* `Pagination` → `paginate()`
* `Limit` → `limit()`

---

Mau saya bikinkan **contoh view** sederhana (misalnya tabel user + pagination link) biar kamu bisa langsung testing di browser?
