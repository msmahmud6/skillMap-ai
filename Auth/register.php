<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillMap Registration</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../CSS/register.css">

<style>

</style>
</head>
<body>

<div class="wrapper">

    <!-- Bubble background -->
    <ul class="colorlib-bubbles">
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <!-- Registration Form -->
    <div class="main-register">
        <h1>Registration</h1>

        <form action="#" method="post">
            <!-- Row 1 -->
            <div class="form-row">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <!-- Row 2 -->
            <div class="form-row">
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <!-- Row 3: Dropdowns -->
            <div class="form-row">
                <select name="education_level" required>
                    <option value="">Education Level</option>
                    <option value="SSC">SSC</option>
                    <option value="HSC">HSC</option>
                    <option value="Bachelor">Bachelor</option>
                    <option value="Masters">Masters</option>
                </select>

                <select name="experience_level" required>
                    <option value="">Experience Level</option>
                    <option value="Fresher">Fresher</option>
                    <option value="Junior">Junior</option>
                    <option value="Mid">Mid</option>
                </select>

                <select name="career_track" required>
                    <option value="">Preferred Career Track</option>
                    <option value="Web Development">Web Development</option>
                    <option value="Data">Data</option>
                    <option value="Design">Design</option>
                    <option value="Marketing">Marketing</option>
                </select>
            </div>

            <!-- Checkbox -->
            <div class="wthree-text">
                <label><input type="checkbox" class="checkbox" required> I Agree to Terms & Conditions</label>
            </div>

            <input type="submit" value="SIGNUP">
            <p>Already have an account? <a href="login.php">Login Now!</a></p>
        </form>
    </div>

</div>

</body>
</html>
