**B1: Clone thư mục code**
- git clone ...

**B2: cd deployment**
- Run: docker-compose up -d

**B3: Run: docker exec -it laravel_web bash (winpty docker exec -it laravel_web bash nếu là windows)**
-  cd /var/www/html/laravel-sample/
- 「composer install」 or 「composer install --no-dev」
- cp .env.example .env
- php artisan key:generate
- php artisan storage:link
- chown root:apache -R .
- chmod 775 -R .
- git config core.filemode false
- mkdir logs
- npm install

**B4: Run: docker exec -it laravel_db bash (winpty docker exec -it laravel_db bash nếu là windows)**
- Run: mysql -u root -proot
- Run:<br>
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';

**B5: Tạo DB laravel**
- Truy cập http://localhost:49310/?server=laravel_db&username=root
- Tạo DB: laravel (utf8mb4_general_ci)
- Run: php artisan migrate

**B6: Edit file .env<br>**
DB_CONNECTION=mysql<br>
DB_HOST=laravel_db<br>
DB_PORT=<br>
DB_DATABASE=laravel<br>
DB_USERNAME=root<br>
DB_PASSWORD=root<br>

**B7: Start apache**
- Run: echo 'IncludeOptional sites-enabled/*.conf' >> /etc/httpd/conf/httpd.conf
- Run: systemctl enable httpd
- Run: systemctl restart httpd.service

**B8: Run web**
Website: http://localhost:49081/<br>

**B12**: php artisan config:cache

**B13**: php artisan db:seed

**B14**: Login
- email: admin@gmail.com
- password: 123456
# quanlygv
