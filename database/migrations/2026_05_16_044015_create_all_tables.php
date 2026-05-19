<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Kelas
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas', 10);
            $table->enum('tingkat', ['X', 'XI', 'XII']);
            $table->string('jurusan', 50)->nullable();
            $table->timestamps();
        });

        // 2. Tabel Guru
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('nama_guru', 100);
            $table->string('pendidikan_terakhir', 50)->nullable();
            $table->string('no_telepon', 15)->nullable();
            $table->timestamps();
        });

        // 3. Tabel Mata Pelajaran
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mapel', 10)->unique();
            $table->string('nama_mapel', 100);
            $table->foreignId('id_guru')->nullable()->constrained('guru')->onDelete('set null');
            $table->timestamps();
        });

        // 4. Tabel Siswa
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 20)->unique();
            $table->string('nama_siswa', 100);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->foreignId('id_kelas')->nullable()->constrained('kelas')->onDelete('set null');
            $table->timestamps();
        });

        // 5. Tabel Jembatan Many-to-Many (Siswa ↔ Mata Pelajaran)
        Schema::create('siswa_mapel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('id_mapel')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->string('tahun_ajaran', 20);
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->timestamps();
            $table->unique(['id_siswa', 'id_mapel', 'tahun_ajaran', 'semester'], 'unique_siswa_mapel');
        });

        // 6. Tabel Nilai
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa_mapel')->constrained('siswa_mapel')->onDelete('cascade');
            $table->decimal('nilai_uh1', 5, 2)->nullable();
            $table->decimal('nilai_uh2', 5, 2)->nullable();
            $table->decimal('nilai_uts', 5, 2)->nullable();
            $table->decimal('nilai_uas', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->string('predikat', 5)->nullable();
            $table->timestamps();
        });

        // 7. Tabel One-to-One (Akun Pengguna Siswa)
        Schema::create('akun_pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', ['siswa', 'guru', 'admin'])->default('siswa');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->datetime('terakhir_login')->nullable();
            $table->foreignId('id_siswa')->unique()->constrained('siswa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akun_pengguna');
        Schema::dropIfExists('nilai');
        Schema::dropIfExists('siswa_mapel');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('mata_pelajaran');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('kelas');
    }
};