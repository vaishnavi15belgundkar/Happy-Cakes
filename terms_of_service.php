<?php

@include 'config.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:login.php');
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Terms of Service - Happy Cakes</title>
   <link rel="stylesheet" href="css/style.css">
   <style>
      .terms-of-service {
         max-width: 1200px;
         margin: 0 auto;
         padding: 2rem;
         background-color: var(--white);
         border-radius: 0.5rem;
         box-shadow: var(--box-shadow);
      }
      
      .terms-of-service h2 {
         font-size: 40px ;
         color: var(--pink);
         margin-bottom: 1.5rem;
         border-bottom: 0.1rem solid var(--light-bg);
         padding-bottom: 1rem;
         text-align: center;
      }
      
      .terms-of-service h3 {
         font-size: 2.2rem;
         color: var(--black);
         margin: 2rem 0 1rem 0;
         padding-left: 1rem;
         border-left: 0.4rem solid var(--pink);
      }
      
      .terms-of-service p {
         font-size: 1.6rem;
         color: var(--light-color);
         line-height: 1.8;
         margin-bottom: 1.5rem;
      }
      
      .terms-of-service ul {
         padding-left: 2rem;
         margin-bottom: 1.5rem;
      }
      
      .terms-of-service ul li {
         font-size: 1.6rem;
         color: var(--light-color);
         line-height: 1.8;
         margin-bottom: 0.8rem;
      }
      
      .terms-of-service .last-updated {
         font-size: 1.4rem;
         color: var(--light-color);
         margin-top: 1rem;
         margin-bottom: 2rem;
         font-style: italic;
         text-align: right;
      }
      
      .terms-section {
         margin-bottom: 3rem;
         padding: 1.5rem;
         border-radius: 0.5rem;
         transition: all 0.3s ease;
      }
      
      .terms-section:hover {
         background-color: var(--light-bg);
         transform: translateY(-5px);
         box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }
      
      .terms-section h3 {
         display: flex;
         align-items: center;
      }
      
      .terms-section h3:before {
         content: "§";
         margin-right: 1rem;
         color: var(--pink);
         font-size: 2.4rem;
      }
      
      .highlight {
         color: var(--pink);
         font-weight: bold;
      }
      
      .terms-intro {
         background-color: rgba(232, 67, 147, 0.1);
         padding: 2rem;
         border-radius: 0.5rem;
         margin-bottom: 2rem;
      }
      
      .contact-info {
         background-color: var(--light-bg);
         padding: 1.5rem;
         border-radius: 0.5rem;
         margin-top: 2rem;
      }
      
      .acceptance-notice {
         font-weight: bold;
         font-size: 1.7rem;
         text-align: center;
         padding: 1.5rem;
         margin: 2rem 0;
         border: 0.1rem dashed var(--pink);
         border-radius: 0.5rem;
      }

      /* Enhanced Animation Styles */
      .fade-in {
          opacity: 0;
          transform: translateY(30px);
          transition: opacity 0.8s ease-out, transform 0.8s ease-out;
      }

      .fade-in.visible {
          opacity: 1;
          transform: translateY(0);
      }

      .fade-in-left {
          opacity: 0;
          transform: translateX(-50px);
          transition: opacity 0.8s ease-out, transform 0.8s ease-out;
      }

      .fade-in-left.visible {
          opacity: 1;
          transform: translateX(0);
      }

      .fade-in-right {
          opacity: 0;
          transform: translateX(50px);
          transition: opacity 0.8s ease-out, transform 0.8s ease-out;
      }

      .fade-in-right.visible {
          opacity: 1;
          transform: translateX(0);
      }

      .fade-in-scale {
          opacity: 0;
          transform: scale(0.9);
          transition: opacity 0.8s ease-out, transform 0.8s ease-out;
      }

      .fade-in-scale.visible {
          opacity: 1;
          transform: scale(1);
      }

      /* Staggered animation delays */
      .fade-in-delay-1 { transition-delay: 0.1s; }
      .fade-in-delay-2 { transition-delay: 0.2s; }
      .fade-in-delay-3 { transition-delay: 0.3s; }
      .fade-in-delay-4 { transition-delay: 0.4s; }
      .fade-in-delay-5 { transition-delay: 0.5s; }

      /* Loading state for smooth page appearance */
      .terms-of-service {
          opacity: 0;
          transition: opacity 0.5s ease-out;
      }

      .terms-of-service.loaded {
          opacity: 1;
      }

      /* Enhanced section animations */
      .terms-section {
          position: relative;
          overflow: hidden;
      }

      .terms-section::before {
          content: '';
          position: absolute;
          top: 0;
          left: -100%;
          width: 100%;
          height: 2px;
          background: linear-gradient(90deg, transparent, var(--pink), transparent);
          transition: left 0.6s ease-out;
      }

      .terms-section.visible::before {
          left: 100%;
      }

      /* Progressive text reveal animation */
      .animate-text {
          opacity: 0;
          transform: translateY(10px);
          transition: opacity 0.4s ease-out, transform 0.4s ease-out;
      }

      .animate-text.visible {
          opacity: 1;
          transform: translateY(0);
      }

      /* List items animation */
      .terms-section ul li {
          opacity: 0;
          transform: translateX(-20px);
          transition: opacity 0.3s ease-out, transform 0.3s ease-out;
      }

      .terms-section.visible ul li {
          opacity: 1;
          transform: translateX(0);
      }

      .terms-section ul li:nth-child(1) { transition-delay: 0.1s; }
      .terms-section ul li:nth-child(2) { transition-delay: 0.2s; }
      .terms-section ul li:nth-child(3) { transition-delay: 0.3s; }
      .terms-section ul li:nth-child(4) { transition-delay: 0.4s; }
      .terms-section ul li:nth-child(5) { transition-delay: 0.5s; }
      .terms-section ul li:nth-child(6) { transition-delay: 0.6s; }
      .terms-section ul li:nth-child(7) { transition-delay: 0.7s; }

      /* Header enhanced animation */
      .terms-of-service h2 {
          position: relative;
          overflow: hidden;
      }

      .terms-of-service h2::after {
          content: '';
          position: absolute;
          bottom: 0;
          left: -100%;
          width: 100%;
          height: 2px;
          background: var(--pink);
          transition: left 1s ease-out;
      }

      .terms-of-service h2.visible::after {
          left: 0;
      }

      /* Acceptance notice enhanced animation */
      .acceptance-notice {
          position: relative;
          overflow: hidden;
      }

      .acceptance-notice::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: linear-gradient(45deg, transparent 48%, rgba(232, 67, 147, 0.1) 50%, transparent 52%);
          transform: translateX(-100%);
          transition: transform 0.8s ease-out;
      }

      .acceptance-notice.visible::before {
          transform: translateX(100%);
      }

      /* Reading progress indicator */
      .reading-progress {
          position: fixed;
          top: 0;
          left: 0;
          width: 0%;
          height: 4px;
          background: linear-gradient(90deg, var(--pink), #ff6b9d);
          z-index: 1000;
          transition: width 0.1s ease-out;
      }

      /* Section numbering enhanced animation */
      .terms-section h3::before {
          opacity: 0;
          transform: scale(0.5) rotate(-180deg);
          transition: opacity 0.5s ease-out, transform 0.5s ease-out;
      }

      .terms-section.visible h3::before {
          opacity: 1;
          transform: scale(1) rotate(0deg);
      }

      /* Contact info special animation */
      .contact-info {
          position: relative;
          overflow: hidden;
      }

      .contact-info::after {
          content: '';
          position: absolute;
          top: -50%;
          left: -50%;
          width: 200%;
          height: 200%;
          background: radial-gradient(circle, rgba(232, 67, 147, 0.1) 0%, transparent 70%);
          transform: scale(0);
          transition: transform 0.8s ease-out;
      }

      .contact-info.visible::after {
          transform: scale(1);
      }

      .contact-info > * {
          position: relative;
          z-index: 1;
      }

      /* Responsive adjustments */
      @media (max-width: 768px) {
          .fade-in,
          .fade-in-left,
          .fade-in-right {
              transform: translateY(20px);
          }

          .fade-in-left.visible,
          .fade-in-right.visible {
              transform: translateY(0);
          }
      }

      /* Reduced motion support */
      @media (prefers-reduced-motion: reduce) {
          .fade-in,
          .fade-in-left,
          .fade-in-right,
          .fade-in-scale,
          .animate-text,
          .terms-section ul li,
          .terms-section::before,
          .terms-of-service h2::after,
          .acceptance-notice::before,
          .contact-info::after {
              transition: none;
          }
          
          .fade-in,
          .fade-in-left,
          .fade-in-right,
          .fade-in-scale {
              opacity: 1;
              transform: none;
          }
      }
   </style>
</head>
<body>
   
<?php @include 'header.php'; ?>

<!-- Reading progress indicator -->
<div class="reading-progress"></div>

<!-- <section class="heading">
    <h3>terms of service</h3>
</section> -->

<section class="terms-of-service">
   <div class="last-updated fade-in-right">Last Updated: May 13, 2025</div>
   
   <h2 class="fade-in">Terms of Service</h2>
   
   <div class="terms-intro fade-in-scale fade-in-delay-1">
      <p class="animate-text">Welcome to Happy Cakes! These Terms of Service ("Terms") govern your use of the Happy Cakes website and services. By accessing our website or using our services, you agree to be bound by these Terms. Please read them carefully.</p>
      
      <div class="acceptance-notice fade-in-delay-2">
         By using our website or services, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.
      </div>
   </div>
   
   <div class="terms-section fade-in-left">
      <h3>1. Acceptance of Terms</h3>
      <p class="animate-text">By accessing or using the Happy Cakes website, placing orders, or creating an account, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any part of these terms, you must not use our website or services.</p>
   </div>
   
   <div class="terms-section fade-in-right">
      <h3>2. Account Responsibilities</h3>
      <p class="animate-text">When you create an account with Happy Cakes, you are responsible for:</p>
      <ul>
         <li>Maintaining the confidentiality of your account credentials</li>
         <li>Restricting access to your account</li>
         <li>Assuming responsibility for all activities that occur under your account</li>
         <li>Ensuring that all information you provide is accurate, current, and complete</li>
      </ul>
      <p class="animate-text">We reserve the right to refuse service, terminate accounts, or cancel orders at our sole discretion if we suspect any violations of these terms.</p>
   </div>
   
   <div class="terms-section fade-in-left">
      <h3>3. Ordering and Payment</h3>
      <p class="animate-text">When placing an order with Happy Cakes:</p>
      <ul>
         <li>You agree to provide current, complete, and accurate purchase information for all orders</li>
         <li>You agree to promptly update your account information, including email address and payment details, to ensure we can complete your transactions and contact you as needed</li>
         <li>We reserve the right to refuse or cancel any order for any reason, including errors in product information or pricing</li>
         <li>Payment must be received in full before your order is processed</li>
      </ul>
      <p class="animate-text">All prices are subject to change without notice. We reserve the right to discontinue any products or services at any time.</p>
   </div>
   
   <div class="terms-section fade-in-right">
      <h3>4. Prohibited Activities</h3>
      <p class="animate-text">You agree not to engage in any of the following prohibited activities:</p>
      <ul>
         <li>Using the website for any illegal purpose or in violation of any local, state, national, or international law</li>
         <li>Copying, distributing, or disclosing any part of the website in any medium</li>
         <li>Attempting to interfere with, compromise the system integrity or security, or decipher any transmissions to or from the servers running the website</li>
         <li>Using the website in a manner that could damage, disable, overburden, or impair any server, or interfere with any other party's use of the website</li>
         <li>Uploading invalid data, viruses, worms, or other software agents through the website</li>
         <li>Impersonating another person or otherwise misrepresenting your affiliation with a person or entity</li>
         <li>Harassing, threatening, or intimidating any other users of the website</li>
      </ul>
   </div>
   
   <div class="terms-section fade-in-left">
      <h3>5. Intellectual Property</h3>
      <p class="animate-text">The Happy Cakes website and its original content, features, and functionality are owned by Happy Cakes and are protected by international copyright, trademark, patent, trade secret, and other intellectual property laws.</p>
      <p class="animate-text">Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Happy Cakes.</p>
   </div>
   
   <div class="terms-section fade-in-right">
      <h3>6. User Content</h3>
      <p class="animate-text">By posting, uploading, or submitting any content to our website (such as reviews, comments, or images), you grant Happy Cakes a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, publish, distribute, and display such content in connection with our services.</p>
      <p class="animate-text">You represent and warrant that you own or have the necessary rights to the content you submit and that the content does not violate the privacy rights, publicity rights, intellectual property rights, or any other rights of any person or entity.</p>
   </div>
   
   <div class="terms-section fade-in-left">
      <h3>7. Disclaimer of Warranties</h3>
      <p class="animate-text">The website and services are provided on an "as is" and "as available" basis without warranties of any kind, either express or implied, including but not limited to warranties of merchantability, fitness for a particular purpose, non-infringement, or course of performance.</p>
      <p class="animate-text">Happy Cakes does not warrant that:</p>
      <ul>
         <li>The website will function uninterrupted, secure, or available at any particular time or location</li>
         <li>Any errors or defects will be corrected</li>
         <li>The website is free of viruses or other harmful components</li>
         <li>The results of using the website will meet your requirements</li>
      </ul>
   </div>
   
   <div class="terms-section fade-in-right">
      <h3>8. Limitation of Liability</h3>
      <p class="animate-text">In no event shall Happy Cakes, its directors, employees, partners, agents, suppliers, or affiliates be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from:</p>
      <ul>
         <li>Your access to or use of or inability to access or use the website or services</li>
         <li>Any conduct or content of any third party on the website</li>
         <li>Any content obtained from the website</li>
         <li>Unauthorized access, use, or alteration of your transmissions or content</li>
      </ul>
      <p class="animate-text">Our total liability for all claims arising from or related to the services shall not exceed the amount you paid to Happy Cakes in the past six months.</p>
   </div>
   
   <div class="terms-section fade-in-left">
      <h3>9. Indemnification</h3>
      <p class="animate-text">You agree to defend, indemnify, and hold harmless Happy Cakes, its directors, employees, partners, agents, suppliers, and affiliates from and against any claims, liabilities, damages, losses, and expenses, including without limitation reasonable attorney's fees and costs, arising out of or in any way connected with:</p>
      <ul>
         <li>Your access to or use of the website or services</li>
         <li>Your violation of these Terms of Service</li>
         <li>Your violation of any third-party rights, including without limitation any copyright, property, or privacy right</li>
      </ul>
   </div>
   
   <div class="terms-section fade-in-right">
      <h3>10. Account Termination</h3>
      <p class="animate-text">We may terminate or suspend your account and access to our services immediately, without prior notice or liability, for any reason whatsoever, including, without limitation, if you breach the Terms.</p>
      <p class="animate-text">Upon termination, your right to use the website and services will immediately cease. If you wish to terminate your account, you may simply discontinue using the website, or contact us to request account deletion.</p>
   </div>
   
   <div class="terms-section fade-in-left">
      <h3>11. Governing Law</h3>
      <p class="animate-text">These Terms shall be governed and construed in accordance with the laws of the United Kingdom, without regard to its conflict of law provisions.</p>
      <p class="animate-text">Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect.</p>
   </div>
   
   <div class="terms-section fade-in-right">
      <h3>12. Changes to Terms</h3>
      <p class="animate-text">We reserve the right to modify or replace these Terms at any time at our sole discretion. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
      <p class="animate-text">By continuing to access or use our website after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, you must stop using the website and services.</p>
   </div>
   
   <div class="terms-section fade-in-left">
      <h3>13. Entire Agreement</h3>
      <p class="animate-text">These Terms constitute the entire agreement between you and Happy Cakes regarding the use of the website and services, superseding any prior agreements between you and Happy Cakes (including, but not limited to, any prior versions of the Terms of Service).</p>
   </div>
   
   <div class="contact-info fade-in-scale">
      <h3>14. Contact Information</h3>
      <p class="animate-text">If you have any questions about these Terms, please contact us at:</p>
      <p class="animate-text">
         Happy Cakes Bakery<br>
         123 Sweet Street<br>
         Bakery Town, BT1 2CD<br>
         Email: <span class="highlight">legal@happycakes.com</span><br>
         Phone: (555) 123-4567
      </p>
   </div>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

<script>
// Enhanced Terms of Service animation script
document.addEventListener('DOMContentLoaded', function() {
    // Add loaded class to main section
    const termsSection = document.querySelector('.terms-of-service');
    if (termsSection) {
        termsSection.classList.add('loaded');
    }

    // Create and manage reading progress indicator
    const progressBar = document.querySelector('.reading-progress');
    function updateReadingProgress() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        progressBar.style.width = scrollPercent + '%';
    }

    // Intersection Observer for performance-optimized animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                
                // Animate nested text elements with delay
                if (entry.target.classList.contains('terms-section')) {
                    const textElements = entry.target.querySelectorAll('.animate-text');
                    textElements.forEach((el, index) => {
                        setTimeout(() => {
                            el.classList.add('visible');
                        }, index * 150);
                    });
                }
                
                // Unobserve once animated for better performance
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all elements with animation classes
    const animatedElements = document.querySelectorAll(
        '.fade-in, .fade-in-left, .fade-in-right, .fade-in-scale, .terms-section, .acceptance-notice, .contact-info'
    );
    
    animatedElements.forEach(el => {
        observer.observe(el);
    });

    // Fallback for browsers without Intersection Observer
    if (!window.IntersectionObserver) {
        animatedElements.forEach(el => {
            el.classList.add('visible');
            const textElements = el.querySelectorAll('.animate-text');
            textElements.forEach(textEl => {
                textEl.classList.add('visible');
            });
        });
    }

    // Enhanced scroll effects
    let ticking = false;
    
    function updateScrollEffects() {
        updateReadingProgress();
        
        // Subtle parallax effect for sections
        const scrolled = window.pageYOffset;
        const termsSections = document.querySelectorAll('.terms-section');
        
        termsSections.forEach((section, index) => {
            const rate = scrolled * -0.1;
            const yPos = -(rate / (index + 1));
            section.style.transform = `translateY(${yPos}px)`;
        });
        
        ticking = false;
    }
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateScrollEffects);
            ticking = true;
        }
    });

    // Enhanced section hover effects
    const termsSections = document.querySelectorAll('.terms-section');
    termsSections.forEach(section => {
        section.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.01)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
        });
        
        section.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '';
        });
    });

    // Smooth scrolling for any anchor links within the page
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

    // Add typing effect to acceptance notice (optional)
    const acceptanceNotice = document.querySelector('.acceptance-notice');
    if (acceptanceNotice) {
        const originalText = acceptanceNotice.textContent;
        acceptanceNotice.textContent = '';
        
        setTimeout(() => {
            let i = 0;
            const typeWriter = () => {
                if (i < originalText.length) {
                    acceptanceNotice.textContent += originalText.charAt(i);
                    i++;
                    setTimeout(typeWriter, 20);
                }
            };
            typeWriter();
        }, 1000);
    }

    // Initialize reading progress
    updateReadingProgress();

    // Add section numbering animation completion effect
    const sectionHeaders = document.querySelectorAll('.terms-section h3');
    sectionHeaders.forEach(header => {
        header.addEventListener('animationend', function() {
            this.style.borderLeftColor = 'var(--pink)';
            this.style.borderLeftWidth = '0.6rem';
        });
    });

    // Improved accessibility: Add focus states for keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.style.outline = '2px solid var(--pink)';
        }
    });

    document.addEventListener('click', function() {
        document.body.style.outline = 'none';
    });
});

// Additional utility functions for enhanced UX
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Add a "back to top" functionality (can be triggered by a button)
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const backToTopBtn = document.querySelector('.back-to-top');
    
    if (backToTopBtn) {
        if (scrolled > 500) {
            backToTopBtn.style.opacity = '1';
            backToTopBtn.style.pointerEvents = 'auto';
        } else {
            backToTopBtn.style.opacity = '0';
            backToTopBtn.style.pointerEvents = 'none';
        }
    }
});
</script>

</body>
</html>