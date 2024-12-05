
<style>
    /* General Reset */
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #1F1F1F;
    color: white;
    box-sizing: border-box;
    transition: background-color 0.3s, color 0.3s;
}

/* Dashboard Layout */
.dashboard {
    display: flex;
    height: 100vh;
    overflow-x: hidden;
}

/* Sidebar */
.sidebar {
    width: 280px;
    background-color: #333;
    color: white;
    padding: 20px;
    position: fixed;
    top: 0;
    left: -250px; /* Hidden off-screen by default */
    height: 100%;
    transition: left 0.3s ease;
    z-index: 1000;
}

.sidebar.open {
    left: 0; /* Visible when toggled */
}

/* Sidebar Content */
.sidebar h2 {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 60px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin-bottom: 15px;
}

.sidebar ul li a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    display: block;
    padding: 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.sidebar ul li a:hover {
    background-color: #444;
}

/* Hamburger Menu */
.hamburger {
    position: absolute;
    top: 20px;
    left: 20px;
    width: 30px;
    height: 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    cursor: pointer;
    z-index: 1001; /* Stay above content */
}

.sidebar.open .hamburger {
    left: 210px; /* Inside the sidebar */
    transition: left 0.3s ease;
}

.hamburger span {
    display: block;
    height: 4px;
    width: 100%;
    background-color: white;
    border-radius: 2px;
    transition: transform 0.3s ease, background-color 0.3s ease;
}

/* Hamburger Animation */
.hamburger.active span:nth-child(1) {
    transform: translateY(10px) rotate(45deg);
}

.hamburger.active span:nth-child(2) {
    opacity: 0;
}

.hamburger.active span:nth-child(3) {
    transform: translateY(-10px) rotate(-45deg);
}

/* Main Content */
.main-content {
    flex: 1;
    padding: 20px;
    margin-left: 80px;
    transition: margin-left 0.3s ease;
}

.main-content.shifted {
    margin-left: 350px;
}

/* Grid Layout */
.bento-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 20px;
}

/* Tile Styles */
.tile {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 20px;
    border-radius: 8px;
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

/* Dynamic Tile Sizes */
.tile.small {
    grid-column: span 1;
    grid-row: span 1;
    height: 100px;
}

.tile.medium {
    grid-column: span 2;
    grid-row: span 2;
    height: 200px;
}

.tile.large {
    grid-column: span 3;
    grid-row: span 2;
    height: 200px;
}

/* Hover Effects */
.tile:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .main-content {
        margin-left: 100px;
    }

    .sidebar ul li a {
        font-size: 14px;
    }
}

/* Light Theme */
body.light-mode {
            background-color: #f0f0f0;
            color: #000;
        }

        /* Dark Theme */
        body.dark-mode {
            background-color: #1F1F1F;
            color: #fff;
        }

        /* Toggle Switch */
        .theme-switch {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

</style>
<div class="hamburger" id="hamburger">
    <span></span>
    <span></span>
    <span></span>
</div>
<div class="sidebar" id="sidebar">
    <h2>Menu</h2>
    <ul>
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="search.php">Plate Search</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li>
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider"></span>
            </label>
        </li>
    </ul>
</div>