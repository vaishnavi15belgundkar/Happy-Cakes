<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');       
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   <link rel="stylesheet" href="css/style.css">
<style>
.contact-container {
   max-width: 1200px;
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   gap: 3rem;
   padding: 2rem 0;
}

.contact-info {
   display: flex;
   flex-direction: column;
   gap: 2rem;
}

.contact-info .info-item {
   display: flex;
   align-items: flex-start;
   gap: 1.5rem;
   background-color: var(--white);
   padding: 2rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
}

.contact-info .info-item i {
   font-size: 2.5rem;
   color: var(--pink);
   margin-top: 0.5rem;
}

.contact-info .info-item h3 {
   font-size: 2rem;
   color: var(--black);
   margin-bottom: .5rem;
}

.contact-info .info-item p {
   font-size: 1.5rem;
   color: var(--light-color);
   line-height: 1.5;
}

.contact form {
   background-color: var(--white);
   padding: 3rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
}

.contact form h3 {
   text-align: center;
   font-size: 2.5rem;
   color: var(--black);
   margin-bottom: 2rem;
}

.contact form .box {
   width: 100%;
   margin: 1rem 0;
   padding: 1.2rem 1.4rem;
   font-size: 1.6rem;
   color: var(--black);
   border-radius: .5rem;
   background-color: var(--light-bg);
}

.contact form textarea {
   height: 15rem;
   resize: none;
}

/* Enhanced Google Maps Section Styles */
.map-section {
   max-width: 1200px;
   margin: 4rem auto;
   padding: 2rem;
}

.map-section h3 {
   text-align: center;
   font-size: 2.5rem;
   color: var(--black);
   margin-bottom: 2rem;
}

.map-container {
   position: relative;
   width: 100%;
   height: 0;
   padding-bottom: 45%; /* 16:9 aspect ratio (9/16 = 0.5625 or 56.25%) - adjusted for better height */
   background-color: var(--white);
   border-radius: 1rem;
   box-shadow: var(--box-shadow);
   overflow: hidden;
}

.map-container iframe {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   border: none;
   border-radius: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
   .contact-container {
      grid-template-columns: 1fr;
      padding: 1rem;
      gap: 2rem;
   }
   
   .contact form {
      padding: 2rem;
   }
   
   .map-section {
      padding: 1rem;
      margin: 2rem auto;
   }
   
   .map-container {
      padding-bottom: 60%; /* Slightly taller on mobile for better visibility */
   }
   
   .contact-info .info-item {
      padding: 1.5rem;
   }
   
   .contact-info .info-item h3 {
      font-size: 1.8rem;
   }
   
   .contact-info .info-item p {
      font-size: 1.4rem;
   }
}

@media (max-width: 480px) {
   .map-container {
      padding-bottom: 75%; /* Even taller on very small screens */
   }
   
   .contact form h3,
   .map-section h3 {
      font-size: 2rem;
   }
}

/* Contact page layout improvements */
.contact {
   padding: 2rem 0;
   background-color: var(--light-bg, #f8f9fa);
}

/* Add some animation to the info items */
.contact-info .info-item {
   transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contact-info .info-item:hover {
   transform: translateY(-5px);
   box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Form enhancements */
.contact form .btn {
   background-color: var(--pink);
   color: white;
   padding: 1.2rem 2rem;
   font-size: 1.6rem;
   border: none;
   border-radius: .5rem;
   cursor: pointer;
   transition: background-color 0.3s ease;
   width: 100%;
   margin-top: 1rem;
}

.contact form .btn:hover {
   background-color: var(--dark-pink, #d63384);
}

.contact form .box {
   border: 2px solid transparent;
   transition: border-color 0.3s ease;
}

.contact form .box:focus {
   outline: none;
   border-color: var(--pink);
}

/* Enhanced Animation Styles */
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

.fade-in-scale {
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.fade-in-scale.visible {
    opacity: 1;
    transform: scale(1);
}

/* Staggered animation delays */
.fade-in-delay-1 {
    transition-delay: 0.1s;
}

.fade-in-delay-2 {
    transition-delay: 0.2s;
}

.fade-in-delay-3 {
    transition-delay: 0.3s;
}

.fade-in-delay-4 {
    transition-delay: 0.4s;
}

.fade-in-delay-5 {
    transition-delay: 0.5s;
}

/* Enhanced form animations */
.contact form .box {
    transition: all 0.3s ease;
}

.contact form .box.animated {
    animation: formFieldFadeIn 0.5s ease-out forwards;
}

@keyframes formFieldFadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading state */
.contact,
.map-section {
    opacity: 0;
    transition: opacity 0.5s ease-out;
}

.contact.loaded,
.map-section.loaded {
    opacity: 1;
}

/* Enhanced info item animations */
.contact-info .info-item {
    position: relative;
    overflow: hidden;
}

.contact-info .info-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.6s;
}

.contact-info .info-item:hover::before {
    left: 100%;
}

/* Map container enhanced animation */
.map-container {
    position: relative;
    overflow: hidden;
}

.map-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--white);
    z-index: 1;
    transform: scaleX(1);
    transform-origin: left;
    transition: transform 1s ease-out;
}

.map-container.loaded::before {
    transform: scaleX(0);
}

/* Form submission feedback */
.form-message {
    padding: 1rem;
    margin: 1rem 0;
    border-radius: 0.5rem;
    text-align: center;
    font-size: 1.4rem;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.form-message.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.form-message.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.form-message.show {
    opacity: 1;
    transform: translateY(0);
}
</style>
</head>
<body>
   
<?php @include 'header2.php'; ?>

<section class="heading fade-in">
    <h3>contact us</h3>
</section>

<section class="contact" id="contact">
      <div class="contact-container">
         <div class="contact-info fade-in-left">
            <div class="info-item fade-in-delay-1">
               <i class="fas fa-map-marker-alt"></i>
               <div>
                  <h3>Our Location</h3>
                  <p>Satwai Road, Nipani - 591237</p>
               </div>
            </div>
            
            <div class="info-item fade-in-delay-2">
               <i class="fas fa-envelope"></i>
               <div>
                  <h3>Email Us</h3>
                  <p>info@happycakes.com</p>
               </div>
            </div>
            
            <div class="info-item fade-in-delay-3">
               <i class="fas fa-phone"></i>
               <div>
                  <h3>Call Us</h3>
                  <p>+91 7947430239</p>
               </div>
            </div>
            
            <div class="info-item fade-in-delay-4">
               <i class="fas fa-clock"></i>
               <div>
                  <h3>Opening Hours</h3>
                  <p>Monday - Saturday: 9:00 AM - 8:00 PM</p>
                  <p>Sunday: 10:00 AM - 6:00 PM</p>
               </div>
            </div>
         </div>

         <form action="" method="post" class="fade-in-right fade-in-delay-2">
            <h3>Get in Touch</h3>
            <div id="form-message" class="form-message"></div>
            <input type="text" name="name" placeholder="Your Name" class="box" required>
            <input type="email" name="email" placeholder="Your Email" class="box" required>
            <input type="tel" name="number" placeholder="Your Phone" class="box">
            <textarea name="message" class="box" placeholder="Your Message" required></textarea>
            <input type="submit" value="Send Message" class="btn" name="send">
         </form>
      </div>
</section>

<!-- Enhanced Google Maps Section -->
<section class="map-section">
   <h3 class="fade-in">Find Us on the Map</h3>
   <div class="map-container fade-in-scale fade-in-delay-3">
      <iframe 
         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3827.474280948952!2d74.3805555!3d16.4007217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc0f36622dad70f%3A0x7085ab16559588d3!2sHappy%20Cakes!5e0!3m2!1sen!2sin!4v1747467747517!5m2!1sen!2sin"
         allowfullscreen="" 
         loading="lazy" 
         referrerpolicy="no-referrer-when-downgrade"
         title="Happy Cakes Location Map">
      </iframe>
   </div>
</section>

<!-- Footer -->
<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

<script>
// Enhanced animation script with form handling
document.addEventListener('DOMContentLoaded', function() {
    // Add loaded class to sections
    const contactSection = document.querySelector('.contact');
    const mapSection = document.querySelector('.map-section');
    
    if (contactSection) {
        contactSection.classList.add('loaded');
    }
    
    if (mapSection) {
        mapSection.classList.add('loaded');
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
                
                // Special handling for map container
                if (entry.target.classList.contains('map-container')) {
                    setTimeout(() => {
                        entry.target.classList.add('loaded');
                    }, 500);
                }
                
                // Unobserve once animated to improve performance
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all elements with animation classes
    const animatedElements = document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right, .fade-in-scale');
    animatedElements.forEach(el => {
        observer.observe(el);
    });

    // Fallback for older browsers
    if (!window.IntersectionObserver) {
        animatedElements.forEach(el => {
            el.classList.add('visible');
        });
        if (mapSection) {
            mapSection.querySelector('.map-container').classList.add('loaded');
        }
    }

    // Enhanced form handling
    const form = document.querySelector('.contact form');
    const formMessage = document.getElementById('form-message');
    const formFields = form.querySelectorAll('.box');
    
    // Animate form fields on focus
    formFields.forEach(field => {
        field.addEventListener('focus', function() {
            this.classList.add('animated');
        });
        
        // Add subtle animation when typing
        field.addEventListener('input', function() {
            this.style.transform = 'scale(1.02)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });

    // Form submission with feedback
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('.btn');
        const originalText = submitBtn.value;
        
        // Add loading state
        submitBtn.value = 'Sending...';
        submitBtn.style.opacity = '0.7';
        submitBtn.disabled = true;
        
        // Simulate form processing (since we're using PHP for actual submission)
        setTimeout(() => {
            submitBtn.value = originalText;
            submitBtn.style.opacity = '1';
            submitBtn.disabled = false;
            
            // Show success message (you can modify this based on actual PHP response)
            showFormMessage('Thank you for your message! We\'ll get back to you soon.', 'success');
        }, 1000);
    });

    function showFormMessage(message, type) {
        formMessage.textContent = message;
        formMessage.className = `form-message ${type}`;
        formMessage.classList.add('show');
        
        setTimeout(() => {
            formMessage.classList.remove('show');
        }, 5000);
    }

    // Smooth scrolling for anchor links
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

    // Add subtle parallax effect to info items
    let ticking = false;
    
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const infoItems = document.querySelectorAll('.contact-info .info-item');
        
        infoItems.forEach((item, index) => {
            const rate = scrolled * -0.1 * (index + 1);
            item.style.transform = `translateY(${rate * 0.1}px)`;
        });
        
        ticking = false;
    }
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    });

    // Enhanced hover effects for contact info items
    const infoItems = document.querySelectorAll('.contact-info .info-item');
    infoItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});

// PHP form submission feedback integration
<?php if(isset($_POST['send'])): ?>
document.addEventListener('DOMContentLoaded', function() {
    const formMessage = document.getElementById('form-message');
    formMessage.textContent = 'Thank you for your message! We\'ll get back to you soon.';
    formMessage.className = 'form-message success show';
    
    setTimeout(() => {
        formMessage.classList.remove('show');
    }, 5000);
});
<?php endif; ?>
</script>

</body>
</html>