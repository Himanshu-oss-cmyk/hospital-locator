<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.html'); // Redirect to login page
    exit;
}

$userEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Button styling */
.login-btn {
    background-color: #ffffff;
    color: #3b82f6;
    padding: 10px 20px;
    border-radius: 8px;
    transition: background-color 0.3s, color 0.3s;
    border: 2px solid #3b82f6;
    display: inline-block;
    text-align: center;
}

.login-btn:hover {
    background-color: #3b82f6;
    color: #ffffff;
}

/* Navbar Button Positioning */
nav .flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav .ml-auto {
    margin-left: auto; /* Moves the logout button to the right */
}

        </style>
    <meta charset="utf-8">
    <title>Hospital Locator</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+91 7038253898</a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>hospitalLocator@gmail.com</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-body px-2" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body ps-2" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="index.html" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary" style="font-style: italic;"><i class="fa fa-clinic-medical me-2"></i>Hospital Locator</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="homepage.php" class="nav-item nav-link active">Home</a>
                        <a href="index.php" class="nav-item nav-link">Search Hospitals</a>
                        <a href="doctor.html" class="nav-item nav-link">Find  Doctors</a>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                        
                              
                            
                                <a href="appointment.html" class="dropdown-item">Appointment</a>
                            
                            </div>
                        </div>
                        <a href="blog.html" class="nav-item nav-link">Blogs</a>
                        <div class="flex space-x-4 items-center ml-auto">
    <span class="text-white"><?php echo htmlspecialchars($userEmail); ?></span> <!-- Display user email -->
    <a href="logout.php">
        <button class="login-btn">Logout</button>
    </a>
</div>

        <!-- Mobile Menu Button -->
    </div>
                        
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5" style="border-color: rgba(256, 256, 256, .3) !important;">Welcome to Hospital locator</h5>
                    <h1 class="display-1 text-white mb-md-4">Best Healthcare Solution In Your City</h1>
                    <div class="pt-2">
                        <a href="doctor.html" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">Find Doctor</a>
                        <a href="appointment.html" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="mb-4">
                        <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">About Us</h5>
                        <h1 class="display-4">Best Medical Care For Yourself and Your Family</h1>
                    </div>
  
        <p>
            Whether you're looking for a specific doctor, need to find a nearby hospital, or wish to book an appointment online, our website offers all the tools to assist you in making informed decisions about your health. We provide detailed information about each hospital and doctor to ensure that you can choose the best care options for your needs.
        </p>
        <p>
            Our goal is to make healthcare access simpler, more efficient, and more transparent. With just a few clicks, you can find the healthcare provider that suits you, and our appointment booking system ensures that you get the care you need when you need it. We're committed to providing you with a seamless experience for all your healthcare needs.</p>
                    <div class="row g-3 pt-3">
                        <div class="col-sm-3 col-6">
                            <div class="bg-light text-center rounded-circle py-4">
                                <i class="fa fa-3x fa-user-md text-primary mb-3"></i>
                                <h6 class="mb-0">Qualified<small class="d-block text-primary">Doctors</small></h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="bg-light text-center rounded-circle py-4">
                                <i class="fa fa-3x fa-procedures text-primary mb-3"></i>
                                <h6 class="mb-0">Emergency<small class="d-block text-primary">Services</small></h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="bg-light text-center rounded-circle py-4">
                                <i class="fa fa-3x fa-microscope text-primary mb-3"></i>
                                <h6 class="mb-0">Accurate<small class="d-block text-primary">Testing</small></h6>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    

    <!-- Appointment Start -->
    <div class="container-fluid bg-primary my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h5 class="d-inline-block text-white text-uppercase border-bottom border-5">Appointment</h5>
                        <h1 class="display-4">Make An Appointment For Your Family</h1>
                    </div>
                    <p class="text-white mb-5"><p class="text-white mb-5">
            We understand that your time is valuable, and booking an appointment with the right healthcare provider should be easy and hassle-free. Our appointment system allows you to book appointments with doctors and hospitals in just a few simple steps.
        </p>
           <p class="text-white mb-5">
            Whether you need to see a specialist, book a routine check-up, or seek urgent care, our platform connects you directly to a wide range of medical professionals and healthcare facilities across various locations. Simply select your preferred doctor or hospital, choose an available time slot, and you're all set!
             </p>
        </p>
                    <a  class="btn btn-dark rounded-pill py-3 px-5 me-3" href="appointment.html">Book Appointment</a>
                
                </div>
                <div class="col-lg-6">
                    <div class="bg-white text-center rounded p-5">
                        <h1 class="mb-4">Book An Appointment</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <select name=""class="form-select bg-light border-0" style="height: 55px;">
                                        <option selected>Choose Department</option>
                                        <option value="1">Department 1</option>
                                        <option value="2">Department 2</option>
                                        <option value="3">Department 3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;">
                                        <option selected>Select Doctor</option>
                                        <option value="1">Doctor 1</option>
                                        <option value="2">Doctor 2</option>
                                        <option value="3">Doctor 3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control bg-light border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control bg-light border-0 datetimepicker-input"
                                            placeholder="Date" data-target="#date" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="time" id="time" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control bg-light border-0 datetimepicker-input"
                                            placeholder="Time" data-target="#time" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Make An Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->


    <!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Blog Post</h5>
            <h1 class="display-4">Our Latest Medical Blog Posts</h1>
        </div>
        <div class="row g-5">
            <div class="col-xl-4 col-lg-6">
                <div class="bg-light rounded overflow-hidden">
                    <img class="img-fluid w-100" src="img/blog-1.jpg" alt="Cancer Awareness">
                    <div class="p-4">
                        <a class="h3 d-block mb-3" href="#">World Cancer Day 2023: New Insights on Cancer Treatments</a>
                        <p class="m-0">World Cancer Day highlighted advancements in cancer research. Experts discuss the latest breakthroughs and strategies to make cancer more preventable and treatable.</p>
                    </div>
                    <div class="d-flex justify-content-between border-top p-4">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle me-2" src="img/user.jpg" width="25" height="25" alt="">
                            <small>Dr. Anjali Sharma</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <small class="ms-3"><i class="far fa-eye text-primary me-1"></i>2567</small>
                            <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>45</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="bg-light rounded overflow-hidden">
                    <img class="img-fluid w-100" src="img/blog-2.jpg" alt="Heart Health">
                    <div class="p-4">
                        <a class="h3 d-block mb-3" href="#">Heart Disease Risks for Women: Beyond Breast Cancer</a>
                        <p class="m-0">New research reveals that heart disease poses a greater risk to women than breast cancer. Early detection and preventive care are key to saving lives.</p>
                    </div>
                    <div class="d-flex justify-content-between border-top p-4">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle me-2" src="img/user.jpg" width="25" height="25" alt="">
                            <small>Dr. Arun Patel</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <small class="ms-3"><i class="far fa-eye text-primary me-1"></i>1884</small>
                            <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>32</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="bg-light rounded overflow-hidden">
                    <img class="img-fluid w-100" src="img/blog-3.jpg" alt="Mental Health">
                    <div class="p-4">
                        <a class="h3 d-block mb-3" href="#">Managing Mental Health During the Pandemic</a>
                        <p class="m-0">As the pandemic continues to impact lives, mental health experts offer insights into coping strategies and the importance of seeking help for anxiety and depression.</p>
                    </div>
                    <div class="d-flex justify-content-between border-top p-4">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle me-2" src="img/user.jpg" width="25" height="25" alt="">
                            <small>Dr. Priya Mehta</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <small class="ms-3"><i class="far fa-eye text-primary me-1"></i>3152</small>
                            <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>59</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
                    <p class="mb-4">Feel free to reach out to us for any queries or assistance. Our team is ready to help you find the best healthcare solutions!</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Ramanand nagar,jalgaon </p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>hospitalLocator@gmail.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+91 7038257874</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="homepage.php"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="index.php"><i class="fa fa-angle-right me-2"></i>Search Hospitals</a>
                        <a class="text-light mb-2" href="doctor.html"><i class="fa fa-angle-right me-2"></i>Find Doctors</a>
                        <a class="text-light mb-2" href="contact.html"><i class="fa fa-angle-right me-2"></i>Contact us</a>
                        <a class="text-light mb-2" href="blog.html"><i class="fa fa-angle-right me-2"></i>Latest Blog</a>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                    <a class="text-light mb-2" href="homepage.php"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="index.php"><i class="fa fa-angle-right me-2"></i>Search Hospitals</a>
                        <a class="text-light mb-2" href="doctor.html"><i class="fa fa-angle-right me-2"></i>Find Doctors</a>
                        <a class="text-light mb-2" href="contact.html"><i class="fa fa-angle-right me-2"></i>Contact us</a>
                        <a class="text-light mb-2" href="blog.html"><i class="fa fa-angle-right me-2"></i>Latest Blog</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                   
                        
        
                    </form>
                    <h6 class="text-primary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-primary" href="#">Hospital Locator</a>. All Rights Reserved.</p>
                </div>
               
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>