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
   </style>
</head>
<body>
   
<?php @include 'header.php'; ?>

<!-- <section class="heading">
    <h3>terms of service</h3>
</section> -->

<section class="terms-of-service">
   <div class="last-updated">Last Updated: May 13, 2025</div>
   
   <h2>Terms of Service</h2>
   
   <div class="terms-intro">
      <p>Welcome to Happy Cakes! These Terms of Service ("Terms") govern your use of the Happy Cakes website and services. By accessing our website or using our services, you agree to be bound by these Terms. Please read them carefully.</p>
      
      <div class="acceptance-notice">
         By using our website or services, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.
      </div>
   </div>
   
   <div class="terms-section">
      <h3>1. Acceptance of Terms</h3>
      <p>By accessing or using the Happy Cakes website, placing orders, or creating an account, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any part of these terms, you must not use our website or services.</p>
   </div>
   
   <div class="terms-section">
      <h3>2. Account Responsibilities</h3>
      <p>When you create an account with Happy Cakes, you are responsible for:</p>
      <ul>
         <li>Maintaining the confidentiality of your account credentials</li>
         <li>Restricting access to your account</li>
         <li>Assuming responsibility for all activities that occur under your account</li>
         <li>Ensuring that all information you provide is accurate, current, and complete</li>
      </ul>
      <p>We reserve the right to refuse service, terminate accounts, or cancel orders at our sole discretion if we suspect any violations of these terms.</p>
   </div>
   
   <div class="terms-section">
      <h3>3. Ordering and Payment</h3>
      <p>When placing an order with Happy Cakes:</p>
      <ul>
         <li>You agree to provide current, complete, and accurate purchase information for all orders</li>
         <li>You agree to promptly update your account information, including email address and payment details, to ensure we can complete your transactions and contact you as needed</li>
         <li>We reserve the right to refuse or cancel any order for any reason, including errors in product information or pricing</li>
         <li>Payment must be received in full before your order is processed</li>
      </ul>
      <p>All prices are subject to change without notice. We reserve the right to discontinue any products or services at any time.</p>
   </div>
   
   <div class="terms-section">
      <h3>4. Prohibited Activities</h3>
      <p>You agree not to engage in any of the following prohibited activities:</p>
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
   
   <div class="terms-section">
      <h3>5. Intellectual Property</h3>
      <p>The Happy Cakes website and its original content, features, and functionality are owned by Happy Cakes and are protected by international copyright, trademark, patent, trade secret, and other intellectual property laws.</p>
      <p>Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Happy Cakes.</p>
   </div>
   
   <div class="terms-section">
      <h3>6. User Content</h3>
      <p>By posting, uploading, or submitting any content to our website (such as reviews, comments, or images), you grant Happy Cakes a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, publish, distribute, and display such content in connection with our services.</p>
      <p>You represent and warrant that you own or have the necessary rights to the content you submit and that the content does not violate the privacy rights, publicity rights, intellectual property rights, or any other rights of any person or entity.</p>
   </div>
   
   <div class="terms-section">
      <h3>7. Disclaimer of Warranties</h3>
      <p>The website and services are provided on an "as is" and "as available" basis without warranties of any kind, either express or implied, including but not limited to warranties of merchantability, fitness for a particular purpose, non-infringement, or course of performance.</p>
      <p>Happy Cakes does not warrant that:</p>
      <ul>
         <li>The website will function uninterrupted, secure, or available at any particular time or location</li>
         <li>Any errors or defects will be corrected</li>
         <li>The website is free of viruses or other harmful components</li>
         <li>The results of using the website will meet your requirements</li>
      </ul>
   </div>
   
   <div class="terms-section">
      <h3>8. Limitation of Liability</h3>
      <p>In no event shall Happy Cakes, its directors, employees, partners, agents, suppliers, or affiliates be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from:</p>
      <ul>
         <li>Your access to or use of or inability to access or use the website or services</li>
         <li>Any conduct or content of any third party on the website</li>
         <li>Any content obtained from the website</li>
         <li>Unauthorized access, use, or alteration of your transmissions or content</li>
      </ul>
      <p>Our total liability for all claims arising from or related to the services shall not exceed the amount you paid to Happy Cakes in the past six months.</p>
   </div>
   
   <div class="terms-section">
      <h3>9. Indemnification</h3>
      <p>You agree to defend, indemnify, and hold harmless Happy Cakes, its directors, employees, partners, agents, suppliers, and affiliates from and against any claims, liabilities, damages, losses, and expenses, including without limitation reasonable attorney's fees and costs, arising out of or in any way connected with:</p>
      <ul>
         <li>Your access to or use of the website or services</li>
         <li>Your violation of these Terms of Service</li>
         <li>Your violation of any third-party rights, including without limitation any copyright, property, or privacy right</li>
      </ul>
   </div>
   
   <div class="terms-section">
      <h3>10. Account Termination</h3>
      <p>We may terminate or suspend your account and access to our services immediately, without prior notice or liability, for any reason whatsoever, including, without limitation, if you breach the Terms.</p>
      <p>Upon termination, your right to use the website and services will immediately cease. If you wish to terminate your account, you may simply discontinue using the website, or contact us to request account deletion.</p>
   </div>
   
   <div class="terms-section">
      <h3>11. Governing Law</h3>
      <p>These Terms shall be governed and construed in accordance with the laws of the United Kingdom, without regard to its conflict of law provisions.</p>
      <p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect.</p>
   </div>
   
   <div class="terms-section">
      <h3>12. Changes to Terms</h3>
      <p>We reserve the right to modify or replace these Terms at any time at our sole discretion. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
      <p>By continuing to access or use our website after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, you must stop using the website and services.</p>
   </div>
   
   <div class="terms-section">
      <h3>13. Entire Agreement</h3>
      <p>These Terms constitute the entire agreement between you and Happy Cakes regarding the use of the website and services, superseding any prior agreements between you and Happy Cakes (including, but not limited to, any prior versions of the Terms of Service).</p>
   </div>
   
   <div class="contact-info">
      <h3>14. Contact Information</h3>
      <p>If you have any questions about these Terms, please contact us at:</p>
      <p>
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

</body>
</html>