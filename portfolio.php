<?php
// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'portfolio1';


// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Contact Form Logic
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        $name = htmlspecialchars(trim($_POST['name'])); // Sanitize input
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL); // Validate email
        $message = htmlspecialchars(trim($_POST['message'])); // Sanitize input

        if (!$email) {
            echo "<script>alert('Please enter a valid email address!');</script>";
            return;
        }

        $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([$name, $email, $message])) {
            echo "<script>alert('Thank you, your message was sent successfully.');</script>";
        } else {
            echo "<script>alert('Error sending your message. Please try again later.');</script>";
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Chiheb Gothic Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: system-ui, 'Roboto', sans-serif;
            background-image: url(3e43228d-64d7-4697-b0b5-28414b09150d.png);
            background-size: cover;
        }
        .slider {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
        }
        .slider div {
            scroll-snap-align: start;
            flex: none;
            margin-right: 1rem;
        }
        .portfolio-item {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .portfolio-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .content-section {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
        .content-section.hidden {
            opacity: 0;
            pointer-events: none; /* Prevent interaction when hidden */
        }
    </style>
</head>
<body class="text-white">
<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="bg-[rgba(28, 28, 28, 0.34)] backdrop-blur p-6 rounded-lg md:w-1/4 mb-6 md:mb-0 animate__animated animate__fadeInLeft">
            <div class="flex flex-col items-center">
                <img alt="Avatar of Chiheb Gothic" class="rounded-full mb-4 animate__animated animate__bounceIn" height="100" src="1739198067712.jpeg" width="100"/>
                <h2 class="text-2xl font-bold mb-2">Chiheb Gothic</h2>
                <p class="bg-blue-700 text-sm px-4 py-2 rounded-full mt-4 mb-8">Full Stack Developer</p>
            </div>
            <hr>
            <div class="mt-6">
                <div class="flex items-center mb-8 mt-8">
                    <a href="mailto:chihebgothic@gmail.com"><i class="fas fa-envelope text-blue-700 mr-3"></i>
                        <span>chihebgothic@gmail.com</span></a>
                </div>
                <div class="flex items-center mb-8">
                    <a href="tel:+213663983615"><i class="fas fa-phone text-blue-700 mr-3"></i>
                        <span>+213663983615</span></a>
                </div>
                <div class="flex items-center mb-8">
                    <a href="https://www.facebook.com/chiheb.gothic"><i class="fab fa-facebook text-blue-700 mr-3"></i>
                        <span>Facebook</span></a>
                </div>
                <div class="flex items-center mb-8">
                    <a href="https://www.instagram.com/chiheb_gothic/"><i class="fab fa-instagram text-blue-700 mr-3"></i>
                        <span>Instagram</span></a>
                </div>
                <div class="flex items-center mb-8">
                    <a href="https://github.com/chiheb.gothic"><i class="fab fa-github text-blue-700 mr-3"></i>
                        <span>GitHub</span></a>
                </div>
            </div><br><hr>
            <p class="text-center">All rights reserved <br>2024 © Chiheb Gothic.</p>
        </div>
        <!-- Main Content -->
        <div class="md:w-2/3 md:pl-6 animate__animated animate__fadeInRight">
            <div class="bg-[rgb(28,28,28)] p-4 rounded-lg mb-6">
                <nav class="flex space-x-4 items-center">
                    <a class="text-white hover:text-blue-700 cursor-pointer" onclick="showContent('about')">About</a>
                    <a class="text-white hover:text-blue-700 cursor-pointer" onclick="showContent('More')">More</a>
                    <a class="text-white hover:text-blue-700 cursor-pointer" onclick="showContent('portfolio')">Portfolio</a>
                    <a class="text-white hover:text-blue-700 cursor-pointer" onclick="showContent('contact')">Contact</a>
                    <button onclick="window.location.href='login.php'" id="adminLogin" style="display:none;">Admin</button>

                </nav>
            </div>
<div id="content" class="bg-[rgba(28, 28, 28, 0.76)] p-6 rounded-lg">
            <!-- About Content -->
            <div id="about" class="content-section">
                <h1 class="text-3xl font-bold mb-4 text-blue-700">About Me</h1>
                    <p class="mb-4">
                        I'm Chiheb, a fullstack developer and multimedia specialist from Algeria. I hold a Superior Diploma in Web Development and Multimedia.
                        With experience in problem-solving, high-performance development, and modern, unique design, I create fast, functional, and visually striking digital solutions. My projects blend innovation and efficiency, ensuring both great user experience and strong brand identity.
                    </p>
                <h2 class="text-2xl font-bold mb-4 text-blue-700">What I'm Doing</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-700 p-4 rounded-lg animate__animated animate__zoomIn">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-code text-blue-700 text-2xl mr-2"></i>
                                <h3 class="text-xl font-bold">Web Development</h3>
                            </div>
                            <p>High-quality development of sites at the professional level.</p>
                        </div>
                    <div class="bg-gray-700 p-4 rounded-lg animate__animated animate__zoomIn">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-pencil-ruler text-blue-700 text-2xl mr-2"></i>
                                <h3 class="text-xl font-bold">Web Design</h3>
                            </div>
                            <p>The most modern and high-quality design made at a professional level.</p>
                        </div>
                    </div>
                <h2 class="text-2xl font-bold mt-6 mb-4 text-blue-700">Programming Languages</h2>
                    <div class="slider">
                        <div class="bg-gray-700 p-4 rounded-lg flex flex-col items-center">
                            <i class="fab fa-html5 text-4xl text-blue-700 mb-2"></i>
                            <span>HTML</span>
                        </div>
                    <div class="bg-gray-700 p-4 rounded-lg flex flex-col items-center">
                            <i class="fab fa-css3-alt text-4xl text-blue-700 mb-2"></i>
                            <span>CSS</span>
                        </div>
                    <div class="bg-gray-700 p-4 rounded-lg flex flex-col items-center">
                            <i class="fab fa-js text-4xl text-blue-700 mb-2"></i>
                            <span>JavaScript</span>
                        </div>
                    <div class="bg-gray-700 p-4 rounded-lg flex flex-col items-center">
                            <i class="fab fa-php text-4xl text-blue-700 mb-2"></i>
                            <span>PHP</span>
                        </div>
                    <div class="bg-gray-700 p-4 rounded-lg flex flex-col items-center">
                            <i class="fas fa-database text-4xl text-blue-700 mb-2"></i>
                            <span>MySQL</span>
                        </div>
                    <div class="bg-gray-700 p-4 rounded-lg flex flex-col items-center">
                            <i class="fab fa-laravel text-4xl text-blue-700 mb-2"></i>
                            <span>Laravel</span>
                        </div>
                    <div class="bg-gray-700 p-4 rounded-lg flex flex-col items-center">
                            <i class="fab fa-css3-alt text-4xl text-blue-700 mb-2"></i>
                            <span>TailwindCSS</span>
                        </div>
                    </div>
                </div>
        <!-- Resume Content -->
            <div id="More" class="content-section hidden">
                <h1 class="text-3xl font-bold mb-4 text-blue-700">More</h1>
                    <p class="mb-4">
                        I'm Chiheb, a fullstack developer and multimedia specialist from Algeria. I hold a Superior Diploma in Web Development and Multimedia, graduating in 2025.
                        With experience in problem-solving, high-performance development, and modern, unique design, I create fast, functional, and visually striking digital solutions. My projects blend innovation and efficiency, ensuring both great user experience and strong brand identity.
                    </p>
                    <p class="mb-4">
                        I specialize in building websites that are not only functional and user-friendly but also visually captivating. My goal is to design digital experiences that effectively communicate your brand's identity while ensuring seamless usability.
                        With a keen eye for design and a passion for innovation, I add a unique, personal touch to every project, making sure it stands out and leaves a lasting impression.
                        Having designed websites for various brands and businesses, I am committed to delivering creative, high-quality web solutions that bring your vision to life.
                        Let’s create something extraordinary together!
                    </p>
            </div>
        <!-- Portfolio Content -->
            <div id="portfolio" class="content-section hidden">
                <h1 class="text-3xl font-bold mb-4 text-blue-700">Portfolio</h1>
                    <div id="portfolio-items" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Example Portfolio Item -->
                        <div class="portfolio-item bg-gray-700 p-4 rounded-lg animate__animated animate__zoomIn">
                            <img src="https://storage.googleapis.com/a1aa/image/vWbJbXwYkJRMW7G1gXU4KmJIurcQPVVjl73yuCviQrE.jpg" alt="Project Image" class="rounded mb-2" width="300" height="200">
                            <h3 class="text-xl font-bold text-blue-700">Project Title</h3>
                            <p>Short description of the project.</p>
                        </div>
                    </div>
                </div>
        <!-- Contact Content -->
            <div id="contact" class="content-section hidden">
                <h1 class="text-3xl font-bold mb-4 text-blue-700">Contact</h1>
                    <div class="mb-4">
                        <h2 class="text-xl font-bold mb-2 text-white">Follow Me</h2>
                        <div class="flex space-x-4 mb-8">
                            <a href="https://www.facebook.com/chiheb.gothic" class="text-blue-700 hover:text-white"><i class="fab fa-facebook text-2xl"></i></a>
                            <a href="https://www.instagram.com/chiheb_gothic/" class="text-blue-700 hover:text-white"><i class="fab fa-instagram text-2xl"></i></a>
                            <a href="#" class="text-blue-700 hover:text-white"><i class="fab fa-github text-2xl"></i></a>
                        </div>
                    </div>
        <form method="post" action="portfolio.php">
                <div class="mb-4">
                    <label for="name" class="block  text-sm font-medium text-white">Name</label>
                    <input type="text" id="name" name="name1" class="mt-1 p-2 block w-full  bg-gray-700 text-white rounded-md border-gray-600 focus:border-[rgb(0,72,116)] focus:ring-[rgb(0,72,116)]">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-white">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 block w-full bg-gray-700 text-white rounded-md border-gray-600 focus:border-[rgb(0,72,116)] focus:ring-[rgb(0,72,116)]">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-white">Message</label>
                    <textarea id="message" name="message1" rows="4" class="mt-1 p-2 block w-full bg-gray-700 text-white rounded-md border-gray-600 focus:border-blue-700 focus:ring-[rgb(0,72,116)]"></textarea>
                </div>
                <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-500">Send</button>
                    </form>
                </div>
        </div>
    </div>
</div>
<script>
    function showContent(section) {
        const sections = document.querySelectorAll('.content-section');

        sections.forEach(function (content) {
            if (!content.classList.contains('hidden')) {
                content.style.opacity = '0'; // Start fading out
                setTimeout(() => {
                    content.classList.add('hidden'); // Hide after fade out
                    content.style.opacity = '1'; // Reset opacity for next time
                }, 500);
            }
        });

        const selectedSection = document.getElementById(section);
        selectedSection.classList.remove('hidden');
        setTimeout(() => {
            selectedSection.style.opacity = '1'; // Start fading in
        }, 10);
    }
    document.addEventListener("keydown", function(event) {
    if (event.ctrlKey && event.key === "l") { // Ctrl + L to show the button
        document.getElementById("adminLogin").style.display = "block";
    }
});
</script>
</body>
</html>