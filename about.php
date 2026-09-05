<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Sai Haresh Anand S</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #f59e0b;
            --accent: #ec4899;
            --bg-primary: #0f0f23;
            --bg-secondary: #1a1a2e;
            --bg-card: rgba(255, 255, 255, 0.05);
            --text-primary: #ffffff;
            --text-secondary: #a1a1aa;
            --text-muted: #71717a;
            --border: rgba(255, 255, 255, 0.1);
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(120, 219, 226, 0.3) 0%, transparent 50%);
            z-index: -2;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(10px) rotate(-1deg); }
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(15, 15, 35, 0.8);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--text-primary);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-1);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .nav-social {
            color: var(--text-secondary);
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .nav-social:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }

        .about-main {
            min-height: 100vh;
            padding-top: 8rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .about-hero {
            text-align: center;
            margin-bottom: 4rem;
        }

        .page-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease-out;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .about-intro {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 3rem;
            align-items: center;
            margin-bottom: 4rem;
            padding: 2rem;
            background: var(--bg-card);
            border-radius: 24px;
            border: 1px solid var(--border);
            backdrop-filter: blur(16px);
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .intro-image {
            position: relative;
        }

        .about-photo {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 20px;
            border: 3px solid transparent;
            background: var(--gradient-1);
            padding: 3px;
            transition: all 0.3s ease;
        }

        .about-photo:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow);
        }

        .intro-text h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .intro-tagline {
            font-size: 1.1rem;
            color: var(--secondary);
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .intro-description {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .about-sections {
            display: grid;
            gap: 2rem;
        }

        .section-card {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid var(--border);
            backdrop-filter: blur(16px);
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .section-card h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .education-item {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid var(--primary);
        }

        .education-item h4 {
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .education-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--gradient-2);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .interests-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .interest-item {
            background: rgba(255, 255, 255, 0.03);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .interest-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-5px);
            border-color: var(--primary);
        }

        .interest-item i {
            font-size: 2rem;
            margin-bottom: 1rem;
            background: var(--gradient-3);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hobbies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .hobby-item {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .hobby-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-2);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .hobby-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .hobby-item:hover::before {
            opacity: 0.1;
        }

        .hobby-item i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--secondary);
        }

        .hobby-content h4 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .hobby-content p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .belief-item {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--accent);
        }

        .belief-item h4 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .belief-item i {
            color: var(--accent);
        }

        .goal-statement {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-secondary);
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 16px;
            border: 1px solid rgba(102, 126, 234, 0.2);
            position: relative;
        }

        .goal-statement::before {
            content: '"';
            font-size: 4rem;
            font-family: 'Space Grotesk', sans-serif;
            color: var(--primary);
            position: absolute;
            top: -10px;
            left: 20px;
        }

        .footer {
            margin-top: 4rem;
            background: var(--bg-secondary);
            border-top: 1px solid var(--border);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .footer-content {
            text-align: center;
        }

        .footer-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .social-link {
            width: 50px;
            height: 50px;
            background: var(--bg-card);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }

        .social-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .bar {
            width: 25px;
            height: 3px;
            background: var(--text-primary);
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .nav-menu {
                position: fixed;
                left: -100%;
                top: 70px;
                flex-direction: column;
                background: var(--bg-secondary);
                width: 100%;
                text-align: center;
                transition: 0.3s;
                padding: 2rem 0;
                border-top: 1px solid var(--border);
            }

            .nav-menu.active {
                left: 0;
            }

            .page-title {
                font-size: 2.5rem;
            }

            .about-intro {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .interests-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .hobbies-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <span>Haresh</span>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="about.php" class="nav-link active">About</a>
                </li>
                <li class="nav-item">
                    <a href="projects.php" class="nav-link">Projects</a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="https://github.com/SAI-HARISH2007" target="_blank" class="nav-social">
                        <i class="fab fa-github"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://www.linkedin.com/in/sai-harish-1943b223b/" target="_blank" class="nav-social">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <main class="about-main">
        <div class="container">
            <div class="about-hero">
                <h1 class="page-title">About Me</h1>
                <p class="page-subtitle">Getting to know the person behind the code</p>
            </div>

            <div class="about-content">
                <div class="about-intro">
                    <div class="intro-image">
                        <img src="Photo_recent.jpg" alt="Sai Haresh Anand S" class="about-photo">
                    </div>
                    <div class="intro-text">
                        <h2>Sai Haresh Anand S</h2>
                        <p class="intro-tagline">B.Tech CSE (AI & ML) Student | Technology Enthusiast | Creative Problem Solver</p>
                        <p class="intro-description">
                            Currently pursuing B.Tech in Computer Science Engineering with specialization in 
                            Artificial Intelligence and Machine Learning at ICFAItech, Hyderabad. 
                            My journey in technology is driven by curiosity and a passion for creating 
                            solutions that make a meaningful impact.
                        </p>
                    </div>
                </div>

                <div class="about-sections">
                    <div class="section-card fade-in">
                        <h3>
                            <div class="section-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            Education
                        </h3>
                        <div class="section-content">
                            <div class="education-item">
                                <h4>B.Tech in CSE (AI & ML)</h4>
                                <p>ICFAItech, Hyderabad</p>
                                <span class="education-status">Currently Pursuing</span>
                            </div>
                            <div class="education-item">
                                <h4>Higher Secondary Education</h4>
                                <p>Sri Sathya Sai Higher Secondary School (SSSHSS)</p>
                                <span class="education-status">Completed</span>
                            </div>
                        </div>
                    </div>

                    <div class="section-card fade-in">
                        <h3>
                            <div class="section-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            Interests & Passion
                        </h3>
                        <div class="section-content">
                            <div class="interests-grid">
                                <div class="interest-item">
                                    <i class="fas fa-robot"></i>
                                    <span>Artificial Intelligence</span>
                                </div>
                                <div class="interest-item">
                                    <i class="fas fa-brain"></i>
                                    <span>Machine Learning</span>
                                </div>
                                <div class="interest-item">
                                    <i class="fas fa-code"></i>
                                    <span>Software Development</span>
                                </div>
                                <div class="interest-item">
                                    <i class="fas fa-music"></i>
                                    <span>Music Production</span>
                                </div>
                                <div class="interest-item">
                                    <i class="fas fa-palette"></i>
                                    <span>Digital Art</span>
                                </div>
                                <div class="interest-item">
                                    <i class="fas fa-cog"></i>
                                    <span>Automation</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-card fade-in">
                        <h3>
                            <div class="section-icon">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            Hobbies & Creative Pursuits
                        </h3>
                        <div class="section-content">
                            <div class="hobbies-grid">
                                <div class="hobby-item">
                                    <i class="fas fa-microphone-alt"></i>
                                    <div class="hobby-content">
                                        <h4>Sound Engineering</h4>
                                        <p>Audio mixing, mastering, and creating immersive soundscapes</p>
                                    </div>
                                </div>
                                <div class="hobby-item">
                                    <i class="fas fa-headphones"></i>
                                    <div class="hobby-content">
                                        <h4>Music Production</h4>
                                        <p>Composing and producing original tracks across various genres</p>
                                    </div>
                                </div>
                                <div class="hobby-item">
                                    <i class="fas fa-paint-brush"></i>
                                    <div class="hobby-content">
                                        <h4>Artist</h4>
                                        <p>Digital and traditional painting, exploring visual storytelling</p>
                                    </div>
                                </div>
                                <div class="hobby-item">
                                    <i class="fas fa-camera"></i>
                                    <div class="hobby-content">
                                        <h4>Creative Content</h4>
                                        <p>Photography, video editing, and multimedia projects</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-card fade-in">
                        <h3>
                            <div class="section-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            Philosophy & Beliefs
                        </h3>
                        <div class="section-content">
                            <div class="belief-item">
                                <h4><i class="fas fa-tools"></i> Problem Solver</h4>
                                <p>Technology can solve real-world problems. I combine analytical thinking with creativity to design impactful, scalable solutions.</p>
                            </div>
                            <div class="belief-item">
                                <h4><i class="fas fa-palette"></i> Creative Technologist</h4>
                                <p>Skilled in painting, music production, and sound engineering; I love blending art and technology to create unique experiences.</p>
                            </div>
                            <div class="belief-item">
                                <h4><i class="fas fa-book-open"></i> Lifelong Learner</h4>
                                <p>Continuously exploring automation, programming, and emerging tech trends to stay at the forefront of innovation.</p>
                            </div>
                        </div>
                    </div>

                    <div class="section-card fade-in">
                        <h3>
                            <div class="section-icon">
                                <i class="fas fa-target"></i>
                            </div>
                            Goals & Vision
                        </h3>
                        <div class="section-content">
                            <p class="goal-statement">
                                To contribute to advancements in AI and technology that enhance human capabilities. 
                                I aspire to be part of breakthrough innovations that shape the future of how we 
                                interact with technology and solve complex global challenges.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-social">
                    <a href="https://github.com/SAI-HARISH2007" target="_blank" class="social-link">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/sai-harish-1943b223b/" target="_blank" class="social-link">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
                <p class="footer-text">© 2025 Sai Haresh Anand S. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        document.querySelectorAll('.nav-link').forEach(n => n.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
        }));

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(15, 15, 35, 0.95)';
            } else {
                navbar.style.background = 'rgba(15, 15, 35, 0.8)';
            }
        });
    </script>
</body>
</html>