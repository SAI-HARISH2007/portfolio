<?php
$message = '';
$messageType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $userMessage = htmlspecialchars(trim($_POST['message']));
    
    if (empty($name) || empty($phone) || empty($email) || empty($subject) || empty($userMessage)) {
        $message = 'Please fill in all fields.';
        $messageType = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
        $messageType = 'error';
    } else {
        $to = "saiharishanand2007@gmail.com";
        $emailSubject = "Portfolio Contact: " . $subject;
        
        $emailBody = "=== New Contact Form Submission ===\n\n";
        $emailBody .= "From: $name\n";
        $emailBody .= "Email: $email\n";
        $emailBody .= "Phone: $phone\n";
        $emailBody .= "Subject: $subject\n\n";
        $emailBody .= "Message:\n" . str_repeat("-", 50) . "\n";
        $emailBody .= $userMessage . "\n";
        $emailBody .= str_repeat("-", 50) . "\n\n";
        $emailBody .= "Sent from: haresh.acadnet.net\n";
        $emailBody .= "Date: " . date('Y-m-d H:i:s') . "\n";
        
        $headers = "From: noreply@acadnet.net\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        $additionalParams = "-f noreply@acadnet.net";
        
        if (@mail($to, $emailSubject, $emailBody, $headers, $additionalParams)) {
            $message = 'Your message has been sent successfully! I\'ll get back to you soon.';
            $messageType = 'success';
            
            $logFile = 'contact_submissions.log';
            $logEntry = date('Y-m-d H:i:s') . " | $name | $email | $phone | $subject\n";
            @file_put_contents($logFile, $logEntry, FILE_APPEND);
        } else {
            $fallbackFile = 'contact_messages.txt';
            $fallbackContent = "\n" . str_repeat("=", 60) . "\n";
            $fallbackContent .= "Date: " . date('Y-m-d H:i:s') . "\n";
            $fallbackContent .= $emailBody;
            @file_put_contents($fallbackFile, $fallbackContent, FILE_APPEND);
            
            $message = 'Message received! Due to email server configuration, please also send directly to saiharishanand2007@gmail.com';
            $messageType = 'success';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Sai Haresh Anand S</title>
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
            --success: #22c55e;
            --error: #ef4444;
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

        .contact-main {
            min-height: 100vh;
            padding-top: 8rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .contact-hero {
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

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 4rem;
        }

        .contact-methods {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .contact-card {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid var(--border);
            backdrop-filter: blur(16px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .contact-card::before {
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

        .contact-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .contact-card:hover::before {
            opacity: 1;
        }

        .contact-card-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            position: relative;
            background: var(--gradient-1);
        }

        .contact-card.linkedin .contact-icon {
            background: var(--gradient-3);
        }

        .contact-card.github .contact-icon {
            background: linear-gradient(135deg, #24292e, #1a1e22);
        }

        .contact-info h3 {
            color: var(--text-primary);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .contact-info p {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .contact-action {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contact-action:hover {
            background: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .contact-form-container {
            background: var(--bg-card);
            padding: 2.5rem;
            border-radius: 24px;
            border: 1px solid var(--border);
            backdrop-filter: blur(16px);
            animation: fadeInUp 1s ease-out 0.6s both;
            position: relative;
            overflow: hidden;
        }

        .contact-form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(236, 72, 153, 0.05));
            z-index: -1;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--text-secondary);
        }

        .message {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: var(--success);
        }

        .message.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--error);
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            display: block;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1.25rem 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text-primary);
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: var(--text-muted);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 140px;
        }

        .submit-btn {
            background: var(--gradient-1);
            color: white;
            border: none;
            padding: 1.25rem 3rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            align-self: flex-start;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .contact-cta {
            background: var(--bg-card);
            padding: 3rem;
            border-radius: 24px;
            border: 1px solid var(--border);
            backdrop-filter: blur(16px);
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out 0.8s both;
        }

        .contact-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(236, 72, 153, 0.1));
            z-index: -1;
        }

        .cta-content h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: var(--gradient-2);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cta-content p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-social {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .social-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.25rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .social-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .social-btn:hover::before {
            transform: translateX(100%);
        }

        .social-btn.github {
            background: linear-gradient(135deg, #24292e, #1a1e22);
        }

        .social-btn.github:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(36, 41, 46, 0.4);
        }

        .social-btn.linkedin {
            background: linear-gradient(135deg, #0077b5, #005582);
        }

        .social-btn.linkedin:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 119, 181, 0.4);
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

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .cta-social {
                flex-direction: column;
                align-items: center;
            }

            .social-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .contact-form-container {
                padding: 2rem;
            }

            .submit-btn {
                width: 100%;
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
                    <a href="projects.php" class="nav-link">Projects</a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link active">Contact</a>
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

    <main class="contact-main">
        <div class="container">
            <div class="contact-hero">
                <h1 class="page-title">Get In Touch</h1>
                <p class="page-subtitle">Let's discuss ideas, collaborate on projects, or just have a conversation</p>
            </div>

            <div class="contact-grid">
                <div class="contact-methods">
                    <div class="contact-card">
                        <div class="contact-card-content">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-info">
                                <h3>Send me an email</h3>
                                <p>Reach out directly through my contact form or your preferred email client</p>
                                <a href="mailto:saiharishanand2007@gmail.com" class="contact-action">
                                    <i class="fas fa-paper-plane"></i>
                                    Email Me
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-card linkedin">
                        <div class="contact-card-content">
                            <div class="contact-icon">
                                <i class="fab fa-linkedin"></i>
                            </div>
                            <div class="contact-info">
                                <h3>Connect on LinkedIn</h3>
                                <p>Let's connect professionally and explore opportunities together</p>
                                <a href="https://www.linkedin.com/in/sai-harish-1943b223b/" target="_blank" class="contact-action">
                                    <i class="fas fa-external-link-alt"></i>
                                    Connect
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-card github">
                        <div class="contact-card-content">
                            <div class="contact-icon">
                                <i class="fab fa-github"></i>
                            </div>
                            <div class="contact-info">
                                <h3>Check out my work</h3>
                                <p>Explore my projects, contribute, or just see what I'm building</p>
                                <a href="https://github.com/SAI-HARISH2007" target="_blank" class="contact-action">
                                    <i class="fas fa-code"></i>
                                    View Projects
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form-container">
                    <div class="form-header">
                        <h2>Start a Conversation</h2>
                        <p>Fill out the form below and I'll get back to you as soon as possible</p>
                    </div>
                    
                    <?php if (!empty($message)): ?>
                        <div class="message <?php echo $messageType; ?>">
                            <i class="fas fa-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form class="contact-form" method="POST" action="contact.php">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" placeholder="Your name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" placeholder="Your phone number" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="What's this about?" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="6" placeholder="Tell me more about your project or idea..." required></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <span>Send Message</span>
                            <i class="fas fa-rocket"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="contact-cta">
                <div class="cta-content">
                    <h3>Let's Build Something Amazing</h3>
                    <p>Whether you have a revolutionary idea, need a creative collaborator, or just want to chat about technology and innovation, I'm always excited to connect with like-minded individuals.</p>
                    <div class="cta-social">
                        <a href="https://github.com/SAI-HARISH2007" target="_blank" class="social-btn github">
                            <i class="fab fa-github"></i>
                            <span>Follow on GitHub</span>
                        </a>
                        <a href="https://www.linkedin.com/in/sai-harish-1943b223b/" target="_blank" class="social-btn linkedin">
                            <i class="fab fa-linkedin"></i>
                            <span>Connect on LinkedIn</span>
                        </a>
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

        const form = document.querySelector('.contact-form');
        const inputs = form.querySelectorAll('input, textarea');

        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', () => {
                if (input.value === '') {
                    input.parentElement.classList.remove('focused');
                }
            });
        });

        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(15, 15, 35, 0.95)';
            } else {
                navbar.style.background = 'rgba(15, 15, 35, 0.8)';
            }
        });

        const message = document.querySelector('.message');
        if (message) {
            setTimeout(() => {
                message.style.opacity = '0';
                message.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    message.style.display = 'none';
                }, 300);
            }, 5000);
        }

        const contactCards = document.querySelectorAll('.contact-card');
        contactCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-12px) scale(1.03)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });

        const submitBtn = document.querySelector('.submit-btn');
        form.addEventListener('submit', (e) => {
            submitBtn.innerHTML = '<span>Sending...</span><i class="fas fa-spinner fa-spin"></i>';
            submitBtn.disabled = true;
        });

        const socialBtns = document.querySelectorAll('.social-btn');
        socialBtns.forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                btn.style.transform = 'translateY(-8px) scale(1.05)';
            });
            
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>