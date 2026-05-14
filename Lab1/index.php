<?php 
/*
    Create an array with 4 students.
*/

$students = [
    ["name" => "Mark", "grade" => 85, "subject" => "Math"],
    ["name" => "Katie", "grade" => 62, "subject" => "Science"],
    ["name" => "Jake", "grade" => 43, "subject" => "English"],
    ["name" => "Zara", "grade" => 96, "subject" => "History"]
];

/*
    Create a function for grade status
*/

function getGradeStatus($score){
    if($score >= 50){
        return "<span class="pass">PASS</span>";
    }else {
        return "<span class="fail">FAIL</span>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, device-width=width">
    <title>Week Two, Lab 1</title>
    <meta name="description" content="This week we are looking at arrays and functions">
    <meta name="robots" content="noindex, nofollow">
    <!-- CSS link here -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <h1>Report Card</h1>
    </header>
    <main>
        <section class="report-card">
            <?php foreach($students as $student): ?>
                        <div class="student-card">
                            <h3><?php echo htmlspecialchars($student['name']); ?></h3>
                            <p class="subject">Category:<?php echo htmlspecialchars($student['subject']); ?></p>
                            <p class="grade">Grade: <?php echo $student['grade']; ?></p>
                            <p class="status">Status: <?php echo getGradeStatus($student['grade']); ?></p>
                        </div>
                        <?php endforeach; ?>
        </section>
    </main>
    <footer>
        <p>&copy; </p>
        <p>Total Students Evaluated: <?php echo count($students); ?></p>
        <p>Current Time: <?php echo date("H:i:s"); ?></p>
    </footer>
</body>
</html>