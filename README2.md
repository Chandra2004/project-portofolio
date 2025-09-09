Oke, saya paham. Jadi kamu ingin di **halaman users (list data)** ada tabel yang mendukung langsung:

✅ **C**reate
✅ **R**ead (list / detail)
✅ **U**pdate
✅ **D**elete
✅ **S**earch
✅ **P**agination
✅ **F**ilter
✅ **L**imit

atau istilahmu → **CRUDSPFL** ✨

---

## 📌 1. Model → `UserModel.php`

```php
<?php
namespace TheFramework\Models;

use TheFramework\App\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'uid';

    public function createUser(array $data) {
        return $this->insert($data);
    }

    public function getUserByUid(string $uid) {
        return $this->find($uid);
    }

    public function updateUser(array $data, string $uid) {
        return $this->update($data, $uid);
    }

    public function deleteUser(string $uid) {
        return $this->delete($uid);
    }

    // 🔎 Search by name/email
    public function searchUsers(string $keyword, int $perPage = 10, int $page = 1) {
        return $this->query()
                    ->search(['name', 'email'], $keyword)
                    ->paginate($perPage, $page);
    }

    // 🔽 Filter by active status
    public function filterUsers(int $isActive = 1, int $perPage = 10, int $page = 1) {
        return $this->query()
                    ->filter('is_active', $isActive)
                    ->paginate($perPage, $page);
    }

    // 📃 Pagination default
    public function paginateUsers(int $perPage = 10, int $page = 1) {
        return $this->paginate($perPage, $page);
    }

    // ⏳ Limit
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

    public function index() {
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 10;
        $keyword = $_GET['search'] ?? null;
        $status = $_GET['status'] ?? null;

        // 🔀 kombinasi search + filter + pagination
        if ($keyword) {
            $users = $this->userModel->searchUsers($keyword, $limit, $page);
        } elseif (!is_null($status)) {
            $users = $this->userModel->filterUsers((int)$status, $limit, $page);
        } else {
            $users = $this->userModel->paginateUsers($limit, $page);
        }

        return Helper::view('users/index', compact('users', 'keyword', 'status', 'limit'));
    }

    public function store() {
        if (Helper::is_post() && Helper::is_csrf()) {
            $data = [
                'uid' => Helper::uuid(20),
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'is_active' => 1
            ];
            $this->userModel->createUser($data);
            return Helper::redirect('/users', 'success', 'User created', 3);
        }
    }

    public function update($uid) {
        if (Helper::is_post() && Helper::is_csrf()) {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email']
            ];
            $this->userModel->updateUser($data, $uid);
            return Helper::redirect('/users', 'success', 'User updated', 3);
        }
    }

    public function destroy($uid) {
        $this->userModel->deleteUser($uid);
        return Helper::redirect('/users', 'success', 'User deleted', 3);
    }
}
```

---

## 📌 3. View → `users/index.php` (contoh tabel dengan fitur CRUDSPFL)

```php
<h1>Users</h1>

<form method="get" action="/users">
    <input type="text" name="search" placeholder="Search..." value="<?= $keyword ?? '' ?>">
    <select name="status">
        <option value="">-- All --</option>
        <option value="1" <?= ($status == '1') ? 'selected' : '' ?>>Active</option>
        <option value="0" <?= ($status == '0') ? 'selected' : '' ?>>Inactive</option>
    </select>
    <select name="limit">
        <option value="5" <?= ($limit == 5) ? 'selected' : '' ?>>5</option>
        <option value="10" <?= ($limit == 10) ? 'selected' : '' ?>>10</option>
        <option value="25" <?= ($limit == 25) ? 'selected' : '' ?>>25</option>
    </select>
    <button type="submit">Apply</button>
</form>

<table border="1" width="100%">
    <tr>
        <th>UID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users['data'] as $user): ?>
        <tr>
            <td><?= $user['uid'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['is_active'] ? 'Active' : 'Inactive' ?></td>
            <td>
                <a href="/users/show/<?= $user['uid'] ?>">View</a> |
                <a href="/users/edit/<?= $user['uid'] ?>">Edit</a> |
                <a href="/users/delete/<?= $user['uid'] ?>" onclick="return confirm('Delete?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div>
    Page <?= $users['current_page'] ?> of <?= $users['last_page'] ?>
    <?php if ($users['current_page'] > 1): ?>
        <a href="?page=<?= $users['current_page'] - 1 ?>">Prev</a>
    <?php endif; ?>
    <?php if ($users['current_page'] < $users['last_page']): ?>
        <a href="?page=<?= $users['current_page'] + 1 ?>">Next</a>
    <?php endif; ?>
</div>
```

---

## 📌 4. Routing

```php
Router::add('GET', '/users', UserController::class, 'index');
Router::add('POST', '/users/store', UserController::class, 'store');
Router::add('POST', '/users/update/([0-9a-zA-Z-]+)', UserController::class, 'update');
Router::add('GET', '/users/delete/([0-9a-zA-Z-]+)', UserController::class, 'destroy');
```

---

👉 Jadi di **halaman users**:

* CRUD dilakukan lewat form/modal di tabel.
* Search pakai `?search=keyword`.
* Filter pakai `?status=1` (active).
* Pagination pakai `?page=2`.
* Limit pakai `?limit=25`.
* Semua bisa digabung: `/users?search=john&status=1&limit=5&page=2`

---

Mau saya bikinkan **versi AJAX (tanpa reload halaman)** untuk tabel ini biar terasa modern seperti DataTables?



=======================================================================================================


Oke 👍 kita ubah query mentah itu jadi **ORM chaining** dengan `QueryBuilder` kamu.
Aku pakai **Model** supaya rapi, tapi query langsung pakai `query()` dari model.

---

## 📌 Model contoh

`app/Models/UserModel.php`

```php
<?php
namespace App\Models;

use TheFramework\App\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
}
```

`app/Models/RoleModel.php`

```php
<?php
namespace App\Models;

use TheFramework\App\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
}
```

`app/Models/CourseModel.php`

```php
<?php
namespace App\Models;

use TheFramework\App\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
}
```

`app/Models/UserCourseModel.php`

```php
<?php
namespace App\Models;

use TheFramework\App\Model;

class UserCourseModel extends Model
{
    protected $table = 'usercourse';
    protected $primaryKey = 'id';
}
```

---

## 📌 Query ORM

### 1️⃣ Users + Roles

```php
$users = (new \App\Models\UserModel())
    ->query()
    ->select([
        'u.id AS user_id',
        'u.uid AS user_uid',
        'u.email',
        'r.name AS role_name',
        'r.description AS role_desc'
    ])
    ->table('users u')
    ->join('roles r', 'u.role_uid', '=', 'r.uid')
    ->get();
```

---

### 2️⃣ Users + Courses via UserCourse

```php
$userCourses = (new \App\Models\UserCourseModel())
    ->query()
    ->select([
        'u.id AS user_id',
        'u.email',
        'c.name_course',
        'c.deadline_course',
        'c.kuota_course'
    ])
    ->table('usercourse uc')
    ->join('users u', 'uc.user_uid', '=', 'u.uid')
    ->join('courses c', 'uc.course_uid', '=', 'c.uid')
    ->get();
```

---

### 3️⃣ Courses + Users + Roles

```php
$courses = (new \App\Models\UserCourseModel())
    ->query()
    ->select([
        'c.id AS course_id',
        'c.name_course',
        'u.email AS user_email',
        'r.name AS user_role'
    ])
    ->table('usercourse uc')
    ->join('courses c', 'uc.course_uid', '=', 'c.uid')
    ->join('users u', 'uc.user_uid', '=', 'u.uid')
    ->join('roles r', 'u.role_uid', '=', 'r.uid')
    ->orderBy('c.name_course', 'ASC')
    ->get();
```

---

## 📌 Pemakaian di Controller

```php
$controller = new \App\Controllers\DemoController();

// Users + Roles
print_r($controller->usersWithRoles());

// Users + Courses
print_r($controller->usersWithCourses());

// Courses + Users + Roles
print_r($controller->coursesWithUsersAndRoles());
```

---

## 📌 DemoController

```php
<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserCourseModel;

class DemoController
{
    public function usersWithRoles()
    {
        return (new UserModel())
            ->query()
            ->select([
                'u.id AS user_id',
                'u.uid AS user_uid',
                'u.email',
                'r.name AS role_name',
                'r.description AS role_desc'
            ])
            ->table('users u')
            ->join('roles r', 'u.role_uid', '=', 'r.uid')
            ->get();
    }

    public function usersWithCourses()
    {
        return (new UserCourseModel())
            ->query()
            ->select([
                'u.id AS user_id',
                'u.email',
                'c.name_course',
                'c.deadline_course',
                'c.kuota_course'
            ])
            ->table('usercourse uc')
            ->join('users u', 'uc.user_uid', '=', 'u.uid')
            ->join('courses c', 'uc.course_uid', '=', 'c.uid')
            ->get();
    }

    public function coursesWithUsersAndRoles()
    {
        return (new UserCourseModel())
            ->query()
            ->select([
                'c.id AS course_id',
                'c.name_course',
                'u.email AS user_email',
                'r.name AS user_role'
            ])
            ->table('usercourse uc')
            ->join('courses c', 'uc.course_uid', '=', 'c.uid')
            ->join('users u', 'uc.user_uid', '=', 'u.uid')
            ->join('roles r', 'u.role_uid', '=', 'r.uid')
            ->orderBy('c.name_course', 'ASC')
            ->get();
    }
}
```

---

⚡ Jadi semua query mentah sudah bisa kamu tulis **ORM chaining-style** dengan `->query()->join()->get()`.

Mau aku bikinkan **helper relationship (hasMany, belongsTo, belongsToMany)** di ORM kamu, supaya query di atas jadi lebih mirip **Eloquent** (cukup `$user->role` atau `$course->users`)?
