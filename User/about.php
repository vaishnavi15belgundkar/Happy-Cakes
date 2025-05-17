<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>
   <link rel="stylesheet" href="css/style.css">
   
   <style>
   /* Animation styles */
   .fade-in {
       opacity: 0;
       transform: translateY(20px);
       transition: opacity 0.8s ease-out, transform 0.8s ease-out;
   }
   
   .fade-in.visible {
       opacity: 1;
       transform: translateY(0);
   }
   
   .fade-in-left {
       opacity: 0;
       transform: translateX(-30px);
       transition: opacity 0.8s ease-out, transform 0.8s ease-out;
   }
   
   .fade-in-left.visible {
       opacity: 1;
       transform: translateX(0);
   }
   
   .fade-in-right {
       opacity: 0;
       transform: translateX(30px);
       transition: opacity 0.8s ease-out, transform 0.8s ease-out;
   }
   
   .fade-in-right.visible {
       opacity: 1;
       transform: translateX(0);
   }
   
   .fade-in-delay-1 {
       transition-delay: 0.2s;
   }
   
   .fade-in-delay-2 {
       transition-delay: 0.4s;
   }
   
   .fade-in-delay-3 {
       transition-delay: 0.6s;
   }
   
   /* Enhanced hover effects */
   .about .flex .image {
       transition: transform 0.3s ease-out;
   }
   
   .about .flex .image:hover {
       transform: scale(1.02);
   }
   
   .about .flex .image img {
       transition: filter 0.3s ease-out;
   }
   
   .about .flex .image:hover img {
       filter: brightness(1.05);
   }
   
   /* Section spacing and background for better visual separation */
   .about .flex {
       margin-bottom: 3rem;
       padding: 2rem 0;
       background: rgba(255, 255, 255, 0.02);
       border-radius: 10px;
       backdrop-filter: blur(5px);
   }
   
   .about .flex:last-child {
       margin-bottom: 0;
   }
   
   /* Enhanced content styling */
   .about .flex .content h3 {
       margin-bottom: 1rem;
       transition: color 0.3s ease-out;
   }
   
   .about .flex .content p {
       line-height: 1.7;
       transition: opacity 0.3s ease-out;
   }
   
   /* Loading state to prevent flash of unstyled content */
   .about {
       opacity: 0;
       transition: opacity 0.5s ease-out;
   }
   
   .about.loaded {
       opacity: 1;
   }
   </style>

</head>
<body>
   
<?php @include 'header2.php'; ?>

<section class="heading fade-in">
    <h3>about us</h3>
</section>

<section class="about">

    <div class="flex">

        <div class="image fade-in-left">
            <img src="images/AAA.webp" alt="Happy Cakes bakery showcase">
        </div>

        <div class="content fade-in-right fade-in-delay-1">
            <h3>Why Choose Us?</h3>
            <p>At Happy Cakes bakery, we understand that every celebration deserves something special. That's why we strive to create cakes that not only look stunning but also taste divine. With our dedication to quality and craftsmanship, we ensure that every cake we bake becomes the centerpiece of your memorable moments.</p>
        </div>

    </div>

    <div class="flex">

        <div class="content fade-in-left fade-in-delay-2">
            <h3>What We Provide?</h3>
            <p>Our range of delectable cakes caters to every occasion, from birthdays and weddings to anniversaries and corporate events. Whether you're craving a classic chocolate cake, a whimsical fondant masterpiece, or a custom-designed creation, we have something to delight every palate. With our commitment to using the finest ingredients and innovative techniques, we guarantee a cake that exceeds your expectations.</p>
        </div>

        <div class="image fade-in-right fade-in-delay-2">
            <img src="images/birthday-cake-happy-birthday-cake-birthday-cake-transparent-background-ai-generative-free-png.webp" alt="Birthday cake celebration">
        </div>

    </div>

    <div class="flex">

        <div class="image fade-in-left fade-in-delay-3">
            <img src="images/chocolate-cake-happy-birthday-chocolate-cake-ai-generative-free-png.webp" alt="Delicious chocolate cake">
        </div>

        <div class="content fade-in-right fade-in-delay-3">
            <h3>Who We Are?</h3>
            <p>At the heart of Happy Cakes is a team of passionate bakers and artists who share a love for all things sweet. With years of experience and a flair for creativity, our talented team brings your cake dreams to life. We take pride in our attention to detail, ensuring that each cake is not only visually stunning but also a true reflection of your personality and style.</p>
        </div>

    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

<script>
// Enhanced animation script with better performance and timing
document.addEventListener('DOMContentLoaded', function() {
    // Add loaded class to about section
    const aboutSection = document.querySelector('.about');
    if (aboutSection) {
        aboutSection.classList.add('loaded');
    }

    // Intersection Observer for better performance
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Unobserve once animated to improve performance
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all elements with animation classes
    const animatedElements = document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right');
    animatedElements.forEach(el => {
        observer.observe(el);
    });

    // Fallback for older browsers or if Intersection Observer is not supported
    if (!window.IntersectionObserver) {
        animatedElements.forEach(el => {
            el.classList.add('visible');
        });
    }

    // Additional smooth scrolling for any internal links (optional enhancement)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Optional: Add a subtle parallax effect to images (can be removed if not desired)
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const images = document.querySelectorAll('.about .image img');
    
    images.forEach((img, index) => {
        const rate = scrolled * -0.5;
        img.style.transform = `translateY(${rate * 0.1}px)`;
    });
});
</script>

</body>
</html>