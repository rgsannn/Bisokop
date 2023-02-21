<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFilmsTable extends Migration
{
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->string('film_id', 16)->primary();
            $table->string('title');
            $table->text('description');
            $table->integer('duration');
            $table->string('thumbnail');
            $table->string('cover');
            $table->double('rating');
            $table->string('genre');
            $table->string('director');
            $table->enum('age_rating', ['R 13+', 'R 17+', 'R 18+', 'R 21+', 'SU', '']);
            $table->text('url_trailer');
            $table->enum('status', ['publish', 'unpublish']);
            $table->timestamps();
        });

        DB::table('films')->insert([
            [
                'film_id' => '9WSRL5ED4K5L6YEW',
                'title' => 'ANT-MAN AND THE WASP: QUANTUMANIA',
                'description' => 'Scott Lang (Paul Rudd), Hope Van Dyne (Evangeline Lilly) Dr. Hank Pym (Michael Douglas) dan Janet Van Dyne (Michelle Pfeiffer) menjelajahi Alam Kuantum, tempat mereka bertemu dengan makhluk aneh dan memulai petualangan yang melampaui batas yang mereka pikir mungkin.',
                'duration' => '124',
                'thumbnail' => 'vg2U7rgpfBFw35Hj83NSLJFOfcycNiPlfUbLc0On.jpg',
                'cover' => 'dhfD2HrIw6trsMsmmYSSaNeBB2XSSJwI8BnPy5jj.jpg',
                'rating' => '4.5',
                'genre' => 'Adventure/Action',
                'director' => 'Peyton Reed',
                'age_rating' => 'R 17+',
                'url_trailer' => 'https://www.youtube.com/watch?v=ZlNFpri-Y40',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'film_id' => 'S9B11Q0WH971ZOJQ',
                'title' => 'ARGANTARA',
                'description' => 'Kehidupan SYERA, seorang siswi SMA berusia 16 tahun mendadak berubah ketika ia menikah muda dengan ARGANTARA, seorang cowok bandel yang dibencinya di sekolah dan juga ketua geng Agberos. Sifat dan sikap keduanya yang bertolak belakang membuat rumah tangga mereka penuh pertengkaran. Arga pun sering tidak ada di rumah kerena teman gengnya terbunuh ketika tawuran besar-besaran dengan geng lain bernama Baron.

                Pernikahan Argantara dan Syera dirahasiakan dari sekolah. Tidak ada satu pun teman mereka yang tahu. Mereka harus berhati-hati karena kalau sampai rahasia ini terbongkar, mereka bisa dikeluarkan dari sekolah. Tapi tiba-tiba Syera hamil! Sampai kapan rahasia mereka bisa tersimpan? Apakah pernikahan dan kehamilan dengan segala tanggung jawabnya adalah sesuatu yang bisa mereka jalani di usia 16 tahun?',
                'duration' => '161',
                'thumbnail' => '60bf68fa-0679-45a1-bef8-3111a978a2c5.jpeg',
                'cover' => 'k3sU9wEQMSoTpU0EwLp2DeOndw5.jpg',
                'rating' => '4.5',
                'genre' => 'Romance',
                'director' => 'Guntur Soeharjanto',
                'age_rating' => 'R 17+',
                'url_trailer' => 'https://www.youtube.com/watch?v=6tIDpvkohQI',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'film_id' => '3W4Z3SG9B9HILP7A',
                'title' => 'PARA BETINA PENGIKUT IBLIS',
                'description' => 'SUMI mengurus ayahnya, KARTO yang sakit. Untuk bertahan hidup ia membuka warung gulai dari daging manusia. Bahan gulai dari mayat yang baru dikubur hingga mayat segar. Sementara SARI kembali menjadi dukun teluh dan meneror desa, saat adiknya, NINGRUM mati dibunuh dan mayatnya hilang dari kuburan. Mereka terhasut dan menjadi budak IBLIS.',
                'duration' => '90',
                'thumbnail' => '2ca9c0f1-9540-4e93-8abf-d2c3aaa760ac.jpeg',
                'cover' => 'jpDyo4FT7xCPs9Enx0B6dIeP85e.jpg',
                'rating' => '4.5',
                'genre' => 'Horror',
                'director' => 'Rako Prijanto',
                'age_rating' => 'R 21+',
                'url_trailer' => 'https://www.youtube.com/watch?v=FqPKs4oyq_g',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'film_id' => 'P9QRJL5ISEO6OT9O',
                'title' => 'OPERATION FORTUNE: RUSE DE GUERRE',
                'description' => 'Agen khusus Orson Fortune (Jason Statham) harus melacak dan menghentikan penjualan senjata berteknologi baru yang mematikan oleh pialang senjata dan miliarder, Greg Simmonds. Bekerja sama dengan beberapa agent terbaik dunia, Fortune dan krunya merekrut bintang film terbesar Hollywood Danny Francesco (Josh Hartnett) untuk membantu mereka dalam misi penyamaran untuk menyelamatkan dunia.',
                'duration' => '114',
                'thumbnail' => 'eb618c2e-9554-42e4-8c22-4a07f65bd710.jpeg',
                'cover' => '6ZZjNFjTlO9F25467CruIibwuxl.jpg',
                'rating' => '4.5',
                'genre' => 'Action/Comedy',
                'director' => 'Guy Ritchie',
                'age_rating' => 'R 13+',
                'url_trailer' => 'https://www.youtube.com/watch?v=W8Sqk1GcqxY',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('films');
    }
}

