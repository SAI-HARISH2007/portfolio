<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Sai Haresh Anand S</title>
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

        .projects-main {
            min-height: 100vh;
            padding-top: 8rem;
            padding-bottom: 4rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .projects-hero {
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

        .projects-grid {
            display: grid;
            gap: 2rem;
        }

        .project-card {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 2.5rem;
            border: 1px solid var(--border);
            backdrop-filter: blur(16px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .project-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(236, 72, 153, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .project-card:hover::before {
            opacity: 1;
        }

        .project-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .project-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-1);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }

        .project-icon.health {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .project-icon.spiritual {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .project-icon.scraper {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        }

        .project-icon.chat {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
        }

        .project-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .project-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--gradient-2);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-right: 0.5rem;
        }

        .project-badge.full-stack {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .project-badge.web {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .project-badge.python {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .project-description {
            margin-bottom: 2rem;
        }

        .project-description p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .project-features h4,
        .project-tech h4 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.03);
            padding: 1rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-3px);
            border-color: var(--primary);
        }

        .feature-item i {
            color: var(--secondary);
            font-size: 1.2rem;
        }

        .tech-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .tech-tag {
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tech-tag:hover {
            background: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .tech-tag.ai {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
            border-color: var(--primary);
        }

        .tech-tag.web {
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.2), rgba(0, 242, 254, 0.2));
            border-color: #4facfe;
        }

        .tech-tag.python {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.2));
            border-color: #3b82f6;
        }

        .project-links {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .project-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
        }

        .project-link.github {
            background: linear-gradient(135deg, #24292e, #1a1e22);
        }

        .project-link.github:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(36, 41, 46, 0.4);
        }

        .project-link.linkedin {
            background: linear-gradient(135deg, #0077b5, #005582);
        }

        .project-link.linkedin:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 119, 181, 0.4);
        }

        .project-stats {
            display: flex;
            gap: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .stat-item i {
            color: var(--secondary);
        }

        .coming-soon {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(236, 72, 153, 0.1));
            border: 2px dashed var(--border);
        }

        .coming-soon-content {
            text-align: center;
            padding: 3rem 2rem;
        }

        .coming-soon-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .coming-soon-content h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .coming-soon-content p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
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

            .features-grid {
                grid-template-columns: 1fr;
            }

            .project-links {
                flex-direction: column;
            }

            .project-stats {
                flex-direction: column;
                gap: 1rem;
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
                    <a href="about.php" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="projects.php" class="nav-link active">Projects</a>
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

    <main class="projects-main">
        <div class="container">
            <div class="projects-hero">
                <h1 class="page-title">My Projects</h1>
                <p class="page-subtitle">Innovative solutions powered by AI and modern technology</p>
            </div>

            <div class="projects-grid">
                <!-- CogniFi Project -->
                <div class="project-card fade-in">
                    <div class="project-header">
                        <div class="project-icon health">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div>
                            <h3 class="project-title">CogniFi - Complete Health Companion</h3>
                            <span class="project-badge full-stack">Full-Stack</span>
                            <span class="project-badge">AI-Powered</span>
                        </div>
                    </div>
                    
                    <div class="project-description">
                        <p>A comprehensive health management application combining <strong>physical health monitoring (NutriFitDoc)</strong> with <strong>mental wellness support</strong> through real AI integration using Google's Gemini API.</p>
                    </div>

                    <div class="project-features">
                        <h4><i class="fas fa-star"></i> Key Features</h4>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-pills"></i>
                                <span>Medicine Tracker & Reminders</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-utensils"></i>
                                <span>AI Nutrition Analysis</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-running"></i>
                                <span>Fitness Monitoring</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-comment-medical"></i>
                                <span>24/7 AI Health Assistant</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-heart"></i>
                                <span>Mood Tracking & Analytics</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-brain"></i>
                                <span>Mental Health AI Therapist</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-wind"></i>
                                <span>Breathing & Meditation</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-shield-alt"></i>
                                <span>Crisis Detection & Support</span>
                            </div>
                        </div>
                    </div>

                    <div class="project-tech">
                        <h4><i class="fas fa-cogs"></i> Tech Stack</h4>
                        <div class="tech-tags">
                            <span class="tech-tag ai">Google Gemini API</span>
                            <span class="tech-tag web">HTML5/CSS3</span>
                            <span class="tech-tag web">JavaScript</span>
                            <span class="tech-tag">LocalStorage</span>
                            <span class="tech-tag ai">NLP & Context Memory</span>
                            <span class="tech-tag web">Responsive Design</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/SAI-HARISH2007" target="_blank" class="project-link github">
                            <i class="fab fa-github"></i>
                            <span>View Repository</span>
                        </a>
                        <a href="https://www.linkedin.com/in/sai-harish-1943b223b/" target="_blank" class="project-link linkedin">
                            <i class="fab fa-linkedin"></i>
                            <span>Connect</span>
                        </a>
                    </div>

                    <div class="project-stats">
                        <div class="stat-item">
                            <i class="fas fa-brain"></i>
                            <span>Real AI Integration</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-heartbeat"></i>
                            <span>Health & Mental Wellness</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Privacy-First</span>
                        </div>
                    </div>
                </div>

                <!-- InterviewX Project -->
                <div class="project-card fade-in">
                    <div class="project-header">
                        <div class="project-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div>
                            <h3 class="project-title">InterviewX - AI Interview Bot</h3>
                            <span class="project-badge">AI Project</span>
                        </div>
                    </div>
                    
                    <div class="project-description">
                        <p>An <strong>intelligent AI-powered interview preparation platform</strong> that revolutionizes how candidates practice for job interviews with personalized, real-time coaching.</p>
                    </div>

                    <div class="project-features">
                        <h4><i class="fas fa-brain"></i> AI Features</h4>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-microphone"></i>
                                <span>Voice-to-text transcription</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-magic"></i>
                                <span>AI question generation</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-chart-line"></i>
                                <span>Performance analysis</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-lightbulb"></i>
                                <span>Personalized feedback</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-briefcase"></i>
                                <span>Multiple categories</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-clock"></i>
                                <span>Timed practice sessions</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-award"></i>
                                <span>Skill assessment</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-history"></i>
                                <span>Progress tracking</span>
                            </div>
                        </div>
                    </div>

                    <div class="project-tech">
                        <h4><i class="fas fa-cogs"></i> Tech Stack</h4>
                        <div class="tech-tags">
                            <span class="tech-tag ai">OpenAI GPT</span>
                            <span class="tech-tag web">HTML5/CSS3</span>
                            <span class="tech-tag web">JavaScript</span>
                            <span class="tech-tag ai">Web Speech API</span>
                            <span class="tech-tag">Local Storage</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/SAI-HARISH2007" target="_blank" class="project-link github">
                            <i class="fab fa-github"></i>
                            <span>View Repository</span>
                        </a>
                    </div>

                    <div class="project-stats">
                        <div class="stat-item">
                            <i class="fas fa-robot"></i>
                            <span>AI-Powered</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Interview Prep</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-chart-bar"></i>
                            <span>Analytics</span>
                        </div>
                    </div>
                </div>

                <!-- QuoteGita Project -->
                <div class="project-card fade-in">
                    <div class="project-header">
                        <div class="project-icon spiritual">
                            <i class="fas fa-om"></i>
                        </div>
                        <div>
                            <h3 class="project-title">QuoteGita - Bhagavad Gita Wisdom</h3>
                            <span class="project-badge web">Web App</span>
                        </div>
                    </div>
                    
                    <div class="project-description">
                        <p>A beautiful, minimalist web application that displays <strong>timeless wisdom quotes from the Bhagavad Gita</strong>. Each refresh delivers a new teaching for reflection and spiritual contemplation.</p>
                    </div>

                    <div class="project-features">
                        <h4><i class="fas fa-star"></i> Features</h4>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-random"></i>
                                <span>Random quote generation</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-palette"></i>
                                <span>Aesthetic gradient design</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-heart"></i>
                                <span>Like & favorite quotes</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-copy"></i>
                                <span>One-click copy to clipboard</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-sync-alt"></i>
                                <span>Smooth fade animations</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-mobile-alt"></i>
                                <span>Fully responsive</span>
                            </div>
                        </div>
                    </div>

                    <div class="project-tech">
                        <h4><i class="fas fa-cogs"></i> Tech Stack</h4>
                        <div class="tech-tags">
                            <span class="tech-tag web">HTML5</span>
                            <span class="tech-tag web">CSS3</span>
                            <span class="tech-tag web">Vanilla JavaScript</span>
                            <span class="tech-tag web">SVG Icons</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/SAI-HARISH2007" target="_blank" class="project-link github">
                            <i class="fab fa-github"></i>
                            <span>View Repository</span>
                        </a>
                    </div>

                    <div class="project-stats">
                        <div class="stat-item">
                            <i class="fas fa-book"></i>
                            <span>Spiritual Wisdom</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-paint-brush"></i>
                            <span>Minimalist Design</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-bolt"></i>
                            <span>Fast & Lightweight</span>
                        </div>
                    </div>
                </div>

                <!-- Web Scraper Project -->
                <div class="project-card fade-in">
                    <div class="project-header">
                        <div class="project-icon scraper">
                            <i class="fas fa-search"></i>
                        </div>
                        <div>
                            <h3 class="project-title">Wikipedia Web Scraper GUI</h3>
                            <span class="project-badge python">Python</span>
                            <span class="project-badge">Class 12 Project</span>
                        </div>
                    </div>
                    
                    <div class="project-description">
                        <p>A <strong>full-featured Python GUI Web Scraper</strong> built during Class 12 as a personal project. Features user authentication, custom themes, Wikipedia search, text-to-speech, history tracking, and performance analytics.</p>
                    </div>

                    <div class="project-features">
                        <h4><i class="fas fa-star"></i> Features</h4>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-user-shield"></i>
                                <span>User login/signup system</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-wikipedia-w"></i>
                                <span>Wikipedia scraper</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-paint-brush"></i>
                                <span>CustomTkinter GUI</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-chart-pie"></i>
                                <span>Daily stats with Matplotlib</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-user-secret"></i>
                                <span>Incognito mode</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-volume-up"></i>
                                <span>Text-to-speech</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-save"></i>
                                <span>Save summaries</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-keyboard"></i>
                                <span>Keyboard shortcuts</span>
                            </div>
                        </div>
                    </div>

                    <div class="project-tech">
                        <h4><i class="fas fa-cogs"></i> Tech Stack</h4>
                        <div class="tech-tags">
                            <span class="tech-tag python">Python 3.x</span>
                            <span class="tech-tag python">CustomTkinter</span>
                            <span class="tech-tag python">BeautifulSoup</span>
                            <span class="tech-tag python">pyttsx3</span>
                            <span class="tech-tag python">Matplotlib</span>
                            <span class="tech-tag python">Threading</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/SAI-HARISH2007" target="_blank" class="project-link github">
                            <i class="fab fa-github"></i>
                            <span>View Repository</span>
                        </a>
                    </div>

                    <div class="project-stats">
                        <div class="stat-item">
                            <i class="fas fa-desktop"></i>
                            <span>Desktop GUI</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-code"></i>
                            <span>Python Development</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Academic Project</span>
                        </div>
                    </div>
                </div>

                <!-- BitTalk Project -->
                <div class="project-card fade-in">
                    <div class="project-header">
                        <div class="project-icon chat">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div>
                            <h3 class="project-title">BitTalk - Classroom Chat Administrator</h3>
                            <span class="project-badge python">Python</span>
                            <span class="project-badge">Networking</span>
                        </div>
                    </div>
                    
                    <div class="project-description">
                        <p>An <strong>authenticated, feature-rich chat application</strong> designed for classroom or lab environments. Provides powerful administrative controls including user management, announcements, and remote client shutdown capability for maintaining order in supervised settings.</p>
                    </div>

                    <div class="project-features">
                        <h4><i class="fas fa-star"></i> Features</h4>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-id-card"></i>
                                <span>Student authentication</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-terminal"></i>
                                <span>Centralized logging</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-desktop"></i>
                                <span>CustomTkinter GUI client</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-user-shield"></i>
                                <span>Admin console</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-user-times"></i>
                                <span>Kick/Mute users</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-bullhorn"></i>
                                <span>Global announcements</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-power-off"></i>
                                <span>Remote shutdown</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-chart-bar"></i>
                                <span>Real-time statistics</span>
                            </div>
                        </div>
                    </div>

                    <div class="project-tech">
                        <h4><i class="fas fa-cogs"></i> Tech Stack</h4>
                        <div class="tech-tags">
                            <span class="tech-tag python">Python 3.x</span>
                            <span class="tech-tag python">Socket Programming</span>
                            <span class="tech-tag python">Threading</span>
                            <span class="tech-tag python">CustomTkinter</span>
                            <span class="tech-tag">Client-Server</span>
                        </div>
                    </div>

                    <div class="project-links">
                        <a href="https://github.com/SAI-HARISH2007" target="_blank" class="project-link github">
                            <i class="fab fa-github"></i>
                            <span>View Repository</span>
                        </a>
                    </div>

                    <div class="project-stats">
                        <div class="stat-item">
                            <i class="fas fa-network-wired"></i>
                            <span>Networking</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-school"></i>
                            <span>Classroom Tool</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Admin Controls</span>
                        </div>
                    </div>
                </div>

                <!-- Coming Soon -->
                <div class="project-card coming-soon fade-in">
                    <div class="coming-soon-content">
                        <div class="coming-soon-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3>More Projects Coming Soon</h3>
                        <p>I'm continuously working on exciting new projects in AI, machine learning, and full-stack development. Stay tuned for innovative solutions that push the boundaries of technology!</p>
                        <div class="tech-tags">
                            <span class="tech-tag ai">AI/ML Projects</span>
                            <span class="tech-tag web">Web Applications</span>
                            <span class="tech-tag python">Python Tools</span>
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