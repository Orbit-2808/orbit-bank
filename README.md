# Web Orbit Bank
## Database
### Orbit Bank
![Screenshot from 2024-04-12 23-56-45](https://github.com/Orbit-2808/orbit-bank/assets/119851319/797d36ab-efb4-4c87-b813-3366743fc526)

### Indonesian Regional
![Screenshot from 2024-04-16 11-01-33](https://github.com/Orbit-2808/orbit-bank/assets/119851319/a050f24e-2024-4c24-b3ce-821b216a305e)


## Directory
- root: berisikan seluruh folder dan file dari project. Taruh halaman-halaman baru pada folder ini.
  - api: berisikan end point untuk keperluan api. Taruh program api pada folder ini.
  - controller: berisikan program-program yang sifatnya tidak berkenaan dengan tampilan/halaman web.
  - database: berisikan program-program database yang diperlukan dalam menjalankan web


## Program
### Home : /*
index.php: Berisikan dua halaman yang digabungkan: Halaman auth dan halaman melihat data transaksi

### Database: database/*
config.php         : melakukan set up environment variable database yang digunakan dan membuat koneksi ke database.

migrate.php        : membuat ulang database tanpa melakukan import secara manual.

orbit_bank_db.sql  : membuat tabel-tabel ke dalam database


### Auth
auth.php  : mengarahkan untuk meng-handle data auth dari index.php

controller/auth.php  : pengecekan login, login, logout, dan register


### Transaction
transaction.php : mengharahkan untuk meng-handle data transaction dari index.php

controller/transaction.php  : mengambil data balance, menyimpan uang, menarik uang, mentransfer uang
