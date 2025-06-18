<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HerCycle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @font-face {
            font-family: 'HerCycleFont';
            src: url('fonts/Magic Retro.ttf')}
        :root {
            --primary: #e91e63;
            --secondary: #f8bbd0;
            --accent: #880e4f;
            --light: #fce4ec;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(180deg, #FFE2EC 0%, #E18EA0 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }
        
        /* Dekorasi latar belakang (di belakang konten utama) */
        .decoration {
            position: absolute;
            z-index: 0;
            opacity: 0.2;
        }
        
        .decoration-1 {
            top: 10%;
            left: 5%;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: var(--primary);
            animation: float 8s infinite ease-in-out;
        }
        
        .decoration-2 {
            top: 20%;
            right: 5%;
            width: 120px;
            height: 120px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background: var(--accent);
            animation: float 7s infinite ease-in-out;
        }
        
        .decoration-3 {
            bottom: 15%;
            left: 15%;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--secondary);
            animation: float 9s infinite ease-in-out;
        }
        
        .decoration-4 {
            bottom: 20%;
            right: 15%;
            width: 80px;
            height: 80px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background: var(--primary);
            animation: float 6s infinite ease-in-out;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
            }
            100% {
                transform: translateY(0) rotate(0deg);
            }
        }
        
        .hero-section {
            margin-top: -23px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem 1rem;
            position: relative;
            z-index: 2; /* Pastikan konten utama di atas dekorasi */
        }
        
        .hero-content {
            z-index: 3; /* Lebih tinggi dari dekorasi */
            background: #E18EA0; /* Warna solid tanpa transparansi */
            border-radius: 50px;
        }
        
        .logo {
            font-size: 3.5rem;
            font-weight: 800;
            color: #FFFFFF;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }
        
        .tagline {
            font-size: 1.8rem;
            color:  #FFFFFF;
            font-weight: 500;
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }
        
        .description {
            font-size: 1.2rem;
            line-height: 1.5;
            margin-bottom: 2.5rem;
            max-width: 570px;
            height: 450px;
            margin-top:-400px;
            color:  #FFFFFF;
            justify-content: flex-end;
            text-align: left;
            margin-left:756px;
            z-index: 3; /* Lebih tinggi dari dekorasi */
            padding: 2rem;
            background: #E18EA0; /* Warna solid tanpa transparansi */
            border-radius: 50px;
            align-content: center;
        }
        .highlight {
            color: #FFD1DC;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
        .button-container {
            display: flex;
            justify-content: flex-end; /* Menempatkan tombol di kanan */
            margin-top: -50px;
        }
        .get-started-btn {
            display: inline-block;
            background-color: #CD4C77;
            color: white;
            font-weight: bold;
            padding: 1rem 3rem;
            border-radius: 50px;
            border: 3px solid #FF99BB;
            font-size: 1.3rem;
            box-shadow: 0 6px 15px rgba(136, 14, 79, 0.3);
            transition: all 0.4s;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            cursor: pointer;
            width: 300px;
            height: 75px;
            align-items: right;
        }
        
        .get-started-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(136, 14, 79, 0.4);
            background-color: #FFFFFF;
            color: #e91e63;
        }
        
        .footer {
            background-color: #868686;
            color: white;
            text-align: center;
            padding: 1.5rem;
            font-size: 0.9rem;
            position: relative;
            z-index: 2; /* Di atas dekorasi latar belakang */
            margin-top: 50px;
        }
        
        .footer a {
            color: var(--secondary);
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        .header h1{
            width: auto;
        }
        @media (max-width: 768px) {
            .logo {
                font-size: 2.5rem;
            }
            
            .tagline {
                font-size: 1.4rem;
            }
            
            .description {
                font-size: 1rem;
            }
            
            .get-started-btn {
                padding: 0.8rem 2rem;
                font-size: 1.1rem;
            }
            
            .hero-content {
                padding: 1.5rem;
            }
            
            .decoration {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Dekorasi latar belakang -->
    <div class="decoration decoration-1"></div>
    <div class="decoration decoration-2"></div>
    <div class="decoration decoration-3"></div>
    <div class="decoration decoration-4"></div>
    
    <!-- Hero Section -->
    <section class="hero-section" style="padding: 50px 20px 20px 20px;">
        <div class="hero-content" style="width: 1300px; height: 380px">
            <h1 class="logo" style="font-family: 'HerCycleFont', sans-serif;font-size: 100px; margin-left: -600px; margin-bottom: -20px; margin-top: 100px">HerCycle</h1>
            <p class="tagline" style="margin-left: -600px; font-size: 20px">Dari Awal Siklus ke Awal Kehidupan, HerCycle Ada untukmu</p>
</div>
    </section>
      <div class="description" style="padding-left: 40px; padding-bottom: 40px; background-color: #E18EA0; color: white; border-radius: 50px; font-size: 18px; margin-right: -80px">
        <img src="/assets/kalender.jpeg" alt="Kalender Siklus" style="width: 100%; height: auto; border-radius: 50px; margin-bottom: 30px; ">
        <strong>HerCycle</strong> adalah platform yang menemani perempuan dari awal siklus haid hingga awal kehamilan dengan info yang
        <span class="highlight">hangat</span>, <span class="highlight">jujur</span>, dan <span class="highlight">mudah dipahami</span>
      </div>
    </div>
    <div class="image-container">
        <img src="/assets/hamil.jpg" alt="hamil"style="width: 450px; height: 220px; border-radius: 50px; margin-top: -90px;margin-left: 150px">
            
        </div>
    <div class="button-container">
    <a href="<?= base_url('/register') ?>" class="get-started-btn"
       style="margin-right: 140px; margin-top: -50px; display: inline-block; text-decoration: none; text-align: center;">
        LET’S GET STARTED
    </a>
</div>

    <div class="edukasi" style="padding: 20px 20px 20px 20px;">
        <h2 style="margin-top: 100px; font-weight: 70; font-size: 18px">PELAJARI TOPIK BARU DI SINI</h2>
        <h1 style="margin-top: -10px; font-size: 34px"><STRong>EDUKASI TERKINI</STRong></h1>
        <div class="container mt-5">
    <div class="row" style="margin-left: -110px;">
        <?php foreach($edukasi as $item): ?>
            <div class="col-md-4 mb-4" style="margin-top: -30px; ">
                <div class="edukasi" >
                    <img src="<?= $item['gambar'] ?>" class="card-img-top" alt="..." style="border-radius: 50px;">
                    <div class="judul" style="margin-top: 10px;">
                        <h5 class="card-title"><?= esc($item['judul']) ?></h5>
                    </div>
                    <div class="penulis" style="color: #686868; margin-top: 10px">
                        <h5 class="card-title" style=" font-size: 15px"><?= esc($item['penulis']) ?><strong>  •  </strong><?= $item['tanggal'] ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
<section class="about-container" style="background-color: #FFCCDD; height: 500px">
        <div class="header">
            <h1 style="text-align: right;padding: 40px 70px 0px 20px;"><strong>Tentang Kami</strong></h1>
            <h2 style="font-size: 20px; width: 600px; padding-left: 20px; margin-top: 40px; padding-left: 100px"><strong>Halo! Kami adalah Kelompok 5—Mira, Olivia, Icha, Eky, dan Diva.</strong></h2>

<p style="width: 600px; padding-left: 100px; margin-top: 30px">Kami membuat website ini karena kami peduli pada kesehatan reproduksi, terutama soal menstruasi dan kehamilan. Topik ini sering dianggap tabu, padahal penting banget untuk dipahami sejak dini.</p>
<p style="width: 600px; padding-left: 100px; margin-top: 30px">Lewat proyek ini, kami ingin membantu teman-teman agar bisa belajar dengan nyaman, tanpa rasa malu, dan tentu saja dari sumber yang terpercaya.</p>

<p style="width: 600px; padding-left: 100px; margin-top: 30px; padding-bottom: 40px">Semoga apa yang kami sajikan di sini bisa bermanfaat dan membuat kamu merasa lebih siap, lebih paham, dan lebih percaya diri.</p>
<div class="kita">
<img src="assets/img/foto.jpg" alt="kami" style="border-radius: 50px; display: block; margin-left: auto; margin-right: 100px; margin-top: -400px; width: 500px;">      
</div>
</div>
</section>
<div class="deskripsi-footer" style="background-color: #E18EA0; margin-top: 250px; color: white">
    <div class="deskripsi" style="margin-left: 40px;">
            <img src="/assets/logo.png" alt="logo" style="width: 70px; margin-left: 10px; margin-top: -80px; margin-bottom: -155px">
            <p style="width: 400px; padding: 10px 20px 10px 70px"><strong>HerCycle</strong> adalah platform edukasi yang dibuat untuk membantu perempuan memahami lebih dalam tentang siklus menstruasi, kesehatan reproduksi, dan proses kehamilan. Kami percaya bahwa setiap perempuan berhak mendapatkan informasi yang akurat, mudah dipahami, dan mendukung perjalanan hidupnya sejak remaja hingga dewasa.</p>
            <img src="/assets/pin.png" alt="lokasi" style="width: 40px; margin-left: 70px; margin-top: -20px">
            <p style="width: 400px; padding: 40px 20px 10px 70px; margin-left: 50px; margin-top:-80px; font-size: 16px">Jl. Mastrip PO BOX 164, Jember - Jawa Timur- Indonesia</p>
    </div>    
        </div>
    <footer class="footer" style="margin-top: -5px">
        <div class="container">
            <p style="text-align: end;">Copyright © 2025 HerCycle – All Rights Reserved</p>
        </div>
    </footer>

    <script>
        // Animasi tombol
        const button = document.querySelector('.get-started-btn');
        
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
        
        button.addEventListener('click', function() {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            
            setTimeout(() => {
                // Simulasi redirect ke halaman berikutnya
                alert('Selamat datang di HerCycle! Anda akan diarahkan ke halaman utama.');
                // window.location.href = 'dashboard.html';
                
                // Reset tombol
                this.innerHTML = originalText;
            }, 1500);
        });
    </script>
</body>
</html>