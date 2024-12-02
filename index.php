<?php
session_start();
$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim user inputs
    $name = trim($_POST['name']);
    $organization = trim($_POST['organization']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $remark = trim($_POST['remark']);

    // Validate the 'name' field
    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    }

    // Validate the 'organization' field
    if (empty($organization)) {
        $errors['organization'] = 'Organization name is required.';
    }

    // Validate the 'contact' field
    if (empty($contact)) {
        $errors['contact'] = 'Contact number is required.';
    } elseif (!preg_match('/^\d{10}$/', $contact)) {
        $errors['contact'] = 'Invalid phone number. It should be a 10-digit number.';
    }

    // Validate the 'email' field
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    // Check if there are no errors
    if (empty($errors)) {
        // Set a success message in the session
        $_SESSION['successMessage'] = 'Form submitted successfully!';

        // Redirect back to the form to prevent resubmission
        header('Location: index.php');
        exit;
    }
}

// Display success message if set
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    // Clear the success message after displaying
    unset($_SESSION['successMessage']); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laser Technologies</title>
    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Captcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
    <!-- Header Section -->
    <header class="d-flex justify-content-between align-items-center p-4">
        <img src="laser2.png" alt="Laser Technologies" class="logo">
        <nav>
            <a href="#" class="logo1">Home / Contact</a>
        </nav>
    </header>

    <!-- Contact Section -->
    <section class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <div class="get-in-touch">
                    <h2>Get in touch</h2>
                    <p>Need our expertise for choosing your next laser machine?</p>
                </div>
            </div>
            <div class="col-md-6">
                <form action="index.php" method="post">
                    <h5>Fill out the form to get a free consultation.</h5>
                    <div class="form-grid">
                        <!-- Name Field -->
                        <input type="text" name="name" placeholder="Your Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        <?php if (isset($errors['name'])): ?>
                            <div class="error-message"><?php echo $errors['name']; ?></div>
                        <?php endif; ?>

                        <!-- Organization Field -->
                        <input type="text" name="organization" placeholder="Organisation Name" value="<?php echo isset($_POST['organization']) ? htmlspecialchars($_POST['organization']) : ''; ?>">
                        <?php if (isset($errors['organization'])): ?>
                            <div class="error-message"><?php echo $errors['organization']; ?></div>
                        <?php endif; ?>

                        <!-- Contact Field -->
                        <input type="tel" name="contact" placeholder="Contact Number" value="<?php echo isset($_POST['contact']) ? htmlspecialchars($_POST['contact']) : ''; ?>">
                        <?php if (isset($errors['contact'])): ?>
                            <div class="error-message"><?php echo $errors['contact']; ?></div>
                        <?php endif; ?>

                        <!-- Email Field -->
                        <input type="email" name="email" placeholder="Email ID" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <?php if (isset($errors['email'])): ?>
                            <div class="error-message"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>

                        <!-- Remark Field -->
                        <textarea name="remark" placeholder="Remark" rows="2"><?php echo isset($_POST['remark']) ? htmlspecialchars($_POST['remark']) : ''; ?></textarea>
                        <?php if (isset($errors['remark'])): ?>
                            <div class="error-message"><?php echo $errors['remark']; ?></div>
                        <?php endif; ?>

                        <!-- Captcha -->
                        <div class="g-recaptcha" data-sitekey="6LeGco8qAAAAAAvnseVT5lvR84dsI6iDW4CGPKlj"></div>

                        <!-- Submit Button -->
                        <button type="submit" class="button1">Submit</button>
                    </div>
                </form>
                <?php if (!empty($successMessage)): ?>
    <div id="successMessage" class="success-message"><?php echo $successMessage; ?></div>
<?php endif; ?>

        </div>
    </div>
</section>

<!-- JavaScript for Clearing Form and Hiding Success Message -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            // Hide the success message after 5 seconds
            console.log("Success message found. It will be hidden in 5 seconds.");
            setTimeout(() => {
                successMessage.style.display = 'none'; // Hide the message
                console.log("Success message hidden.");
                document.getElementById('contactForm').reset(); // Clear the form
                console.log("Form reset.");
            }, 5000);
        } else {
            console.log("No success message found.");
        }
    });
</script>



            </div>
        </div>
    </section>

    <script>
        window.onload = function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            }
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    

    <!-- Map Section -->
    <section class="map-section py-5">
        <div class="container-fluid px-0">
            <div class="map-container">
                <!-- Map Widget -->
                <div class="map-widget">
                    <h3>Headquarters Office</h3>
                    <p>
                        Laser Technologies Pvt Ltd<br>
                        ------------------------<br>
                        PAP/R/406 Rabale MIDC Near Dol Electric Company
                        Navi Mumbai - 400701<br>
                        Landline: 022 4131 0099<br>
                        <a href="https://maps.app.goo.gl/hdydYjbXfML6aufx8" target="_blank">Google Map Link</a>
                    </p>
                </div>
                <!-- Embedded Google Map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.1844443454993!2d73.0044388749315!3d19.
                143401949853693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7bfeb4288ae8d%3A0x8b330290504e58fa!2sLaser
                %20Technologies%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1733045934437!5m2!1sen!2sin" 
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>


    <!-- Locations Section -->
    <div class="location-container">
        <div class="location-row">
            <div class="location">
                <h4>Mumbai</h4>
                <p>PAP/R/406 Rabale MIDC</p>
                <p>Near Dol Electric Company</p>
                <p>Rabale MIDC, Navi Mumbai - 400701</p>
            </div>
    
            <div class="location">
                <h4>Pune</h4>
                <p>"S" Block, Plot No.186 <br>
                MIDC, Bhosari, <br>
                Pune - 411026</p>
            </div>
    
            <div class="location">
                <h4>GUJRAT</h4>
                <p>A-5, GF, Barcelona Multiple</p>
                <p>Business Campus, Odhav Ring</p>
                <p>Road Circle, Ahmedabad,</p>
                <p>Gujarat - 382430</p>
            </div>
        </div>
    
        <div class="location-row">
            <div class="location">
                <h4>DELHI</h4>
                <p>S-98 Second Floor</p>
                <p>Phase-2, Okhla Industrial</p>
                <p>Area, New Delhi - 110020</p>
            </div>
    
            <div class="location">
                <h4>KARNATAKA</h4>
                <p>77/78/B, Janapriya Commercial</p>
                <p>Complex, Magadi Main Rd.</p>
                <p>Sunkadakatte, Bengaluru,</p>
                <p>Karnataka - 560091</p>
            </div>
        </div>
    </div>
    <!--Help center-->
    <section class="help-section">
        <h2 >How can we help?</h2>
        <div class="help-buttons">
          <button class="btn">
            <i class="fa fa-calendar"></i>
            <img src="s1.png">
            <span>Schedule a </span>
            <h5 class="help-bold">Demo</h5>
          </button>
          <button class="btn">
            <i class="fa fa-file"></i>
            <img src="s2.png">
            <span>Request a </span>
            <h5 class="help-bold">Quote</h5>
          </button>
          <button class="btn">
            <i class="fa fa-film"></i>
            <img src="s3.png">
            <span>Send us a </span>
            <h5 class="help-bold">Sample</h5>
          </button>
          <button class="btn">
            <i class="fa fa-headphones"></i>
            <img src="s4.png">
            <span>Raise your</span>
            <h5 class="help-bold">Query</h5>
          </button>
        </div>
      </section>


    <!-- Newsletter -->
    <section class="newsletter text-center" >
        <div class="newsletter-section">
            <p>Subscribe To Our Newsletter & Stay Updated</p>
            <div class="input-group">
              <input type="email" class="form-control" placeholder="Your Email">
              <button type="button" class="btn btn-primary">SUBSCRIBE</button>
            </div>
          </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <img src="f2.png" alt="Laser Tech" class="small-img">
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
