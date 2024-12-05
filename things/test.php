<?php
include('../things/session.php');
include('../db.php');
?>
<div>
    <label for="region">Office</label>
    <select name="admin_type" id="region"  onchange="updateProvinces()">
            <?php 
                $query = "SELECT * FROM `admin_table`;"; 
                $AdminResult = $con->query($query); 
                
                if ($AdminResult->num_rows > 0)  
                { 
                    while($row = $AdminResult->fetch_assoc()) 
                    { 
                        echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                    } 
                }  
                else { 
                    echo "0 results"; 
                } 
            ?>
        </select>

    <label for="province">Province:</label>
    <select id="province" name="province" onchange="updateCities()">
        <option value="" disabled selected>Select Province</option>
    </select>

    <label for="city">City:</label>
    <select id="city" name="city" onchange="updateBarangays()">
        <option value="" disabled selected>Select City</option>
    </select>

    <label for="barangay">Barangay:</label>
    <select id="barangay" name="barangay">
        <option value="" disabled selected>Select Barangay</option>
    </select>
</div>

<script>
    const regionData = {
        "Region I": {
            "Ilocos Norte": {
                "Laoag City": ["Brgy. 1", "Brgy. 2", "Brgy. 3"],
                "Batac City": ["Brgy. A", "Brgy. B"]
            },
            "Ilocos Sur": {
                "Vigan City": ["Brgy. 1", "Brgy. 2"],
                "Candon City": ["Brgy. X", "Brgy. Y"]
            }
        },
        "Region II": {
            "Cagayan": {
                "Tuguegarao City": ["Brgy. North", "Brgy. South"],
                "Aparri": ["Brgy. 1", "Brgy. 2"]
            },
            "Isabela": {
                "Cauayan City": ["Brgy. A", "Brgy. B"],
                "Santiago City": ["Brgy. 1", "Brgy. 2"]
            }
        },
        // More regions and cities can be added
    };

    // Update provinces based on selected region
    function updateProvinces() {
        const regionSelect = document.getElementById("region");
        const provinceSelect = document.getElementById("province");
        const selectedRegion = regionSelect.value;

        provinceSelect.innerHTML = `<option value="" disabled selected>Select Province</option>`;
        if (regionData[selectedRegion]) {
            Object.keys(regionData[selectedRegion]).forEach(province => {
                const option = document.createElement("option");
                option.value = province;
                option.textContent = province;
                provinceSelect.appendChild(option);
            });
        }
    }

    // Update cities based on selected region and province
    function updateCities() {
        const regionSelect = document.getElementById("region");
        const provinceSelect = document.getElementById("province");
        const citySelect = document.getElementById("city");
        const selectedRegion = regionSelect.value;
        const selectedProvince = provinceSelect.value;

        citySelect.innerHTML = `<option value="" disabled selected>Select City</option>`;
        if (regionData[selectedRegion] && regionData[selectedRegion][selectedProvince]) {
            const cities = regionData[selectedRegion][selectedProvince];
            Object.keys(cities).forEach(city => {
                const option = document.createElement("option");
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    }

    // Update barangays based on selected city
    function updateBarangays() {
        const regionSelect = document.getElementById("region");
        const provinceSelect = document.getElementById("province");
        const citySelect = document.getElementById("city");
        const barangaySelect = document.getElementById("barangay");
        const selectedRegion = regionSelect.value;
        const selectedProvince = provinceSelect.value;
        const selectedCity = citySelect.value;

        barangaySelect.innerHTML = `<option value="" disabled selected>Select Barangay</option>`;
        if (regionData[selectedRegion] && regionData[selectedRegion][selectedProvince] && regionData[selectedRegion][selectedProvince][selectedCity]) {
            const barangays = regionData[selectedRegion][selectedProvince][selectedCity];
            barangays.forEach(barangay => {
                const option = document.createElement("option");
                option.value = barangay;
                option.textContent = barangay;
                barangaySelect.appendChild(option);
            });
        }
    }
</script>
