# veggie-backend
```
project นี้เป็น backend api ของ website veggie การซื้อขายผักออนไลน์ สามารถ download source code ของตัว website ได้ที่ https://github.com/Blackplasma88/veggie-frontend
```

### Project setup
```
เมื่อทำการโคลน project ไปให้ทำการสร้างไฟล์ .env ขึ้นมาแล้วนำ code ในไฟล์ .env.example ไปใส่เอาไว้ จากนั้นไปทำการใส่ค่าของ DB_DATABASE, DB_USERNAME และ DB_PASSWORD จากนั้น run คำสั่ง
composer install
php artisan key:generate
```

### Run Project
```
ให้ทำการ run project นี้ก่อนทำการใช้งานตัว website veggie โดยการใช้คำสั่ง
php artisan serve
```