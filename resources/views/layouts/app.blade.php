<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'A Little Something For You')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #FFF0F5;
            --card-bg: #FFFFFF;
            --primary-pink: #FFB6C1;
            --accent-rose: #FF69B4;
            --accent-gold: #D4AF37;
            --text-color: #4A4A4A;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            -webkit-tap-highlight-color: transparent;
        }

        /* Floating Heart Canvas */
        #hearts-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 0;
        }

        .main-container {
            position: relative;
            z-index: 1;
            padding-left: 12px;
            padding-right: 12px;
        }

        .cute-card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(255, 182, 193, 0.35);
            border: 2px solid rgba(255, 182, 193, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-pink {
            background-color: var(--primary-pink);
            color: white;
            border-radius: 50px;
            padding: 12px 24px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.6);
            transition: all 0.3s ease;
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-pink:hover, .btn-pink:active {
            background-color: var(--accent-rose);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.6);
        }

        .form-control {
            border-radius: 14px;
            border: 2px solid #FFE4E1;
            padding: 12px 16px;
            font-size: 1rem; /* Prevents auto-zoom on iOS safari */
        }

        .form-control:focus {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 0.25rem rgba(255, 182, 193, 0.25);
        }

        @media (max-width: 576px) {
            .cute-card {
                border-radius: 16px;
            }
            h2, .h2 {
                font-size: 1.5rem;
            }
            h3, .h3 {
                font-size: 1.25rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <canvas id="hearts-canvas"></canvas>

    <div class="main-container d-flex flex-column min-vh-100">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Canvas Confetti CDN -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        const canvas = document.getElementById('hearts-canvas');
        const ctx = canvas.getContext('2d');
        let hearts = [];

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        class Heart {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = canvas.height + Math.random() * 100;
                this.size = Math.random() * 12 + 6;
                this.speedY = Math.random() * 1.2 + 0.4;
                this.speedX = Math.sin(Math.random() * Math.PI) * 0.4;
                this.opacity = Math.random() * 0.5 + 0.3;
            }
            update() {
                this.y -= this.speedY;
                this.x += this.speedX;
                if (this.y < -20) {
                    this.y = canvas.height + 20;
                    this.x = Math.random() * canvas.width;
                }
            }
            draw() {
                ctx.save();
                ctx.globalAlpha = this.opacity;
                ctx.fillStyle = '#FFB6C1';
                ctx.beginPath();
                let topCurveHeight = this.size * 0.3;
                ctx.moveTo(this.x, this.y + topCurveHeight);
                ctx.bezierCurveTo(this.x, this.y, this.x - this.size / 2, this.y, this.x - this.size / 2, this.y + topCurveHeight);
                ctx.bezierCurveTo(this.x - this.size / 2, this.y + (this.size + topCurveHeight) / 2, this.x, this.y + this.size, this.x, this.y + this.size);
                ctx.bezierCurveTo(this.x, this.y + (this.size + topCurveHeight) / 2, this.x + this.size / 2, this.y + (this.size + topCurveHeight) / 2, this.x + this.size / 2, this.y + topCurveHeight);
                ctx.bezierCurveTo(this.x + this.size / 2, this.y, this.x, this.y, this.x, this.y + topCurveHeight);
                ctx.closePath();
                ctx.fill();
                ctx.restore();
            }
        }

        function initHearts() {
            hearts = [];
            const count = window.innerWidth < 576 ? 15 : 25;
            for (let i = 0; i < count; i++) {
                hearts.push(new Heart());
            }
        }

        function animateHearts() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            hearts.forEach(heart => {
                heart.update();
                heart.draw();
            });
            requestAnimationFrame(animateHearts);
        }

        initHearts();
        animateHearts();
    </script>
    @yield('scripts')
</body>
</html>