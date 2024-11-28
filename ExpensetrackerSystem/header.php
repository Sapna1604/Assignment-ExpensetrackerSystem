<header>
    <!-- Brand Name Link to Home Page -->
    <a href="index.php" style="text-decoration: none;">
        <div class="header-container">
            <h1>Expense Tracker</h1>
        </div>
    </a>

    <style>
        /* Google Font for Baloo Bhai */
        @import url('https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;700&display=swap');

        header {
            background-color: lightslategrey; /* Set background color */
            text-align: left;
            position: sticky; /* Stick to the top */
            top: 0; /* Align at the top of the page */
            width: 100%; /* Ensure it spans the full width */
            z-index: 1000; /* Make sure it's above other content */
            padding: 10px 0; /* Optional: adds some space inside the header */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional: adds a shadow effect */
        }

        header h1 {
            margin: 0;
            font-family: 'Baloo Bhai 2', sans-serif;
            color: #fff; /* White text color */
            font-size: 2.5rem;
            text-align: left; /* Center align text */
        }

        header p {
            margin: 3px 0;
            font-size: 1rem;
            color: #fff; /* White text color */
            font-family: 'Baloo Bhai 2', sans-serif;
        }

        header a:hover h1 {
            color: lightgrey;
        }
    </style>
</header>
