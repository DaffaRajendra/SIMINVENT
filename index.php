<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Desain Pemrograman Web - Jobsheet 01 s/d 08</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230b1310'/%3E%3Crect x='2' y='2' width='60' height='60' rx='12' fill='none' stroke='%23c2a468' stroke-opacity='.45' stroke-width='1.5'/%3E%3Cg transform='translate(14 14) scale(1.5)' fill='none' stroke='%23c2a468' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m18 16 4-4-4-4'/%3E%3Cpath d='m6 8-4 4 4 4'/%3E%3Cpath d='m14.5 4-5 16'/%3E%3C/g%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0b1310;
            --bg-soft: #101b16;
            --ivory: #efe8d8;
            --muted: #9aa39a;
            --gold: #c2a468;
            --gold-soft: rgba(194, 164, 104, 0.35);
            --line: rgba(239, 232, 216, 0.12);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background:
                radial-gradient(ellipse at 15% 0%, rgba(194, 164, 104, 0.10), transparent 55%),
                var(--bg);
            background-attachment: fixed;
            color: var(--ivory);
            font-family: 'Jost', 'Helvetica Neue', Arial, sans-serif;
            font-weight: 300;
            line-height: 1.7;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page {
            flex: 1;
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 6rem 2rem 4rem;
            display: grid;
            grid-template-columns: minmax(280px, 5fr) 7fr;
            gap: 6rem;
        }

        /* Bagian judul: tetap terlihat saat daftar di-scroll */
        .intro {
            position: sticky;
            top: 6rem;
            align-self: start;
            animation: reveal 1.2s ease both;
        }

        .intro h1 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-weight: 300;
            font-size: clamp(3rem, 6vw, 5.2rem);
            line-height: 1.02;
            letter-spacing: -0.01em;
        }

        .intro h1 em {
            display: block;
            font-style: italic;
            color: var(--gold);
        }

        .rule {
            width: 64px;
            height: 1px;
            background: var(--gold);
            margin: 2.2rem 0;
        }

        .intro p {
            color: var(--muted);
            max-width: 32ch;
            font-size: 1.02rem;
        }

        /* Daftar jobsheet */
        .list { border-top: 1px solid var(--line); }

        .item {
            display: grid;
            grid-template-columns: 4.5rem 1fr auto;
            align-items: baseline;
            gap: 1rem;
            padding: 2rem 0.5rem;
            border-bottom: 1px solid var(--line);
            color: inherit;
            text-decoration: none;
            position: relative;
            transition: padding 0.4s ease, background 0.4s ease;
        }

        .item::before {
            content: '';
            position: absolute;
            left: 0; top: -1px;
            height: 1px; width: 0;
            background: var(--gold);
            transition: width 0.5s ease;
        }

        .item:hover, .item:focus-visible {
            background: linear-gradient(90deg, rgba(194, 164, 104, 0.07), transparent 80%);
            padding-left: 1.25rem;
            outline: none;
        }

        .item:hover::before, .item:focus-visible::before { width: 100%; }

        .num {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-style: italic;
            font-size: 2.1rem;
            color: var(--gold);
            line-height: 1;
        }

        .item h2 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-weight: 500;
            font-size: 1.7rem;
            line-height: 1.2;
            margin-bottom: 0.4rem;
        }

        .item p {
            color: var(--muted);
            font-size: 0.95rem;
            max-width: 56ch;
        }

        .tag {
            font-size: 0.82rem;
            letter-spacing: 0.04em;
            color: var(--gold);
            border: 1px solid var(--gold-soft);
            padding: 0.2rem 0.8rem;
            border-radius: 999px;
            white-space: nowrap;
        }

        footer {
            border-top: 1px solid var(--line);
            text-align: center;
            color: var(--muted);
            font-size: 0.85rem;
            padding: 2rem 1.5rem;
        }

        @keyframes reveal {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: none; }
        }

        @media (max-width: 900px) {
            .page { grid-template-columns: 1fr; gap: 3.5rem; padding: 4rem 1.5rem 3rem; }
            .intro { position: static; }
        }

        @media (max-width: 560px) {
            .item { grid-template-columns: 3rem 1fr; }
            .tag { grid-column: 2; justify-self: start; }
            .item h2 { font-size: 1.45rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            .intro { animation: none; }
            .item, .item::before { transition: none; }
        }
    </style>
</head>
<body>

    <main class="page">
        <header class="intro">
            <p>Daffa Rajendra Maulana      <em>TI-2D</em></p>
            <p>254107020181</p><br>
            <h1>Desain <em>Pemrograman Web</em></h1>
            <div class="rule"></div>
            <p>Kumpulan hasil praktikum, tugas, dan modul Jobsheet 01 sampai 08.</p>
        </header>

        <nav class="list" aria-label="Daftar jobsheet">
            <a class="item" href="jobsheet-01/">
                <span class="num">01</span>
                <div>
                    <h2>Jobsheet 01</h2>
                    <p>Pengenalan struktur dasar dokumen HTML, pengelolaan direktori kerja, serta elemen teks dasar web.</p>
                </div>
                <span class="tag">Modul 1</span>
            </a>

            <a class="item" href="jobsheet-02/">
                <span class="num">02</span>
                <div>
                    <h2>Jobsheet 02</h2>
                    <p>Implementasi CSS (Cascading Style Sheets), styling elemen komponen, selektor, dan layout visual.</p>
                </div>
                <span class="tag">Modul 2</span>
            </a>

            <a class="item" href="jobsheet-03/">
                <span class="num">03</span>
                <div>
                    <h2>Jobsheet 03</h2>
                    <p>Pengembangan tata letak tingkat lanjut menggunakan teknik modern dan struktur dokumen kompleks.</p>
                </div>
                <span class="tag">Modul 3</span>
            </a>

            <a class="item" href="jobsheet-03_bootstrap/">
                <span class="num">03b</span>
                <div>
                    <h2>Jobsheet 03 (Bootstrap)</h2>
                    <p>Eksplorasi framework CSS Bootstrap untuk mempercepat pembuatan antarmuka responsif.</p>
                </div>
                <span class="tag">Framework</span>
            </a>

            <a class="item" href="jobsheet-04/">
                <span class="num">04</span>
                <div>
                    <h2>Jobsheet 04</h2>
                    <p>Penerapan form interaktif, validasi input, serta elemen kontrol form HTML lanjutan.</p>
                </div>
                <span class="tag">Modul 4</span>
            </a>

            <a class="item" href="jobsheet-05/">
                <span class="num">05</span>
                <div>
                    <h2>Jobsheet 05</h2>
                    <p>Pengenalan logika pemrograman web sisi klien dan interaksi dinamis menggunakan JavaScript.</p>
                </div>
                <span class="tag">Modul 5</span>
            </a>

            <a class="item" href="jobsheet-06/">
                <span class="num">06</span>
                <div>
                    <h2>Jobsheet 06</h2>
                    <p>Manipulasi DOM (Document Object Model) dan penanganan <em>event handling</em> tingkat lanjut.</p>
                </div>
                <span class="tag">Modul 6</span>
            </a>

            <a class="item" href="jobsheet-07/">
                <span class="num">07</span>
                <div>
                    <h2>Jobsheet 07</h2>
                    <p>Pengantar pemrograman web sisi server menggunakan PHP, struktur kontrol, dan penanganan variabel.</p>
                </div>
                <span class="tag">Modul 7</span>
            </a>

            <a class="item" href="jobsheet-08/">
                <span class="num">08</span>
                <div>
                    <h2>Jobsheet 08</h2>
                    <p>Koneksi database (PostgreSQL/MySQL) dan operasi CRUD (Create, Read, Update, Delete) menggunakan PHP.</p>
                </div>
                <span class="tag">Modul 8</span>
            </a>
        </nav>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Praktikum Desain Pemrograman Web. All rights reserved.</p>
    </footer>

</body>
</html>