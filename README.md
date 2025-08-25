Berarti kita akan buat **dokumentasi CRUDSPF + Migrasi Database** yang lengkap, profesional, dan rapi. Saya satukan semua: **struktur folder, QueryBuilder, Model, Controller, cara pakai, hingga migrasi menggunakan Blueprint dan Schema.**

---

## **1. Struktur Proyek**

```
app/
├── App/
│   ├── Database.php
│   ├── QueryBuilder.php
│   ├── Model.php
│   ├── Schema.php
│   └── Blueprint.php
├── Http/
│   └── Controllers/
│       └── UserController.php
└── Models/
    └── UserModel.php

database/
└── migrations/
    └── 2025_08_14_045829_CreateUsersTable.php

vendor/
autoload.php (composer)
```

---

## **2. Migrasi Database**

### **2.1. Kelas Schema**

Tambahkan class `Schema` untuk eksekusi migrasi SQL menggunakan `Blueprint`.

`app/App/Schema.php`

```php
<?php
namespace TheFramework\App;

use TheFramework\App\Database;
use TheFramework\App\Blueprint;

class Schema {
    public static function create(string $table, callable $callback) {
        $blueprint = new Blueprint($table);
        $callback($blueprint);

        $columns = implode(",\n", $blueprint->getColumns());
        $primaryKey = $blueprint->getPrimaryKey();
        $foreignKeys = $blueprint->getForeignKeys();

        $sql = "CREATE TABLE `$table` (\n";
        $sql .= $columns;

        if ($primaryKey) {
            $sql .= ",\nPRIMARY KEY ($primaryKey)";
        }

        if (!empty($foreignKeys)) {
            $sql .= ",\n" . implode(",\n", $foreignKeys);
        }

        $sql .= "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        Database::getInstance()->exec($sql);
    }

    public static function dropIfExists(string $table) {
        $sql = "DROP TABLE IF EXISTS `$table`";
        Database::getInstance()->exec($sql);
    }
}
```

---

### **2.2. Migrasi Users Table**

`database/migrations/2025_08_14_045829_CreateUsersTable.php`

```php
<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2025_08_14_045829_CreateUsersTable {
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->id(); // INT AUTO_INCREMENT PRIMARY KEY
            $table->string('uid', 64)->unique();
            $table->string('name');
            $table->string('email')->unique()->index('email');
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
```

---

### **2.3. Migrasi Roles Table (contoh join)**

`database/migrations/2025_08_14_050000_CreateRolesTable.php`

```php
<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2025_08_14_050000_CreateRolesTable {
    public function up()
    {
        Schema::create('roles', function ($table) {
            $table->id();
            $table->string('uid',64)->unique();
            $table->string('role_name')->index('role_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
```

---

## **3. Model (CRUDSPF Ready)**

`app/Models/UserModel.php`

```php
<?php
namespace App\Models;

use TheFramework\App\Database;
use TheFramework\App\QueryBuilder;
use TheFramework\App\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'uid';

    public function query() {
        return new QueryBuilder(Database::getInstance());
    }

    // Create
    public function createUser(array $data) {
        return $this->query()->table($this->table)->insert($data);
    }

    // Read with Search, Pagination, and Join
    public function getAllUsers(?string $search = null, int $page = 1, int $perPage = 10) {
        return $this->query()
            ->table($this->table)
            ->join('roles','users.role_uid','=','roles.uid','LEFT')
            ->search(['users.name','users.email','roles.role_name'],$search)
            ->orderBy('users.created_at','DESC')
            ->paginate($perPage,$page);
    }

    // Single Read
    public function findUser(string $uid) {
        return $this->find($uid);
    }

    // Update
    public function updateUser(string $uid, array $data) {
        return $this->update($data,$uid);
    }

    // Delete
    public function deleteUser(string $uid) {
        return $this->delete($uid);
    }
}
```

---

## **4. Controller CRUDSPF**

`app/Http/Controllers/UserController.php`

```php
<?php
namespace App\Http\Controllers;

use App\Models\UserModel;

class UserController {
    private $users;

    public function __construct() {
        $this->users = new UserModel();
    }

    // Create
    public function store(array $data) {
        return $this->users->createUser($data);
    }

    // Read (All + Search + Pagination)
    public function index(?string $search = null, int $page = 1, int $perPage = 10) {
        return $this->users->getAllUsers($search,$page,$perPage);
    }

    // Read Single
    public function show(string $uid) {
        return $this->users->findUser($uid);
    }

    // Update
    public function update(string $uid, array $data) {
        return $this->users->updateUser($uid,$data);
    }

    // Delete
    public function destroy(string $uid) {
        return $this->users->deleteUser($uid);
    }
}
```

---

## **5. Contoh Pemakaian CRUDSPF**

`routes/test.php` (atau script langsung)

```php
require_once __DIR__.'/../vendor/autoload.php';

use App\Http\Controllers\UserController;

$controller = new UserController();

// CREATE
$controller->store([
    'uid' => uniqid(),
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => password_hash('secret', PASSWORD_BCRYPT),
    'role_uid' => 'role123',
]);

// READ ALL + SEARCH + PAGINATION
print_r($controller->index('john',1,10));

// READ SINGLE
print_r($controller->show('uid123'));

// UPDATE
print_r($controller->update('uid123',['name'=>'Updated Name']));

// DELETE
print_r($controller->destroy('uid123'));
```

---

## **6. Dokumentasi CRUDSPF**

1. **Create** → `store($data)` → `INSERT INTO users ...`
2. **Read All** → `index($search,$page,$perPage)` → `SELECT ... LIMIT OFFSET`
3. **Read Single** → `show($id)` → `SELECT ... WHERE uid=?`
4. **Update** → `update($id,$data)` → `UPDATE ... SET ... WHERE uid=?`
5. **Delete** → `destroy($id)` → `DELETE FROM users WHERE uid=?`
6. **Search** → `.search([...columns], $search)` otomatis LIKE semua kolom
7. **Pagination** → `.paginate(perPage,page)` otomatis return:

```php
[
  'data' => [...],
  'total' => 123,
  'per_page' => 10,
  'current_page' => 1,
  'last_page' => 13
]
```

8. **Filter** → Tambahkan `.where('status','=','active')` di QueryBuilder untuk filter tambahan.

---

## **7. Optimasi Performa**

* Tambahkan **INDEX** di kolom pencarian:

  ```sql
  CREATE INDEX idx_name_email ON users(name,email);
  ```
* Untuk data jutaan row, gunakan **FULLTEXT INDEX** (MySQL InnoDB >= 5.6):

  ```sql
  ALTER TABLE users ADD FULLTEXT(name,email);
  ```
* Ganti `.search()` ke `.fulltextSearch()` di QueryBuilder jika pakai FULLTEXT.
* Hindari `CONCAT()` dalam WHERE karena mematikan index → gunakan `OR LIKE` jika tidak ada FULLTEXT.

---

Mau saya **lengkapi dokumentasi ini dengan:**

1. **Template Migration Runner** (agar migrasi otomatis jalan semua)?
2. **QueryBuilder revisi terbaru full (join >1, filter dinamis, fulltext search)**?
3. **Contoh tambahan: Filter berdasarkan tanggal / role / status dengan QueryBuilder chaining?**
