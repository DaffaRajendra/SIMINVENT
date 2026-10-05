-- Skema tabel untuk SIMINVENT-Mini (PostgreSQL)
-- Struktur mengikuti field pada form Tambah Barang & Tambah Peminjam.

CREATE TABLE IF NOT EXISTS barang (
    id               SERIAL PRIMARY KEY,
    kode_barang      VARCHAR(50) UNIQUE NOT NULL,
    nama_barang      VARCHAR(150) NOT NULL,
    kategori         VARCHAR(20) NOT NULL CHECK (kategori IN ('perabotan', 'elektronik')),
    lokasi           VARCHAR(100) NOT NULL,
    stok             INTEGER NOT NULL CHECK (stok >= 0),
    tahun_pengadaan  INTEGER NOT NULL,
    kondisi          VARCHAR(20) NOT NULL CHECK (kondisi IN ('baik', 'rusak')),
    dibuat_pada      TIMESTAMP NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS peminjam (
    id                  SERIAL PRIMARY KEY,
    nim                 VARCHAR(20) UNIQUE NOT NULL,
    nama                VARCHAR(150) NOT NULL,
    status              VARCHAR(20) NOT NULL CHECK (status IN ('mahasiswa', 'dosen', 'petugas')),
    prodi               VARCHAR(100) NOT NULL,
    no_hp               VARCHAR(20) NOT NULL,
    email               VARCHAR(150) NOT NULL,
    tanggal_bergabung   TIMESTAMP NOT NULL DEFAULT NOW()
);
