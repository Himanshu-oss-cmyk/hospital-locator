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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Locator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        header {
            background: linear-gradient(135deg, #3b82f6 30%, #0ea5e9 100%);
        }
        button {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        footer {
            background: linear-gradient(135deg, #1f2937 30%, #111827 100%);
        }
        .hospital-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }
        .login-btn {
            background-color: #ffffff;
            color: #3b82f6;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
            border: 2px solid #3b82f6;
        }
        .login-btn:hover {
            background-color: #3b82f6;
            color: #ffffff;
        }
        #map {
            height: 400px;
            margin-top: 20px;
            border-radius: 8px;
        }
        .hospital-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <div class="text-white font-bold text-2xl">
                    <a href="#">Hospital Locator</a>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-white hover:text-blue-300">Home</a>
                    <a href="doctor.html" class="text-white hover:text-blue-300">Find a doctor</a>
                    <a href="contact.html" class="text-white hover:text-blue-300">Contact</a>
                    <a href="#about" class="text-white hover:text-blue-300">About</a>
                </div>
                <div class="flex space-x-4 items-center">
                <div class="flex space-x-4 items-center">
        <span class="text-white"><?php echo htmlspecialchars($userEmail); ?></span> <!-- Display user email -->
        <a href="logout.php">
            <button class="login-btn">Logout</button>
        </a>
        <!-- Mobile Menu Button -->
    </div>
                  
                    <div class="md:hidden">
                        <button id="navbar-toggle" class="text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden md:hidden" id="mobile-menu">
            <a href="#" class="block py-2 px-4 text-sm text-white hover:bg-blue-700">Home</a>
            <a href="#services" class="block py-2 px-4 text-sm text-white hover:bg-blue-700">Services</a>
            <a href="#contact" class="block py-2 px-4 text-sm text-white hover:bg-blue-700">Contact</a>
            <a href="#about" class="block py-2 px-4 text-sm text-white hover:bg-blue-700">About</a>
        </div>
    </nav>

    <!-- Search Filters -->
    <section class="container mx-auto mt-12">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold mb-6 text-blue-600">Find Your Nearest Hospital</h2>
            <form id="searchForm">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="state" class="block text-gray-800 font-medium">State:</label>
                        <input type="text" id="state" placeholder="Select State" class="mt-3 p-3 w-full border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" list="stateList" required>
                        <datalist id="stateList">
                            <option value="Maharashtra">
                            <option value="Gujarat">
                            <option value="Rajasthan">
                            <option value="Madhya Pradesh">
                            <option value="Karnataka">
                            <option value="Kerala">
                            <option value="Delhi">
                            <option value="Tamil Nadu">
                        </datalist>
                    </div>
                    <div>
                        <label for="district" class="block text-gray-800 font-medium">District:</label>
                        <input type="text" id="district" placeholder="Select District" class="mt-3 p-3 w-full border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" list="districtList" required>
                        <datalist id="districtList"></datalist>
                    </div>
                    <div>
                        <label for="specialty" class="block text-gray-800 font-medium">Medical Specialty:</label>
                        <input list="specialtyList" id="specialty" placeholder="Select specialty" class="mt-3 p-3 w-full border border-gray-300 rounded-lg focus:ring focus:ring-blue-300">
                        <datalist id="specialtyList">
                            <option value="Pediatric">
                            <option value="Cardiologist">
                            <option value="Neurologist">
                            <option value="Dermatologist">
                            <option value="ENT Specialist">
                            <option value="Urologist">
                            <option value="Oncologist">
                            <option value="Orthopedist">
                        </datalist>
                    </div>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg mt-6 hover:bg-blue-700 focus:ring focus:ring-blue-300">Search</button>
            </form>
        </div>
    </section>

    <!-- Map Section -->
    <section class="container mx-auto mt-12">
        <div id="map"></div>
    </section>

    <!-- Hospital List -->
    <section class="container mx-auto mt-16">
        <h2 class="text-3xl font-semibold mb-8 text-gray-800 text-center">Available Hospitals</h2>
        <div id="hospitalList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <!-- Hospital cards will be dynamically generated -->
        
                <!-- Example hospital card -->
                <div class="hospital-card bg-white rounded-lg shadow-md p-6 flex items-center">
                    <img src="hosimages/chandak.jpg" alt="City Hospital" class="hospital-image w-20 h-20 rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-lg">Chandak Cancer Hospital</h3>
                        <p class="text-gray-600">Specialty: Cancer</p>
                        <p class="text-gray-600">Address: Bhusawal road, Jalgaon, Maharashtra 425003</p>
                        <p class="text-gray-600">Contact: 07020123173</p>
                    </div>
                </div>
            
                <div class="hospital-card bg-white rounded-lg shadow-md p-6 flex items-center">
                    <img src="hosimages/gajanan.jpg" alt="General Hospital" class="hospital-image w-20 h-20 rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-lg">Shree Gajanan Hospital</h3>
                        <p class="text-gray-600">Specialty: Depression</p>
                        <p class="text-gray-600">Address: Deshmukhwadi pachora,jalgaon</p>
                        <p class="text-gray-600">Contact: 0942700518</p>
                    </div>
                </div>
            
                <div class="hospital-card bg-white rounded-lg shadow-md p-6 flex items-center">
                    <img src="hosimages/piyush.jpg" alt="Central Hospital" class="hospital-image w-20 h-20 rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-lg">Piyush Hospital</h3>
                        <p class="text-gray-600">Specialty: Multispeciality</p>
                        <p class="text-gray-600">Address: Ring road hareshwar nagar ,jalgaon</p>
                        <p class="text-gray-600">Contact: 0741191148</p>
                    </div>
                </div>
            
                <div class="hospital-card bg-white rounded-lg shadow-md p-6 flex items-center">
                    <img src="hosimages/mulik.jpg" alt="Hope Hospital" class="hospital-image w-20 h-20 rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-lg">Mulik eye Hospital</h3>
                        <p class="text-gray-600">Specialty: Orthopedics</p>
                        <p class="text-gray-600">Address: Jilha peth ,Jalgaon</p>
                        <p class="text-gray-600">Contact: 07383208179</p>
                    </div>
                </div>
            
                <div class="hospital-card bg-white rounded-lg shadow-md p-6 flex items-center">
                    <img src="hosimages/pandit.jpg" alt="Sunrise Hospital" class="hospital-image w-20 h-20 rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-lg">Pandit Multispeciality Hospital Critical and Dental Care Centre Hospital</h3>
                        <p class="text-gray-600">Specialty: Cardiologist and dental care</p>
                        <p class="text-gray-600">Address: Jalgaon</p>
                        <p class="text-gray-600">Contact:09036668918 </p>
                    </div>
                </div>

                <div class="hospital-card bg-white rounded-lg shadow-md p-6 flex items-center">
                    <img src="hosimages/pandit.jpg" alt="Sunrise Hospital" class="hospital-image w-20 h-20 rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-lg">Khadke Hospital and healthcare</h3>
                        <p class="text-gray-600">Specialty: Animal disease and athroplasty</p>
                        <p class="text-gray-600">Address:MJ college road Jilha peth ,Jalgaon</p>
                        <p class="text-gray-600">Contact:07383102616 </p>
                    </div>
                </div>
                <!-- Add mo
                 re hospital cards as needed -->
            </div>
            

        </div>
    </section>

    <!-- Footer -->
 <!-- Footer -->
<footer class="bg-blue-900 text-white py-10 mt-16">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Your Health, Our Priority</h2>
        <p class="text-lg mb-6">We are committed to providing the best healthcare services for you and your family.</p>
        <div class="flex justify-center space-x-4 mb-6">
            <a href="faqs.html" class="text-blue-400 hover:underline">FAQS</a>
            <a href="#" class="text-blue-400 hover:underline">Terms of Service</a>
            <a href="contact.html" class="text-blue-400 hover:underline">Contact Us</a>
        </div>
        <p class="text-sm">&copy; 2024 Hospital Locator. All rights reserved.</p>
        <p class="text-sm mt-2">Making healthcare accessible, one click at a time.</p>
    </div>
</footer>


    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Dynamic district population based on state selection
        const stateToDistricts = {
            'Maharashtra': ["Ahmednagar", "Akola", "Amravati", "Aurangabad", "Beed", "Bhandara", "Buldhana",
                "Chandrapur", "Dhule", "Gadchiroli", "Gondia", "Hingoli", "Jalgaon", "Jalna",
                "Kolhapur", "Latur", "Mumbai", "Nagpur", "Nanded", "Nandurbar", "Nashik", "Osmanabad",
                "Palghar", "Parbhani", "Pune", "Raigad", "Ratnagiri", "Sangli", "Satara", "Sindhudurg",
                "Solapur", "Thane", "Wardha", "Washim", "Yavatmal"],
            'Gujarat': ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Bhavnagar'],
            'Rajasthan': ['Jaipur', 'Udaipur', 'Jodhpur', 'Bikaner', 'Ajmer'],
            'Madhya Pradesh': ['Bhopal', 'Indore', 'Gwalior', 'Jabalpur', 'Sagar'],
            'Karnataka': ['Bengaluru', 'Mysuru', 'Mangaluru', 'Hubballi', 'Dharwad'],
            'Kerala': ['Thiruvananthapuram', 'Kochi', 'Kozhikode', 'Kottayam', 'Malappuram'],
            'Delhi': ['New Delhi', 'North Delhi', 'South Delhi', 'East Delhi', 'West Delhi'],
            'Tamil Nadu': ['Chennai', 'Coimbatore', 'Madurai', 'Tiruchirappalli', 'Salem']
        };
    
        $(document).ready(function() {
            $('#state').on('input', function() {
                const selectedState = $(this).val();
                const districts = stateToDistricts[selectedState] || [];
                const $districtList = $('#districtList');
                $districtList.empty();
                districts.forEach(district => {
                    $districtList.append(`<option value="${district}">`);
                });
            });
    
            // Initialize the map
            const map = L.map('map').setView([20.5937, 78.9629], 5); // Centered on India
    
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);
    
            // Handle form submission
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                const state = $('#state').val();
                const district = $('#district').val();
                const specialty = $('#specialty').val();
    
                // Make an AJAX request to fetch hospitals based on selected specialty
                $.ajax({
                    url: 'fetch_hospitals.php', // Path to your PHP script
                    type: 'GET',
                    data: { specialty: specialty }, // Send selected specialty to PHP
                    dataType: 'json',
                    success: function(hospitals) {
                        const $hospitalList = $('#hospitalList');
                        $hospitalList.empty(); // Clear existing hospital cards
                        map.eachLayer(function(layer) {
                            if (layer instanceof L.Marker) {
                                map.removeLayer(layer); // Clear existing markers
                            }
                        });
    
                        // Populate the hospital list and map
                        hospitals.forEach(hospital => {
                            const card = $(`
                                <div class="hospital-card bg-white rounded-lg shadow-md p-6 flex items-center">
                                    <img src="${hospital.hospital_images}" alt="${hospital.hospital_name}" class="hospital-image mr-4">
                                    <div>
                                        <h3 class="font-bold text-lg">${hospital.hospital_name}</h3>
                                        <p class="text-gray-600">Specialty: ${hospital.medical_type}</p>
                                        <p class="text-gray-600">Address: ${hospital.address}</p>
                                        <p class="text-gray-600">Contact: ${hospital.contact}</p>
                                    </div>
                                </div>
                            `);
                            $hospitalList.append(card);
    
                            // Add marker on the map
                            L.marker([hospital.latitude, hospital.longitude]).addTo(map)
                                .bindPopup(`<b>${hospital.hospital_name}</b><br>${hospital.medical_type}`).openPopup();
                        });
    
                        // Adjust map view to show all markers
                        const bounds = hospitals.map(h => [h.latitude, h.longitude]);
                        if (bounds.length) {
                            map.fitBounds(bounds);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching hospital data:', error);
                    }
                });
            });
        });
    </script>
    </body>
</html>
