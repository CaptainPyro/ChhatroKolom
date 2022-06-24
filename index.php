<?php include 'connection.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Welcome to Chhatro Kolom!</title>
</head>

<body>
    <header>
    <?php include 'header.html';?>
    </header>
    <div class="py-20 font-light text-2xl bg-lime-200">
    <h1 class="text-5xl text-center py-16">Chhatro Kolom Exam Search</h1>
        <form action="index.php" method="POST" class="text-center">
            <label for="qualificaion">Qualification:</label>
            <select id="qualification" name="qualification" class="w-2/12 border border-slate-500 mx-4 rounded-lg hover:border-slate-900">
                <option value class="transition-colors">-</option>
                <option value="bsccs" class="transition-colors">Bachelor of Science in Computer Science</option>
                <option value="btechcs" class="transition-colors">Bachelor of Technology</option>
                <option value="bba" class="transition-colors">Bachelor of Business Administration</option>
                <option value="msccs" class="transition-colors">Master of Science in Computer Science
                </option>
                <option value="mtechcs" class="transition-colors">Master of Technology</option>
                <option value="mba" class="transition-colors">Master of Business Administration</option>
                
            </select>
            
            <label for="Region">Region:</label>
            <select id="Region" name="region" class="w-2/12 border border-slate-500 mx-4 rounded-lg hover:border-slate-900">
            <option value class="transition-colors">-</option>
            <option value="agartala" class="transition-colors">Agartala</option>
            <option value="allahabad" class="transition-colors">Allahabad</option>
            <option value="bhopal" class="transition-colors">Bhopal</option>
            <option value="calicut" class="transition-colors">Calicut</option>
            <option value="jamshedpur" class="transition-colors">Jamshedpur</option>
            <option value="kolkata" class="transition-colors">Kolkata</option>
            <option value="kurukshetra" class="transition-colors">Kurukshetra</option>
            <option value="maharashtra" class="transition-colors">Maharashtra</option>
            <option value="patna" class="transition-colors">Patna</option>
            <option value="raipur" class="transition-colors">Raipur</option>
            <option value="surathkal" class="transition-colors">Surathkal</option>
            <option value="tiruchirapalli" class="transition-colors">Tiruchirapalli</option>
            <option value="warangal" class="transition-colors">Warangal</option>
            </select>

            <label for="Sector">Sector:</label>
            <select id="Sector" name="sector" class="w-2/12 border border-slate-500 mx-4 rounded-lg hover:border-slate-900">
                <option value class="transition-colors">-</option>
                <option value="agricultural" class="transition-colors">Agricultural</option>
                <option value="animandgraph" class="transition-colors">Animation and Graphics</option>
                <option value="banking" class="transition-colors">Banking</option>
                <option value="fashdes" class="transition-colors">Fashion Designing</option>
                <option value="itsector" class="transition-colors">Information and Technology</option>
                <option value="softdev" class="transition-colors">Software Development</option>
            </select>

            <button class="button rounded-md px-4 py-1 border border-lime-800" type="submit">Search</button>
        </form>
    </div>

    <?php 
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $qualification = $_POST['qualification'];
            $region = $_POST['region'];
            $sector = $_POST['sector'];

            if($qualification == '-')
            {
                if($region == '-')
                {
                    $sql = "select distinct(exam), examprev
                    from list
                    where sector = '$sector'";
                }
                elseif($sector = '-')
                {
                    $sql = "select distinct(exam), examprev
                    from list
                    where region = '$region'";
                }
                else
                {
                    $sql = "select distinct(exam), examprev
                    from list
                    where region = '$region' and sector = '$sector'";
                }
            }
            elseif($region == '-')
            {
                if($sector == '-')
                {
                    $sql = "select distinct(exam), examprev
                    from list
                    where qualification = '$qualification'";
                }
                else
                {
                    $sql = "select distinct(exam), examprev
                    from list
                    where qualification = '$qualification' and sector = '$sector'";
                }
            }
            elseif($sector == '-')
            {
                $sql = "select distinct(exam), examprev
                from list
                where qualification = '$qualification' and region = '$region'";
            }
            else
            {
                $sql = "select distinct(exam), examprev
                from list
                where qualification = '$qualification' and region = '$region' and sector = '$sector'";
            }

            $result = mysqli_query($conn, $sql);

            if($result)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<div class="py-10 mr-32 font-normal text-2xl bg-lime-100">';
                    echo '<h1 class="text-3xl py-5 font-medium">'.$row['examprev'].'</h1>';
                    echo '<p class="py-5">';
                    echo 'Click <a href="'.$row['exam'].'.php" text-blue-800 visited:text-purple-800 hover:text-lime-800">here</a> for details.';
                    echo '</p>';
                    echo '</div>';
                }
            }
            else
            {
                echo "Holo na bhai";
            }
        }
        ?>

    <footer>
        <?php include 'footer.html';?>
    </footer>
</body>

</html>