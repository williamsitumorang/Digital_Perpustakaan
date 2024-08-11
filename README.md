Informasi mengenai proyek

ada dua role: user dan admin

pada role admin saya, saya membuatnya dalam database seeder, dapat dilihat di file App/database/Database Seeder, berikut akun admin:

        email      = adminperpustakaan@gmail.com
        password   = admin123

pada role user saya, saya membuatnya dalam database seeder, dapat dilihat di file App/database/Database Seeder, berikut akun user:

        email      = gavi@gmail.com
        password   = gavi123

Namun, user dapat melakukan daftar (register) dengan role default user, jadi admin tidak bisa membuat akun, akun admin telah di tetapkan

proyek ini dapat di clone dari github berikut linknya

https://github.com/williamsitumorang/Digital_Perpustakaan

        - database telah dilampirkan di proyek ini dengan nama digital_perpustakan.sql
        - database bisa di import ke mysql atau bisa juga melalu command php artisan migrate atau php artisan migrate --seed
